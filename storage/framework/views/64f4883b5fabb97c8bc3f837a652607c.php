<?php $__env->startSection('title', 'User Reservations - Admin Panel'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container py-4">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-primary fw-bold">
                <i class="bi bi-bookmark-check-fill me-2"></i> User Reservations
            </h2>

            <form action="<?php echo e(route('reservations.search')); ?>" method="GET" class="d-flex align-items-center">
                <input type="text" name="query" class="form-control me-2" placeholder="Search by ID or Phone..." value="<?php echo e(request('query')); ?>">
                <button class="btn btn-primary"><i class="bi bi-search"></i></button>

                <?php if(request('query')): ?>
                    <a href="<?php echo e(route('reservations')); ?>" class="btn btn-outline-secondary ms-2">
                        <i class="bi bi-x-circle"></i> Clear
                    </a>
                <?php endif; ?>
            </form>
        </div>

        
        <?php if(session('success')): ?>
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> <?php echo e(session('success')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> <?php echo e(session('error')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        
        <div class="card shadow border-0 rounded-4">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-primary text-white">
                        <tr class="text-uppercase small">
                            <th class="ps-4 py-3">Product</th>
                            <th class="py-3">User</th>
                            <th class="py-3">Phone</th>
                            <th class="py-3">Qty</th>
                            <th class="py-3">Start</th>
                            <th class="py-3">End</th>
                            <th class="text-center py-3">Status</th>
                            <th class="text-end pe-4 py-3">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $reservations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reservation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td class="ps-4 fw-semibold"><?php echo e($reservation->product->name ?? 'N/A'); ?></td>
                                <td><?php echo e($reservation->user->name ?? 'N/A'); ?></td>
                                <td><?php echo e($reservation->phone); ?></td>
                                <td><?php echo e($reservation->quantity); ?></td>
                                <td><?php echo e($reservation->reserved_at?->format('Y-m-d H:i') ?? 'N/A'); ?></td>
                                <td><?php echo e($reservation->reserved_until?->format('Y-m-d H:i') ?? 'N/A'); ?></td>
                                <td class="text-center">
                                    <?php if($reservation->reserved_until && $reservation->reserved_until->isPast()): ?>
                                        <span class="badge bg-secondary px-3 py-2">
                                            <i class="bi bi-hourglass-bottom me-1"></i> Expired
                                        </span>
                                    <?php elseif($reservation->reserved_at && $reservation->reserved_at->isFuture()): ?>
                                        <span class="badge bg-info text-dark px-3 py-2">
                                            <i class="bi bi-hourglass-split me-1"></i> Upcoming
                                        </span>
                                    <?php elseif($reservation->reserved_at && $reservation->reserved_until): ?>
                                        <span class="badge bg-success px-3 py-2">
                                            <i class="bi bi-check-circle-fill me-1"></i> Active
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-warning text-dark px-3 py-2">
                                            <i class="bi bi-question-circle me-1"></i> Unknown
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-end pe-4">
                                    <form method="POST" action="<?php echo e(route('reservations.destroy', $reservation->id)); ?>"
                                          onsubmit="return confirm('Are you sure you want to delete this reservation?');"
                                          class="d-inline">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </form>

                                    <button class="btn btn-sm btn-outline-info ms-1" data-bs-toggle="modal" data-bs-target="#editModal<?php echo e($reservation->id); ?>">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                </td>
                            </tr>

                            
                            <div class="modal fade" id="editModal<?php echo e($reservation->id); ?>" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Reservation</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            
                                            <p>Form not yet implemented</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="8" class="text-center text-muted py-5">
                                    <i class="bi bi-search h1 d-block mb-2 text-primary"></i>
                                    <p class="fw-bold">No reservations found.</p>
                                    <p class="text-secondary">Try another search.</p>
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

<?php $__env->startPush('scripts'); ?>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const reservedAt = document.getElementById('reserved_at');
            const reservedUntil = document.getElementById('reserved_until');

            if (reservedAt && reservedUntil) {
                const now = new Date().toISOString().slice(0, 16);
                reservedAt.setAttribute('min', now);
                reservedUntil.setAttribute('min', now);

                reservedAt.addEventListener('change', () => {
                    const start = new Date(reservedAt.value);
                    start.setHours(start.getHours() + 1);
                    const minEnd = start.toISOString().slice(0, 16);
                    reservedUntil.setAttribute('min', minEnd);
                    if (new Date(reservedUntil.value) < start) {
                        reservedUntil.value = minEnd;
                    }
                });
            }
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin_layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Asus\Desktop\Projects\UyTop\resources\views/Admin/reservation/index.blade.php ENDPATH**/ ?>