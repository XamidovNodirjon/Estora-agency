<?php $__env->startSection('content'); ?>
    <div class="container py-4">
        <h2 class="mb-4">Mahsulot Tafsilotlari</h2>

        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <strong>Id:</strong> <?php echo e($product->id); ?>

                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Name:</strong> <?php echo e($product->name); ?>

                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Kategoriya:</strong> <?php echo e($product->category->name ?? '-'); ?>

                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Subkategoriya:</strong> <?php echo e($product->subcategory->name ?? '-'); ?>

                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Hudud:</strong> <?php echo e($product->region->name ?? '-'); ?>

                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Shahar/Tuman:</strong> <?php echo e($product->city->name ?? '-'); ?>

                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Narx:</strong> <?php echo e(number_format($product->price, 0, ',', ' ')); ?> so'm
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Telefon:</strong>
                        <?php if($product->isPhoneVisibleTo(auth()->user())): ?>
                            <?php echo e($product->phone); ?>

                        <?php else: ?>
                            <span class="text-muted">Ruxsat yo‘q (telefon raqam yashirin)</span>
                        <?php endif; ?>
                    </div>

                    <div class="col-md-6 mb-3">
                        <strong>Qavat:</strong> <?php echo e($product->floor); ?>/<?php echo e($product->building_floor); ?>

                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Maydon:</strong> <?php echo e($product->square); ?> m<sup>2</sup>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Xonalar soni:</strong> <?php echo e($product->rooms); ?>

                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Ta'mir holati:</strong> <?php echo e($product->repair); ?>

                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Sotix:</strong> <?php echo e($product->sotix); ?>

                    </div>
                </div>

                <div class="mt-3">
                    <strong>Izoh:</strong>
                    <p><?php echo e($product->description); ?></p>
                </div>
            </div>
        </div>

        <?php if($product->images): ?>
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Rasmlar</h5>
                    <div class="row">
                        <?php $__currentLoopData = json_decode($product->images, true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-3 mb-3">
                                <img src="<?php echo e(asset('storage/' . $image)); ?>" class="img-fluid rounded border shadow-sm"
                                     alt="Product Image">
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.managers_layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Asus\Desktop\Projects\UyTop\resources\views/managers/products/show.blade.php ENDPATH**/ ?>