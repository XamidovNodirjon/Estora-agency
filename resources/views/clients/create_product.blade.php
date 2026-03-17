@extends('layouts.client_layout')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="page-title m-0">Yangi e'lon yaratish</h1>
</div>

<form id="simple-product-form" action="{{ route('client.products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <!-- Basic Info -->
    <div class="mb-4 mb-md-5">
        <h5 class="fw-bold mb-3 border-bottom pb-2">Asosiy ma'lumotlar</h5>
        <div class="row g-3 g-md-4">
            <div class="col-md-4">
                <label class="form-label fw-bold">E'lon turi</label>
                <select name="name" class="form-select bg-light" required>
                    <option value="">Tanlang</option>
                    <option value="rent">Ijara</option>
                    <option value="sale">Sotish</option>
                    <option value="expats">Expats</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-bold">Kategoriya</label>
                <select id="category_select" name="category_id" class="form-select bg-light" required>
                    <option value="">Tanlang</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-bold">Subkategoriya</label>
                <select id="subcategory_select" name="subcategory_id" class="form-select bg-light" required disabled>
                    <option value="">Kutib turing...</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Details -->
    <div class="mb-4 mb-md-5">
        <h5 class="fw-bold mb-3 border-bottom pb-2">Obyekt tafsilotlari</h5>
        <div class="row g-3 g-md-4">
            <div class="col-md-4">
                <label class="form-label fw-bold">Xolati</label>
                <select name="repair" class="form-select bg-light" required>
                    <option value="">Tanlang</option>
                    <option value="euro_repair">Yevro remont</option>
                    <option value="medium_repair">O'rtacha</option>
                    <option value="repair_required">Ta'mirtalab</option>
                    <option value="white_box">Oq suvoq</option>
                    <option value="box">Qora suvoq</option>
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label fw-bold">Xonalar</label>
                <input type="number" name="rooms" class="form-control bg-light" min="1" required>
            </div>
            <div class="col-md-2">
                <label class="form-label fw-bold">Qavat</label>
                <input type="number" name="floor" class="form-control bg-light" min="1" required>
            </div>
            <div class="col-md-2">
                <label class="form-label fw-bold">Jami qavatlar</label>
                <input type="number" name="building_floor" class="form-control bg-light" min="1" required>
            </div>
            <div class="col-md-2">
                <label class="form-label fw-bold">Maydoni (m²)</label>
                <input type="number" name="square" class="form-control bg-light" min="1" required>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-bold">Sotix (Yer uchun)</label>
                <input type="text" name="sotix" class="form-control bg-light" placeholder="Masalan: 6.5">
            </div>
            <div class="col-md-4">
                <label class="form-label fw-bold">Narxi ($)</label>
                <input type="number" name="price" class="form-control bg-light fw-bold text-success" required>
            </div>
        </div>
    </div>

    <!-- Location -->
    <div class="mb-4 mb-md-5">
        <h5 class="fw-bold mb-3 border-bottom pb-2">Manzil</h5>
        <div class="row g-3 g-md-4">
            <div class="col-md-4">
                <label class="form-label fw-bold">Viloyat</label>
                <select id="region_select" name="region_id" class="form-select bg-light" required>
                    <option value="">Tanlang</option>
                    @foreach($address as $region)
                        <option value="{{ $region->id }}">{{ $region->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-bold">Tuman / Shahar</label>
                <select id="city_select" name="city_id" class="form-select bg-light" required disabled>
                    <option value="">Kutib turing...</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-bold">Mo'ljal</label>
                <input type="text" name="landmark" class="form-control bg-light" required>
            </div>
            
            <div class="col-md-6">
                <label class="form-label fw-bold">Yaqin Metro bekatlari</label>
                <div class="d-flex flex-wrap gap-2">
                    @foreach($metros as $m)
                        <div class="form-check bg-light border p-2 rounded w-auto px-3">
                            <input type="checkbox" name="metro[]" id="metro_{{ $m->id }}" value="{{ $m->id }}" class="form-check-input">
                            <label class="form-check-label small" for="metro_{{ $m->id }}">{{ $m->metro_name }}</label>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Yaqin Universitetlar</label>
                <div class="d-flex flex-wrap gap-2">
                    @foreach($university as $unver)
                        <div class="form-check bg-light border p-2 rounded w-auto px-3">
                            <input type="checkbox" name="university[]" id="unver_{{ $unver->id }}" value="{{ $unver->id }}" class="form-check-input">
                            <label class="form-check-label small" for="unver_{{ $unver->id }}">{{ $unver->university_name }}</label>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Features -->
    <div class="mb-4 mb-md-5">
        <h5 class="fw-bold mb-3 border-bottom pb-2">Qo'shimcha Qulayliklar</h5>
        <div class="row g-3 g-md-4">
            <div class="col-12">
                <div class="d-flex flex-wrap gap-4 mb-4">
                    <div class="form-check form-switch fs-5">
                        <input type="hidden" name="exchange" value="0">
                        <input class="form-check-input" type="checkbox" name="exchange" value="1" id="sw_exchange">
                        <label class="form-check-label ms-2 small" for="sw_exchange">Barter</label>
                    </div>
                    <div class="form-check form-switch fs-5">
                        <input type="hidden" name="credit" value="0">
                        <input class="form-check-input" type="checkbox" name="credit" value="1" id="sw_credit">
                        <label class="form-check-label ms-2 small" for="sw_credit">Ipoteka / Kredit</label>
                    </div>
                    <div class="form-check form-switch fs-5">
                        <input type="hidden" name="pay_in_installments" value="0">
                        <input class="form-check-input" type="checkbox" name="pay_in_installments" value="1" id="sw_pay_in_installments">
                        <label class="form-check-label ms-2 small" for="sw_pay_in_installments">Bo'lib to'lash</label>
                    </div>
                </div>
            </div>
            
            <div class="col-12">
                <label class="form-label fw-bold">Asosiy Qulayliklar</label>
                <div class="d-flex flex-wrap gap-2">
                    @foreach($product_features as $feature)
                        <div class="form-check bg-light border p-2 rounded w-auto px-3">
                            <input type="checkbox" name="features[]" id="feat_{{ $feature->id }}" value="{{ $feature->id }}" class="form-check-input">
                            <label class="form-check-label small" for="feat_{{ $feature->id }}">{{ $feature->feature_name }}</label>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Media -->
    <div class="mb-4 mb-md-5">
        <h5 class="fw-bold mb-3 border-bottom pb-2">Rasmlar va Ta'rif</h5>
        <div class="row g-3 g-md-4">
            <div class="col-12">
                <div class="border rounded bg-light p-4 text-center" style="border-style: dashed !important; border-width: 2px !important; cursor: pointer;" onclick="document.getElementById('images_input').click()">
                    <i class="bi bi-cloud-arrow-up fs-1 text-muted"></i>
                    <p class="m-0 mt-2 fw-bold text-muted">Rasmlarni yuklash uchun bosing</p>
                    <input type="file" name="images[]" id="images_input" class="d-none" multiple required accept="image/*">
                </div>
                <div id="image-previews" class="d-flex flex-wrap gap-3 mt-3"></div>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-bold">Aloqa uchun telefon</label>
                <input type="text" name="phone" class="form-control bg-light" placeholder="+998 90 123 45 67" required>
            </div>
            <div class="col-md-8">
                <label class="form-label fw-bold">Batafsil ma'lumot</label>
                <textarea name="description" class="form-control bg-light" rows="4" placeholder="Obyekt haqida to'liqroq yozing..." required></textarea>
            </div>
        </div>
    </div>

    <div class="text-end">
        <button type="submit" class="btn btn-primary px-5 py-3 fw-bold" style="background-color: var(--sidebar-navy); border: none;">
            E'lonni chop etish
        </button>
    </div>
</form>

@endsection

@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        
        // Subcategory Fetch
        const catSelect = document.getElementById('category_select');
        if(catSelect) {
            catSelect.addEventListener('change', function() {
                const cId = this.value;
                const sub = document.getElementById('subcategory_select');
                sub.innerHTML = '<option value="">Kutib turing...</option>';
                sub.disabled = true;

                if(cId) {
                    fetch(`/subcategories/${cId}`)
                        .then(r => r.json())
                        .then(data => {
                            sub.innerHTML = '<option value="">Tanlang</option>';
                            data.forEach(s => {
                                sub.innerHTML += `<option value="${s.id}">${s.name}</option>`;
                            });
                            sub.disabled = false;
                        });
                }
            });
        }

        // City Fetch
        const regSelect = document.getElementById('region_select');
        if(regSelect) {
            regSelect.addEventListener('change', function() {
                const rId = this.value;
                const city = document.getElementById('city_select');
                city.innerHTML = '<option value="">Kutib turing...</option>';
                city.disabled = true;

                if(rId) {
                    const url = `{{ route('get-cities', ['region_id' => 'PLACEHOLDER']) }}`.replace('PLACEHOLDER', rId);
                    fetch(url)
                        .then(r => r.json())
                        .then(data => {
                            city.innerHTML = '<option value="">Tanlang</option>';
                            data.forEach(c => {
                                city.innerHTML += `<option value="${c.id}">${c.name}</option>`;
                            });
                            city.disabled = false;
                        });
                }
            });
        }

        // Image Handling
        const imgInput = document.getElementById('images_input');
        const previewGrid = document.getElementById('image-previews');
        let currentFiles = [];

        imgInput.addEventListener('change', (e) => {
            const files = Array.from(e.target.files);
            currentFiles = [...currentFiles, ...files];
            renderPreviews();
            updateInputFiles();
        });

        function renderPreviews() {
            previewGrid.innerHTML = '';
            currentFiles.forEach((file, idx) => {
                const div = document.createElement('div');
                div.className = 'position-relative';
                div.style = 'width: 100px; height: 100px;';
                
                const img = document.createElement('img');
                img.style = 'width: 100px; height: 100px; object-fit: cover; border-radius: 8px; border: 1px solid #ddd;';
                const reader = new FileReader();
                reader.onload = (e) => img.src = e.target.result;
                reader.readAsDataURL(file);
                
                const removeBtn = document.createElement('button');
                removeBtn.type = 'button';
                removeBtn.className = 'btn btn-danger btn-sm position-absolute rounded-circle p-0';
                removeBtn.style = 'top: -5px; right: -5px; width: 20px; height: 20px; line-height: 1;';
                removeBtn.innerHTML = '&times;';
                removeBtn.onclick = (e) => {
                    e.stopPropagation();
                    currentFiles.splice(idx, 1);
                    renderPreviews();
                    updateInputFiles();
                };

                div.appendChild(img);
                div.appendChild(removeBtn);
                previewGrid.appendChild(div);
            });
        }

        function updateInputFiles() {
            const dt = new DataTransfer();
            currentFiles.forEach(f => dt.items.add(f));
            imgInput.files = dt.files;
        }
    });
</script>
@endpush
