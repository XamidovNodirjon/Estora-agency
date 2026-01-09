<?php $__env->startSection('content'); ?>
    <div class="container-fluid py-4">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0 text-primary"><?php echo e(__('list_title')); ?></h5>
                <a href="<?php echo e(route('create-product')); ?>" class="btn btn-outline-success">
                    <i class="fa fa-plus-circle me-1"></i> <?php echo e(__('add_new')); ?>

                </a>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th><?php echo e(__('name')); ?></th>
                            <th><?php echo e(__('Narxi')); ?></th>
                            <th><?php echo e(__('Telefon')); ?></th>
                            <th><?php echo e(__('square')); ?></th>
                            <th><?php echo e(__('rooms')); ?></th>
                            <th><?php echo e(__('Sotix')); ?></th>
                            <th><?php echo e(__('Amal')); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($product->id); ?></td>
                                <td><?php echo e($product->name); ?></td>
                                <td><?php echo e(number_format($product->price, 0, '.', ' ')); ?> $</td>
                                <td><?php echo e($product->phone); ?></td>
                                <td><?php echo e($product->square); ?> m²</td>
                                <td><?php echo e($product->rooms); ?></td>
                                <td><?php echo e($product->sotix); ?></td>
                                <td class="text-center">
                                    <div class="btn-group" role="group" aria-label="<?php echo e(__('Amallar')); ?>">
                                        <a href="<?php echo e(route('edit-product', $product->id)); ?>"
                                           class="btn btn-sm btn-light border text-primary"
                                           title="<?php echo e(__('edit')); ?>"
                                           data-bs-toggle="tooltip">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        <a href="<?php echo e(route('show-products', $product->id)); ?>"
                                           class="btn btn-sm btn-light border text-info"
                                           title="<?php echo e(__('view')); ?>"
                                           data-bs-toggle="tooltip">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <form action="<?php echo e(route('delete.product',$product->id)); ?>"
                                              method="POST"
                                              onsubmit="return confirm('<?php echo e(__('Ishonchingiz komilmi?')); ?>')"
                                              class="d-inline">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit"
                                                    class="btn btn-sm btn-light border text-danger"
                                                    title="<?php echo e(__('delete')); ?>"
                                                    data-bs-toggle="tooltip">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>

                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">
                                    <?php echo e(__('Hech qanday mahsulot topilmadi.')); ?>

                                </td>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin_layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Asus\Desktop\Projects\UyTop\resources\views/Admin/products/index.blade.php ENDPATH**/ ?>