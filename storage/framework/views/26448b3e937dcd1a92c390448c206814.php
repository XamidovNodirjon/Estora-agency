<?php $__env->startPush('css'); ?>
    <style>
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 0 !important;
        }
        div.dataTables_wrapper div.dataTables_filter {
            margin-bottom: 15px;
        }
        .table-responsive {
            padding: 10px 0;
        }
    </style>
<?php $__env->stopPush(); ?>

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
                <table id="productsTable" class="table table-hover align-middle w-100">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th><?php echo e(__('name')); ?></th>
                            <th><?php echo e(__('Narxi')); ?></th>
                            <th><?php echo e(__('Telefon')); ?></th>
                            <th><?php echo e(__('square')); ?></th>
                            <th><?php echo e(__('rooms')); ?></th>
                            <th><?php echo e(__('Sotix')); ?></th>
                            <th class="text-center"><?php echo e(__('Amal')); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($product->id); ?></td>
                                <td><?php echo e($product->name); ?></td>
                                <td><?php echo e(number_format($product->price, 0, '.', ' ')); ?> $</td>
                                <td><?php echo e($product->phone); ?></td>
                                <td><?php echo e($product->square); ?> m²</td>
                                <td><?php echo e($product->rooms); ?></td>
                                <td><?php echo e($product->sotix); ?></td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <a href="<?php echo e(route('edit-product', $product->id)); ?>"
                                           class="btn btn-sm btn-light border text-primary"
                                           title="<?php echo e(__('edit')); ?>" data-bs-toggle="tooltip">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        <a href="<?php echo e(route('show-products', $product->id)); ?>"
                                           class="btn btn-sm btn-light border text-info"
                                           title="<?php echo e(__('view')); ?>" data-bs-toggle="tooltip">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <form action="<?php echo e(route('delete.product', $product->id)); ?>"
                                              method="POST"
                                              onsubmit="return confirm('<?php echo e(__('Ishonchingiz komilmi?')); ?>')"
                                              class="d-inline">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-sm btn-light border text-danger"
                                                    title="<?php echo e(__('delete')); ?>" data-bs-toggle="tooltip">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    <script>
        $(document).ready(function() {
            // DataTable-ni ishga tushirish
            if (!$.fn.DataTable.isDataTable('#productsTable')) {
                $('#productsTable').DataTable({
                    "language": {
                        "search": "Qidirish:",
                        "lengthMenu": "Ko'rsatish _MENU_ tadan",
                        "info": "_START_ dan _END_ gacha ko'rsatilyapti. Jami: _TOTAL_",
                        "infoEmpty": "Ma'lumot topilmadi",
                        "zeroRecords": "Mos keladigan ma'lumot topilmadi",
                        "paginate": {
                            "next": "Keyingi",
                            "previous": "Oldingi"
                        }
                    },
                    "order": [[0, "desc"]], // ID bo'yicha kamayish
                    "pageLength": 10,
                    "stateSave": true // Sahifa yangilansa ham holatni (sahifa raqami, qidiruv) saqlaydi
                });
            }

            // Bootstrap Tooltip-ni qayta ishga tushirish (DataTable sahifalari almashganda kerak bo'ladi)
            function initTooltips() {
                var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
                tooltipTriggerList.map(function (tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl)
                });
            }
            initTooltips();
        });
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin_layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Asus\Desktop\Projects\UyTop\resources\views/Admin/products/index.blade.php ENDPATH**/ ?>