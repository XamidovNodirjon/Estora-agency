<?php $__env->startSection('content'); ?>
    <div class="container py-4">
        <div class="card shadow-sm rounded">
            <div class="card-header text-center">
                <h4 class="mb-0 fw-bold">Edit <?php echo e($product->name); ?></h4>
            </div>
            <div class="card-body">
                <form action="<?php echo e(route('update-product', $product->id)); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label fw-medium"><?php echo e(__('Ad type')); ?></label>
                            <select id="name" name="name" class="form-select rounded-pill" required>
                                <option value=""><?php echo e(__('Select ad type')); ?></option>
                                <option value="rent" <?php echo e(old('name', $product->name) == 'rent' ? 'selected' : ''); ?>><?php echo e(__('Rent')); ?></option>
                                <option value="sale" <?php echo e(old('name', $product->name) == 'sale' ? 'selected' : ''); ?>><?php echo e(__('Sale')); ?></option>
                                <option value="expats" <?php echo e(old('name', $product->name) == 'expats' ? 'selected' : ''); ?>><?php echo e(__('Expats')); ?></option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="category" class="form-label fw-semibold">Kategoriya</label>
                            <select id="category" name="category_id" class="form-select" required>
                                <option value="">Kategoriya tanlang</option>
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option
                                        value="<?php echo e($category->id); ?>" <?php echo e(old('category_id', $product->category_id) == $category->id ? 'selected' : ''); ?>>
                                        <?php echo e($category->name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="subcategory" class="form-label fw-semibold">Subkategoriya</label>
                            <select id="subcategory" name="subcategory_id" class="form-select" required>
                                <option value="">Subkategoriya tanlang</option>
                                <?php
                                    $currentCategory = $categories->where('id', old('category_id', $product->category_id))->first();
                                    $subcategories = $currentCategory ? $currentCategory->subcategories : collect();
                                ?>
                                <?php $__currentLoopData = $subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option
                                        value="<?php echo e($subcategory->id); ?>" <?php echo e(old('subcategory_id', $product->subcategory_id) == $subcategory->id ? 'selected' : ''); ?>>
                                        <?php echo e($subcategory->name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="region_id" class="form-label fw-semibold">Viloyat</label>
                            <select id="region_id" name="region_id" class="form-select" required>
                                <option value="">Viloyat tanlang</option>
                                <?php $__currentLoopData = $address; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $region): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option
                                        value="<?php echo e($region->id); ?>" <?php echo e(old('region_id', $product->region_id) == $region->id ? 'selected' : ''); ?>>
                                        <?php echo e($region->name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="city_id" class="form-label fw-semibold">Tuman / Shahar</label>
                            <select id="city_id" name="city_id" class="form-select" required>
                                <option value="">Tuman/shahar tanlang</option>
                                <?php
                                    $currentRegion = $address->where('id', old('region_id', $product->region_id))->first();
                                    $cities = $currentRegion ? $currentRegion->cities : collect();
                                ?>
                                <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option
                                        value="<?php echo e($city->id); ?>" <?php echo e(old('city_id', $product->city_id) == $city->id ? 'selected' : ''); ?>>
                                        <?php echo e($city->name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label class="d-block fw-medium mb-2"><?php echo e(__('Additional options')); ?></label>
                            <div class="d-flex flex-wrap gap-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="exchange" name="exchange"
                                           value="1" <?php echo e(old('exchange', $product->exchange) ? 'checked' : ''); ?>>
                                    <label class="form-check-label" for="exchange"><?php echo e(__('Exchange')); ?></label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="credit" name="credit"
                                           value="1" <?php echo e(old('credit', $product->credit) ? 'checked' : ''); ?>>
                                    <label class="form-check-label" for="credit"><?php echo e(__('Ipoteka credit')); ?></label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="pay_in_installments" name="pay_in_installments"
                                           value="1" <?php echo e(old('pay_in_installments', $product->pay_in_installments) ? 'checked' : ''); ?>>
                                    <label class="form-check-label" for="pay_in_installments"><?php echo e(__('Installment / Payment in installments')); ?></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="price" class="form-label fw-semibold">Narxi</label>
                            <input type="number" name="price" id="price" value="<?php echo e(old('price', $product->price)); ?>"
                                   class="form-control" placeholder="Narxi">
                        </div>
                        <div class="col-md-12">
                            <label for="description" class="form-label fw-semibold">Tavsifi</label>
                            <textarea name="description" id="description" class="form-control"
                                      placeholder="Mahsulot haqida qisqacha"
                                      rows="3"><?php echo e(old('description', $product->description)); ?></textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="images" class="form-label fw-semibold">Rasmlar</label>
                            <input type="file" name="images[]" id="images" class="form-control" multiple>
                            <small class="form-text text-muted">Bir nechta rasm tanlashingiz mumkin.</small>
                            <div class="mt-2 d-flex flex-wrap gap-2" id="product-images-list">
                                <?php if($product->images): ?>
                                    <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="position-relative d-inline-block" style="width: 80px; height: 80px;">
                                            <img src="<?php echo e(asset('storage/' . $img)); ?>" class="rounded"
                                                 style="width: 80px; height: 80px; object-fit: cover;"/>
                                            <button type="button"
                                                    class="btn btn-danger btn-sm position-absolute top-0 end-0 px-1 py-0 remove-image-btn"
                                                    data-index="<?php echo e($index); ?>"
                                                    style="z-index:2; font-size:20px; line-height:16px;">&times;
                                            </button>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </div>
                            <input type="hidden" name="remove_images" id="remove_images" value="">
                        </div>
                        <div class="col-md-6">
                            <label for="phone" class="form-label fw-semibold">Telefon</label>
                            <input type="text" name="phone" id="phone" value="<?php echo e(old('phone', $product->phone)); ?>"
                                   class="form-control" placeholder="+998901234567" maxlength="13" minlength="9">
                        </div>
                        <div class="col-md-4">
                            <label for="floor" class="form-label fw-semibold">Qavat</label>
                            <input type="number" name="floor" id="floor" value="<?php echo e(old('floor', $product->floor)); ?>"
                                   class="form-control" placeholder="1" min="1">
                        </div>
                        <div class="col-md-4">
                            <label for="building_floor" class="form-label fw-semibold">Bino qavati</label>
                            <input type="number" name="building_floor" id="building_floor"
                                   value="<?php echo e(old('building_floor', $product->building_floor)); ?>" class="form-control"
                                   placeholder="1" min="1">
                        </div>
                        <div class="col-md-4">
                            <label for="square" class="form-label fw-semibold">Maydon (kv.m)</label>
                            <input type="number" name="square" id="square" value="<?php echo e(old('square', $product->square)); ?>"
                                   class="form-control" placeholder="50" min="1">
                        </div>
                        <div class="col-md-4">
                            <label for="rooms" class="form-label fw-semibold">Xonalar soni</label>
                            <input type="number" name="rooms" id="rooms" value="<?php echo e(old('rooms', $product->rooms)); ?>"
                                   class="form-control" placeholder="5" min="1">
                        </div>
                        <div class="col-md-4">
                            <label for="repair" class="form-label fw-medium"><?php echo e(__('Repair')); ?></label>
                            <select id="repair" name="repair" class="form-select rounded-pill" required>
                                <option value=""><?php echo e(__('Repair status')); ?></option>
                                <option value="euro_repair" <?php echo e(old('repair', $product->repair) == 'euro_repair' ? 'selected' : ''); ?>><?php echo e(__('Euro repair')); ?></option>
                                <option value="medium_repair" <?php echo e(old('repair', $product->repair) == 'medium_repair' ? 'selected' : ''); ?>><?php echo e(__('Medium repair')); ?></option>
                                <option value="repair_required" <?php echo e(old('repair', $product->repair) == 'repair_required' ? 'selected' : ''); ?>><?php echo e(__('Repair required')); ?></option>
                                <option value="white_box" <?php echo e(old('repair', $product->repair) == 'white_box' ? 'selected' : ''); ?>><?php echo e(__('White box')); ?></option>
                                <option value="box" <?php echo e(old('repair', $product->repair) == 'box' ? 'selected' : ''); ?>><?php echo e(__('Box without repair')); ?></option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="sotix" class="form-label fw-semibold">Sotix</label>
                            <input type="number" name="sotix" id="sotix" value="<?php echo e(old('sotix', $product->sotix)); ?>"
                                   class="form-control" placeholder="50">
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary px-5 py-2 fw-semibold rounded-pill">Yangilash
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const productImagesList = document.getElementById('product-images-list');
            const removeImagesInput = document.getElementById('remove_images');
            let removedImages = [];

            productImagesList.addEventListener('click', function (e) {
                if (e.target.classList.contains('remove-image-btn')) {
                    const imageIndex = e.target.dataset.index; // rasm index
                    removedImages.push(imageIndex);

                    removeImagesInput.value = JSON.stringify(removedImages);

                    e.target.closest('.position-relative').remove();
                }
            });
        });
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin_layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Asus\Desktop\Projects\UyTop\resources\views/Admin/products/edit.blade.php ENDPATH**/ ?>