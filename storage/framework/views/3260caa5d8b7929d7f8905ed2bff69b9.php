<?php $__env->startSection('title', 'Admin Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<style>
    .card-animate {
        transition: all 0.3s ease-out;
        border: none;
        border-radius: 12px;
    }
    .card-animate:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.08);
    }
    .avatar-title {
        border-radius: 10px !important;
    }
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between py-3">
                <h4 class="mb-sm-0 font-size-18">Asosiy Dashboard</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card card-animate shadow-sm">
                <a href="<?php echo e(route('users')); ?>">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <p class="text-muted fw-medium font-size-14 mb-2">Jami Mijozlar</p>
                                <h4 class="mb-0"><?php echo e($clientCount); ?></h4>
                            </div>
                            <div class="avatar-sm">
                                <span class="avatar-title bg-soft-primary text-primary font-size-24">
                                    <i class="mdi mdi-account-group"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card card-animate shadow-sm">
                <a href="<?php echo e(route('users')); ?>">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <p class="text-muted fw-medium font-size-14 mb-2">Tizim Foydalanuvchilari</p>
                                <h4 class="mb-0"><?php echo e($total_users); ?></h4>
                            </div>
                            <div class="avatar-sm">
                                <span class="avatar-title bg-soft-success text-success font-size-24">
                                    <i class="mdi mdi-shield-account"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card card-animate shadow-sm">
                <a href="<?php echo e(route('products')); ?>">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <p class="text-muted fw-medium font-size-14 mb-2">Jami Mahsulotlar</p>
                                <h4 class="mb-0"><?php echo e($total_products); ?></h4>
                            </div>
                            <div class="avatar-sm">
                                <span class="avatar-title bg-soft-warning text-warning font-size-24">
                                    <i class="mdi mdi-package-variant-closed"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card card-animate shadow-sm">
                <a href="<?php echo e(route('reservations')); ?>">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <p class="text-muted fw-medium font-size-14 mb-2">Rezervatsiyalar</p>
                                <h4 class="mb-0"><?php echo e($total_reservations); ?></h4>
                            </div>
                            <div class="avatar-sm">
                                <span class="avatar-title bg-soft-danger text-danger font-size-24">
                                    <i class="mdi mdi-calendar-check"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin_layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Asus\Desktop\Projects\UyTop\resources\views/admin/dashboard/dashboard.blade.php ENDPATH**/ ?>