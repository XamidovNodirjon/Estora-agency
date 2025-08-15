<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->boolean('exchange')->default(false)->after('status');
            $table->boolean('pay_in_installments')->default(false)->after('exchange');
            $table->boolean('credit')->default(false)->after('pay_in_installments');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['exchange', 'pay_in_installments', 'credit']);
        });
    }
};
