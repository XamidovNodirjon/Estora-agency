<?php $__env->startSection('content'); ?>
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0"><?php echo e(__('Product Details')); ?></h2>
            <div>
                <a href="<?php echo e(route('edit-product', $product->id)); ?>" class="btn btn-primary btn-sm">
                    <i class="fas fa-edit me-2"></i><?php echo e(__('Edit')); ?>

                </a>
                <a href="<?php echo e(route('products')); ?>" class="btn btn-outline-secondary btn-sm">
                    <i class="fas fa-arrow-left me-2"></i><?php echo e(__('Back to List')); ?>

                </a>
            </div>
        </div>

        <div class="card shadow-sm mb-4 border-0">
            <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center">
                <h4 class="mb-0 text-primary"><?php echo e($product->name); ?></h4>
                <span class="badge bg-<?php echo e($product->status === 'active' ? 'success' : 'secondary'); ?>">
                    <?php echo e(ucfirst($product->status)); ?>

                </span>
            </div>

            <div class="card-body">
                <!-- Images Gallery -->
                <?php if($product->images): ?>
                    <div class="row mb-4">
                        <div class="col-md-8">
                            <div class="main-image-container mb-3">
                                <?php $images = json_decode($product->images, true); ?>
                                <img src="<?php echo e(asset('storage/' . $images[0])); ?>"
                                     class="img-fluid rounded-3 border shadow-sm"
                                     id="mainImage"
                                     alt="<?php echo e(__('Main Product Image')); ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="thumbnail-container d-flex flex-column">
                                <?php $__currentLoopData = array_slice($images, 0, 3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="thumbnail-item mb-2 <?php echo e($key === 0 ? 'active' : ''); ?>">
                                        <img src="<?php echo e(asset('storage/' . $image)); ?>"
                                             class="img-thumbnail cursor-pointer"
                                             onclick="changeMainImage(this)"
                                             alt="<?php echo e(__('Product Thumbnail')); ?>">
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php if(count($images) > 3): ?>
                                    <div class="thumbnail-item position-relative">
                                        <img src="<?php echo e(asset('storage/' . $images[3])); ?>"
                                             class="img-thumbnail"
                                             alt="<?php echo e(__('Product Thumbnail')); ?>">
                                        <div class="more-images-overlay">
                                            +<?php echo e(count($images) - 3); ?>

                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

            <!-- Basic Info Section -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="info-card mb-4">
                            <h5 class="info-card-header bg-light-primary">
                                <i class="fas fa-info-circle me-2"></i><?php echo e(__('Basic Information')); ?>

                            </h5>
                            <div class="info-card-body">
                                <div class="info-item">
                                    <span class="info-label"><?php echo e(__('Category')); ?>:</span>
                                    <span class="info-value"><?php echo e($product->category->name ?? '-'); ?></span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label"><?php echo e(__('Subcategory')); ?>:</span>
                                    <span class="info-value"><?php echo e($product->subcategory->name ?? '-'); ?></span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label"><?php echo e(__('Type')); ?>:</span>
                                    <span class="info-value text-capitalize"><?php echo e($product->name); ?></span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label"><?php echo e(__('Status')); ?>:</span>
                                    <span class="info-value badge bg-<?php echo e($product->status === 'active' ? 'success' : 'secondary'); ?>">
                                        <?php echo e(ucfirst($product->status)); ?>

                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="info-card mb-4">
                            <h5 class="info-card-header bg-light-primary">
                                <i class="fas fa-map-marker-alt me-2"></i><?php echo e(__('Location')); ?>

                            </h5>
                            <div class="info-card-body">
                                <div class="info-item">
                                    <span class="info-label"><?php echo e(__('Region')); ?>:</span>
                                    <span class="info-value"><?php echo e($product->region->name ?? '-'); ?></span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label"><?php echo e(__('City/District')); ?>:</span>
                                    <span class="info-value"><?php echo e($product->city->name ?? '-'); ?></span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label"><?php echo e(__('Address')); ?>:</span>
                                    <span class="info-value"><?php echo e($product->landmark ?? '-'); ?></span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label"><?php echo e(__('Published')); ?>:</span>
                                    <span class="info-value"><?php echo e($product->created_at->format('d.m.Y H:i')); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Price and Contact Section -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="info-card mb-4">
                            <h5 class="info-card-header bg-light-success">
                                <i class="fas fa-tag me-2"></i><?php echo e(__('Pricing')); ?>

                            </h5>
                            <div class="info-card-body">
                                <div class="info-item">
                                    <span class="info-label"><?php echo e(__('Price')); ?>:</span>
                                    <span class="info-value fw-bold text-success">
                                        <?php echo e(number_format($product->price, 0, ',', ' ')); ?> <?php echo e(__('USD')); ?>

                                    </span>
                                </div>
                                <?php if($product->sotix): ?>
                                    <div class="info-item">
                                        <span class="info-label"><?php echo e(__('Sotix')); ?>:</span>
                                        <span class="info-value"><?php echo e($product->sotix); ?></span>
                                    </div>
                                <?php endif; ?>
                                <div class="info-item">
                                    <span class="info-label"><?php echo e(__('Payment Options')); ?>:</span>
                                    <div class="d-flex flex-wrap gap-2 mt-1">
                                        <?php if($product->exchange): ?>
                                            <span class="badge bg-info"><?php echo e(__('Exchange')); ?></span>
                                        <?php endif; ?>
                                        <?php if($product->pay_in_installments): ?>
                                            <span class="badge bg-info"><?php echo e(__('Installments')); ?></span>
                                        <?php endif; ?>
                                        <?php if($product->credit): ?>
                                            <span class="badge bg-info"><?php echo e(__('Credit')); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="info-card mb-4">
                            <h5 class="info-card-header bg-light-info">
                                <i class="fas fa-phone-alt me-2"></i><?php echo e(__('Contact')); ?>

                            </h5>
                            <div class="info-card-body">
                                <div class="info-item">
                                    <span class="info-label"><?php echo e(__('Phone')); ?>:</span>
                                    <span class="info-value">
                                        <?php if($product->isPhoneVisibleTo(auth()->user())): ?>
                                            <a href="tel:<?php echo e($product->phone); ?>" class="text-decoration-none">
                                                <?php echo e($product->phone); ?>

                                            </a>
                                        <?php else: ?>
                                            <span class="text-muted"><?php echo e(__('Hidden')); ?></span>
                                        <?php endif; ?>
                                    </span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label"><?php echo e(__('Contact Name')); ?>:</span>
                                    <span class="info-value"><?php echo e($product->contact_name ?? '-'); ?></span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label"><?php echo e(__('Email')); ?>:</span>
                                    <span class="info-value">
                                        <?php if($product->email): ?>
                                            <a href="mailto:<?php echo e($product->email); ?>" class="text-decoration-none">
                                                <?php echo e($product->email); ?>

                                            </a>
                                        <?php else: ?>
                                            -
                                        <?php endif; ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Property Details Section -->
                <div class="info-card mb-4">
                    <h5 class="info-card-header bg-light-warning">
                        <i class="fas fa-home me-2"></i><?php echo e(__('Property Details')); ?>

                    </h5>
                    <div class="info-card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="info-item">
                                    <span class="info-label"><?php echo e(__('Floor')); ?>:</span>
                                    <span class="info-value"><?php echo e($product->floor); ?>/<?php echo e($product->building_floor); ?></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="info-item">
                                    <span class="info-label"><?php echo e(__('Square')); ?>:</span>
                                    <span class="info-value"><?php echo e($product->square); ?> m<sup>2</sup></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="info-item">
                                    <span class="info-label"><?php echo e(__('Rooms')); ?>:</span>
                                    <span class="info-value"><?php echo e($product->rooms); ?></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="info-item">
                                    <span class="info-label"><?php echo e(__('Repair')); ?>:</span>
                                    <span class="info-value text-capitalize"><?php echo e($product->repair); ?></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="info-item">
                                    <span class="info-label"><?php echo e(__('Year Built')); ?>:</span>
                                    <span class="info-value"><?php echo e($product->year_built ?? '-'); ?></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="info-item">
                                    <span class="info-label"><?php echo e(__('Condition')); ?>:</span>
                                    <span class="info-value"><?php echo e($product->condition ?? '-'); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Description Section -->
                <div class="info-card mb-4">
                    <h5 class="info-card-header bg-light-secondary">
                        <i class="fas fa-align-left me-2"></i><?php echo e(__('Description')); ?>

                    </h5>
                    <div class="info-card-body">
                        <div class="info-item">
                            <p class="info-description"><?php echo e($product->description); ?></p>
                        </div>
                    </div>
                </div>

                <!-- Additional Features Section -->
                <?php if($product->features && $product->features->count() > 0): ?>
    <div class="info-card">
        <h5 class="info-card-header bg-light-info">
            <i class="fas fa-star me-2"></i><?php echo e(__('Features')); ?>

        </h5>
        <div class="info-card-body">
            <div class="d-flex flex-wrap gap-2">
                <?php $__currentLoopData = $product->features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <span class="badge bg-primary">
                        <?php echo e($feature->feature_name); ?>

                    </span>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
<?php endif; ?>
            </div>
        </div>
    </div>

    <style>
        /* Main Card Styling */
        .card {
            border-radius: 12px;
            overflow: hidden;
        }

        .card-header {
            padding: 1rem 1.5rem;
            font-weight: 600;
        }

        /* Image Gallery Styling */
        .main-image-container {
            height: 350px;
            overflow: hidden;
            border-radius: 8px;
            background-color: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .main-image-container img {
            max-height: 100%;
            width: auto;
            max-width: 100%;
            object-fit: contain;
        }

        .thumbnail-container {
            height: 350px;
            overflow-y: auto;
            padding-right: 8px;
        }

        .thumbnail-item {
            position: relative;
            cursor: pointer;
            transition: all 0.2s ease;
            border-radius: 6px;
            overflow: hidden;
        }

        .thumbnail-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .thumbnail-item.active {
            border: 2px solid var(--bs-primary);
        }

        .thumbnail-item img {
            width: 100%;
            height: 100px;
            object-fit: cover;
        }

        .more-images-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            font-weight: bold;
        }

        /* Info Card Styling */
        .info-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            overflow: hidden;
            height: 100%;
        }

        .info-card-header {
            padding: 12px 16px;
            font-size: 1.1rem;
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }

        .bg-light-primary {
            background-color: rgba(13,110,253,0.1);
            color: #0d6efd;
        }

        .bg-light-success {
            background-color: rgba(25,135,84,0.1);
            color: #198754;
        }

        .bg-light-info {
            background-color: rgba(13,202,240,0.1);
            color: #0dcaf0;
        }

        .bg-light-warning {
            background-color: rgba(255,193,7,0.1);
            color: #ffc107;
        }

        .bg-light-secondary {
            background-color: rgba(108,117,125,0.1);
            color: #6c757d;
        }

        .info-card-body {
            padding: 16px;
        }

        .info-item {
            margin-bottom: 12px;
            padding-bottom: 12px;
            border-bottom: 1px dashed #eee;
        }

        .info-item:last-child {
            margin-bottom: 0;
            padding-bottom: 0;
            border-bottom: none;
        }

        .info-label {
            font-weight: 600;
            color: #555;
            display: inline-block;
            min-width: 120px;
        }

        .info-value {
            color: #333;
        }

        .info-description {
            white-space: pre-line;
            line-height: 1.6;
            color: #444;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .main-image-container {
                height: 250px;
            }

            .thumbnail-container {
                height: auto;
                flex-direction: row !important;
                overflow-x: auto;
                overflow-y: hidden;
                padding-bottom: 8px;
            }

            .thumbnail-item {
                min-width: 80px;
                height: 80px;
                margin-right: 8px;
                margin-bottom: 0;
            }

            .thumbnail-item img {
                height: 80px;
            }
        }
    </style>

    <script>
        function changeMainImage(element) {
            const mainImage = document.getElementById('mainImage');
            mainImage.src = element.src;

            // Update active thumbnail
            document.querySelectorAll('.thumbnail-item').forEach(item => {
                item.classList.remove('active');
            });
            element.parentElement.classList.add('active');
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin_layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Asus\Desktop\Projects\UyTop\resources\views/Admin/products/show.blade.php ENDPATH**/ ?>