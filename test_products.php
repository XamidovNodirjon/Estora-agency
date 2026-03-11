<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$products = \App\Models\Product::orderBy('id', 'desc')->take(5)->get(['id', 'name', 'status', 'user_id', 'created_at'])->toArray();
print_r($products);
