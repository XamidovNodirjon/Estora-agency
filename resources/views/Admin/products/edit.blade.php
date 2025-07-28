@extends('layouts.admin_layout')
@section('content')
    <div class="container py-4">
        <div class="card shadow-sm rounded">
            <div class="card-header text-center">
                <h4 class="mb-0 fw-bold">Edit {{ $product->name }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('update-product', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label fw-semibold">Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}"
                                   class="form-control" placeholder="Product nomi" required>
                        </div>
                        <div class="col-md-6">
                            <label for="category" class="form-label fw-semibold">Kategoriya</label>
                            <select id="category" name="category_id" class="form-select" required>
                                <option value="">Kategoriya tanlang</option>
                                @foreach($categories as $category)
                                    <option
                                        value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="subcategory" class="form-label fw-semibold">Subkategoriya</label>
                            <select id="subcategory" name="subcategory_id" class="form-select" required>
                                <option value="">Subkategoriya tanlang</option>
                                @php
                                    $currentCategory = $categories->where('id', old('category_id', $product->category_id))->first();
                                    $subcategories = $currentCategory ? $currentCategory->subcategories : collect();
                                @endphp
                                @foreach($subcategories as $subcategory)
                                    <option
                                        value="{{ $subcategory->id }}" {{ old('subcategory_id', $product->subcategory_id) == $subcategory->id ? 'selected' : '' }}>
                                        {{ $subcategory->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="region_id" class="form-label fw-semibold">Viloyat</label>
                            <select id="region_id" name="region_id" class="form-select" required>
                                <option value="">Viloyat tanlang</option>
                                @foreach($address as $region)
                                    <option
                                        value="{{ $region->id }}" {{ old('region_id', $product->region_id) == $region->id ? 'selected' : '' }}>
                                        {{ $region->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="city_id" class="form-label fw-semibold">Tuman / Shahar</label>
                            <select id="city_id" name="city_id" class="form-select" required>
                                <option value="">Tuman/shahar tanlang</option>
                                @php
                                    $currentRegion = $address->where('id', old('region_id', $product->region_id))->first();
                                    $cities = $currentRegion ? $currentRegion->cities : collect();
                                @endphp
                                @foreach($cities as $city)
                                    <option
                                        value="{{ $city->id }}" {{ old('city_id', $product->city_id) == $city->id ? 'selected' : '' }}>
                                        {{ $city->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="price" class="form-label fw-semibold">Narxi</label>
                            <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}"
                                   class="form-control" placeholder="Narxi">
                        </div>
                        <div class="col-md-12">
                            <label for="description" class="form-label fw-semibold">Tavsifi</label>
                            <textarea name="description" id="description" class="form-control"
                                      placeholder="Mahsulot haqida qisqacha"
                                      rows="3">{{ old('description', $product->description) }}</textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="images" class="form-label fw-semibold">Rasmlar</label>
                            <input type="file" name="images[]" id="images" class="form-control" multiple>
                            <small class="form-text text-muted">Bir nechta rasm tanlashingiz mumkin.</small>
                            <div class="mt-2 d-flex flex-wrap gap-2" id="product-images-list">
                                @if($product->images)
                                    @foreach($images as $index => $img)
                                        <div class="position-relative d-inline-block" style="width: 80px; height: 80px;">
                                            <img src="{{ asset('storage/' . $img) }}" class="rounded"
                                                 style="width: 80px; height: 80px; object-fit: cover;"/>
                                            <button type="button"
                                                    class="btn btn-danger btn-sm position-absolute top-0 end-0 px-1 py-0 remove-image-btn"
                                                    data-index="{{ $index }}"
                                                    style="z-index:2; font-size:20px; line-height:16px;">&times;
                                            </button>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <input type="hidden" name="remove_images" id="remove_images" value="">
                        </div>
                        <div class="col-md-6">
                            <label for="phone" class="form-label fw-semibold">Telefon</label>
                            <input type="text" name="phone" id="phone" value="{{ old('phone', $product->phone) }}"
                                   class="form-control" placeholder="+998901234567" maxlength="13" minlength="9">
                        </div>
                        <div class="col-md-4">
                            <label for="floor" class="form-label fw-semibold">Qavat</label>
                            <input type="number" name="floor" id="floor" value="{{ old('floor', $product->floor) }}"
                                   class="form-control" placeholder="1" min="1">
                        </div>
                        <div class="col-md-4">
                            <label for="building_floor" class="form-label fw-semibold">Bino qavati</label>
                            <input type="number" name="building_floor" id="building_floor"
                                   value="{{ old('building_floor', $product->building_floor) }}" class="form-control"
                                   placeholder="1" min="1">
                        </div>
                        <div class="col-md-4">
                            <label for="square" class="form-label fw-semibold">Maydon (kv.m)</label>
                            <input type="number" name="square" id="square" value="{{ old('square', $product->square) }}"
                                   class="form-control" placeholder="50" min="1">
                        </div>
                        <div class="col-md-4">
                            <label for="rooms" class="form-label fw-semibold">Xonalar soni</label>
                            <input type="number" name="rooms" id="rooms" value="{{ old('rooms', $product->rooms) }}"
                                   class="form-control" placeholder="5" min="1">
                        </div>
                        <div class="col-md-4">
                            <label for="repair" class="form-label fw-semibold">Remont</label>
                            <input type="text" name="repair" id="repair" value="{{ old('repair', $product->repair) }}"
                                   class="form-control" placeholder="Yevro remont">
                        </div>
                        <div class="col-md-4">
                            <label for="sotix" class="form-label fw-semibold">Sotix</label>
                            <input type="text" name="sotix" id="sotix" value="{{ old('sotix', $product->sotix) }}"
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
@endsection
