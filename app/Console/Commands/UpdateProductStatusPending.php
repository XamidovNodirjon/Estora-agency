<?php

namespace App\Console\Commands;

use App\Constants;
use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Console\Command;

class UpdateProductStatusPending extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-product-status-pending';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates product status based on category and creation date';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now();

        // 1. Rent Categories: 7 days -> Pending, 10 days -> Inactive
        $rentCategoryNames = [
            trim(Constants::APARTMENT_RENTERS),
            trim(Constants::COMMERCIAL_BUILDING_LESSORS),
        ];
        $this->updateCategoryStatuses($rentCategoryNames, 7, 10, $now);

        // 2. Sale Categories: 14 days -> Pending, 21 days -> Inactive
        $saleCategoryNames = [
            trim(Constants::APARTMENT_SELLERS),
            trim(Constants::HOME_LOT_SELLERS),
            trim(Constants::COMMERCIAL_BUILDING_SALESPEOPLE),
        ];
        $this->updateCategoryStatuses($saleCategoryNames, 14, 21, $now);

        $this->info("Product statuses updated successfully.");
    }

    private function updateCategoryStatuses($categoryNames, $pendingDays, $inactiveDays, $now)
    {
        $categoryIds = Category::whereIn('name', $categoryNames)->pluck('id')->toArray();

        if (empty($categoryIds)) {
            return;
        }

        // To Inactive
        $inactiveThreshold = $now->copy()->subDays($inactiveDays);
        $inactiveCount = Product::whereIn('category_id', $categoryIds)
            ->where('status', '!=', Constants::STATUS_INACTIVE)
            ->where('created_at', '<=', $inactiveThreshold)
            ->update(['status' => Constants::STATUS_INACTIVE]);

        if ($inactiveCount > 0) {
            $this->warn("Updated {$inactiveCount} products to '" . Constants::STATUS_INACTIVE . "' for categories: " . implode(', ', $categoryNames));
        }

        // To Pending
        $pendingThreshold = $now->copy()->subDays($pendingDays);
        $pendingCount = Product::whereIn('category_id', $categoryIds)
            ->where('status', Constants::STATUS_ACTIVE) // Only from Active to Pending
            ->where('created_at', '<=', $pendingThreshold)
            ->update(['status' => Constants::STATUS_PENDING]);

        if ($pendingCount > 0) {
            $this->info("Updated {$pendingCount} products to '" . Constants::STATUS_PENDING . "' for categories: " . implode(', ', $categoryNames));
        }
    }
}
