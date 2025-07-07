<?php

namespace App\Jobs;

use App\Models\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Auth;

class CreateProducts implements ShouldQueue
{
    use Queueable;

    protected $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function handle()
    {
        $user = Auth::user();
        $product = new Product();
        $product->name = $this->data['name'];
        $product->category_id = $this->data['category_id'];
        $product->subcategory_id = $this->data['subcategory_id'];
        $product->region_id = $this->data['region_id'];
        $product->city_id = $this->data['city_id'];
        $product->price = $this->data['price'];
        $product->description = $this->data['description'];
        $product->phone = $this->data['phone'];
        $product->floor = $this->data['floor'];
        $product->building_floor = $this->data['building_floor'];
        $product->square = $this->data['square'];
        $product->rooms = $this->data['rooms'];
        $product->repair = $this->data['repair'];
        $product->sotix = $this->data['sotix'];
        $product->user_id = $user->id;
        $product->images = json_encode($this->data['images'] ?? []);

        $product->save();
    }
}
