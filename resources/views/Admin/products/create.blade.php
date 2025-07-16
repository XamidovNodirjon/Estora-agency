@extends('layouts.admin_layout')
@section('content')
    <div class="container py-4">
        <div class="card shadow-sm rounded">
            <div class="card-header text-center">
                <h4 class="mb-0 fw-bold">Create Product</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('store-product') }}" method="post" enctype="multipart/form-data" novalidate>
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label fw-semibold">Name</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Product nomi"
                                   required>
                        </div>
                        <div class="col-md-6">
                            <label for="category" class="form-label fw-semibold">Kategoriya</label>
                            <select id="category" name="category_id" class="form-select" required>
                                <option value="">Kategoriya tanlang</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="subcategory" class="form-label fw-semibold">Subkategoriya</label>
                            <select id="subcategory" name="subcategory_id" class="form-select" required>
                                <option value="">Subkategoriya tanlang</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="region_id" class="form-label fw-semibold">Viloyat</label>
                            <select id="region_id" name="region_id" class="form-select" required>
                                <option value="">Viloyat tanlang</option>
                                @foreach($address as $region)
                                    <option value="{{ $region->id }}">{{ $region->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="city_id" class="form-label fw-semibold">Tuman / Shahar</label>
                            <select id="city_id" name="city_id" class="form-select" required>
                                <option value="">Tuman/shahar tanlang</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="price" class="form-label fw-semibold">Narxi</label>
                            <input type="number" name="price" id="price" class="form-control" placeholder="Narxi">
                        </div>
                        <div class="col-md-12">
                            <label for="description" class="form-label fw-semibold">Tavsifi</label>
                            <textarea name="description" id="description" class="form-control"
                                      placeholder="Mahsulot haqida qisqacha" rows="3"></textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="images" class="form-label fw-semibold">Rasmlar</label>
                            <input type="file" name="images[]" id="images" class="form-control" multiple required>
                            <small class="form-text text-muted">Bir nechta rasm tanlashingiz mumkin.</small>
                        </div>
                        <div class="col-md-6">
                            <label for="phone" class="form-label fw-semibold">Telefon</label>
                            <input type="text" name="phone" id="phone" class="form-control" placeholder="+998901234567"
                                   maxlength="13" minlength="9">
                        </div>
                        <div class="col-md-4">
                            <label for="floor" class="form-label fw-semibold">Qavat</label>
                            <input type="number" name="floor" id="floor" class="form-control" placeholder="1" min="1">
                        </div>
                        <div class="col-md-4">
                            <label for="building_floor" class="form-label fw-semibold">Bino qavati</label>
                            <input type="number" name="building_floor" id="building_floor" class="form-control"
                                   placeholder="1" min="1">
                        </div>
                        <div class="col-md-4">
                            <label for="square" class="form-label fw-semibold">Maydon (kv.m)</label>
                            <input type="number" name="square" id="square" class="form-control" placeholder="50"
                                   min="1">
                        </div>
                        <div class="col-md-4">
                            <label for="rooms" class="form-label fw-semibold">Xonalar soni</label>
                            <input type="number" name="rooms" id="rooms" class="form-control" placeholder="5" min="1">
                        </div>
                        <div class="col-md-4">
                            <label for="repair" class="form-label fw-semibold">Remont</label>
                            <input type="text" name="repair" id="repair" class="form-control"
                                   placeholder="Yevro remont">
                        </div>
                        <div class="col-md-4">
                            <label for="sotix" class="form-label fw-semibold">Sotix</label>
                            <input type="text" name="sotix" id="sotix" class="form-control" placeholder="50">
                        </div>
                        <!-- Google Map -->
                        <div class="col-md-12">
                            <label class="form-label fw-semibold mb-2">Joylashuv (xaritadan tanlang)</label>
                            <div style="height:350px;" id="map"></div>
                            <input type="hidden" name="latitude_id" id="latitude_id">
                            <input type="hidden" name="long_id" id="long_id">
                            <div class="row mt-2"></div>
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary px-5 py-2 fw-semibold rounded-pill">Create
                            product
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD1lZcK4FFGcyNjh1sGsZW2x968zYMyfB4"></script>
    <script>
        let map;
        let marker;

        function initMap() {
            // Default center (Tashkent)
            const defaultLatLng = {lat: 41.2995, lng: 69.2401};

            map = new google.maps.Map(document.getElementById("map"), {
                center: defaultLatLng,
                zoom: 12,
            });

            map.addListener("click", (e) => {
                placeMarker(e.latLng);
            });
        }

        function placeMarker(location) {
            if (marker) {
                marker.setPosition(location);
            } else {
                marker = new google.maps.Marker({
                    position: location,
                    map: map,
                });
            }
            document.getElementById('latitude_id').value = location.lat();
            document.getElementById('long_id').value = location.lng();
        }

        window.initMap = initMap;
    </script>
    {{-- Map Loader --}}
    <script>
        // Google Maps must be loaded after window.onload for some admin templates
        window.onload = function () {
            if (typeof google !== 'undefined') {
                initMap();
            }
        }
    </script>
    {{-- Subcategory AJAX --}}
    <script>
        document.getElementById('category').addEventListener('change', function () {
            var categoryId = this.value;
            var subcategorySelect = document.getElementById('subcategory');
            subcategorySelect.innerHTML = '<option value="">Subkategoriya tanlang</option>';

            if (categoryId) {
                fetch('/subcategories/' + categoryId)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(function (subcategory) {
                            subcategorySelect.innerHTML += `<option value="${subcategory.id}">${subcategory.name}</option>`;
                        });
                    });
            }
        });
    </script>
    <script>
        document.getElementById('region_id').addEventListener('change', function () {
            var regionId = this.value;
            var citySelect = document.getElementById('city_id');
            citySelect.innerHTML = '<option value="">Tuman/shahar tanlang</option>';

            if (regionId) {
                fetch('/get-cities/' + regionId)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(function (city) {
                            citySelect.innerHTML += `<option value="${city.id}">${city.name}</option>`;
                        });
                    });
            }
        });
    </script>
@endsection
