<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    $data = [
        'name' => 'test_insert',
        'status' => \App\Constants::STATUS_ACTIVE,
        'user_id' => 1,
    ];

    print_r("Input data:\n");
    print_r($data);

    $product = \App\Models\Product::create($data);

    print_r("\nSaved product:\n");
    print_r($product->toArray());

    $dbProduct = \App\Models\Product::find($product->id);
    print_r("\nDB Query product:\n");
    print_r($dbProduct->toArray());
} catch (\Exception $e) {
    print_r("Error:\n");
    print_r($e->getMessage());
}
