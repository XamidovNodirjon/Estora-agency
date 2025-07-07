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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('subcategory_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('region_id')->nullable();
            $table->unsignedBigInteger('city_id')->nullable();
            $table->string('name')->nullable();
            $table->decimal('price')->nullable();
            $table->text('description')->nullable();
            $table->json('images')->nullable();
            $table->string('phone')->nullable();
            $table->unsignedBigInteger('floor')->nullable();
            $table->unsignedBigInteger('building_floor')->nullable();
            $table->unsignedBigInteger('square')->nullable();  //kvadrat
            $table->unsignedBigInteger('rooms')->nullable();
            $table->string('repair')->nullable();
            $table->unsignedBigInteger('sotix')->nullable();
            $table->decimal('long_id')->nullable();
            $table->decimal('latitude_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
