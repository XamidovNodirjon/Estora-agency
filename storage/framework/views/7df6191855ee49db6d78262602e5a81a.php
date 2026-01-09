<?php $__env->startSection('content'); ?>
    <div class="container-fluid py-4">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0 text-primary"><?php echo e($user->name); ?> ning ko‘rgan maxulotlar</h5>
                <a href="<?php echo e(url()->previous()); ?>" class="btn btn-secondary btn-sm "> <i class="bi bi-arrow-left"></i> Ortga </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Nomi</th>
                            <th>Narxi</th>
                            <th>Telefon</th>
                            <th>Maydoni (m²)</th>
                            <th>Xonalar</th>
                            <th>Ko‘rish ID</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $productView): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($index + 1); ?></td>
                                <td><?php echo e($productView->product->name ?? '-'); ?></td>
                                <td><?php echo e(number_format($productView->product->price ?? 0, 0, '.', ' ')); ?> so'm</td>
                                <td><?php echo e($productView->product->phone ?? '-'); ?></td>
                                <td><?php echo e($productView->product->square ?? '-'); ?> m²</td>
                                <td><?php echo e($productView->product->rooms ?? '-'); ?></td>
                                <td><?php echo e($productView->id); ?></td>
                                <td>
                                    <form action="<?php echo e(route('product-view.delete', $productView->id)); ?>" method="POST" class="d-inline">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-sm btn-outline-danger"
                                                onclick="return confirm('Haqiqatan ham bu ko‘rishni o‘chirmoqchimisiz?')">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>

                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="7" class="text-center text-muted">Bu foydalanuvchi hech qanday mahsulot
                                    ko‘rmagan
                                </td>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin_layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Asus\Desktop\Projects\UyTop\resources\views/Admin/product_view/index.blade.php ENDPATH**/ ?>