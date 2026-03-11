@extends('layouts.admin_layout')

@push('css')
    <link href="{{ asset('css/premium-wizard.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { background-color: #f1f5f9; }
        .is-invalid { border-color: var(--danger) !important; }
        .invalid-feedback { color: var(--danger); font-size: 0.8rem; margin-top: 4px; display: block; }
    </style>
@endpush

@section('content')
<div class="container-fluid py-4">
    <div class="premium-wizard">
        <div class="wizard-header">
            <h2>{{ __('Premium Product Creation') }}</h2>
            <p>{{ __('Fill in the details to create a new state-of-the-art listing') }}</p>
        </div>

        <div class="progress-container">
            <div class="premium-steps">
                <div class="step-indicator active" data-step="1">
                    <div class="step-circle">1</div>
                    <div class="step-label">{{ __('Basic') }}</div>
                </div>
                <div class="step-indicator" data-step="2">
                    <div class="step-circle">2</div>
                    <div class="step-label">{{ __('Details') }}</div>
                </div>
                <div class="step-indicator" data-step="3">
                    <div class="step-circle">3</div>
                    <div class="step-label">{{ __('Location') }}</div>
                </div>
                <div class="step-indicator" data-step="4">
                    <div class="step-circle">4</div>
                    <div class="step-label">{{ __('Extras') }}</div>
                </div>
                <div class="step-indicator" data-step="5">
                    <div class="step-circle">5</div>
                    <div class="step-label">{{ __('Media') }}</div>
                </div>
            </div>
        </div>

        <form id="premium-product-form" action="{{ route('store-product') }}" method="POST" enctype="multipart/form-data" novalidate>
            @csrf
            <div class="wizard-body">
                <!-- Step 1: Ad Info -->
                <div class="premium-content active" data-step-content="1">
                    <h4 class="mb-4 text-primary fw-bold"><i class="fas fa-info-circle me-2"></i>{{ __('Ad Basic Information') }}</h4>
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="premium-label">{{ __('Ad Type') }}</label>
                            <select name="name" class="form-control-premium" required>
                                <option value="">{{ __('Select type') }}</option>
                                <option value="rent">{{ __('Rent') }}</option>
                                <option value="sale">{{ __('Sale') }}</option>
                                <option value="expats">{{ __('Expats') }}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="premium-label">{{ __('Category') }}</label>
                            <select id="category_select" name="category_id" class="form-control-premium" required>
                                <option value="">{{ __('Select category') }}</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group full-width">
                            <label class="premium-label">{{ __('Subcategory') }}</label>
                            <select id="subcategory_select" name="subcategory_id" class="form-control-premium" required disabled>
                                <option value="">{{ __('Select subcategory') }}</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Step 2: Property Details -->
                <div class="premium-content" data-step-content="2">
                    <h4 class="mb-4 text-primary fw-bold"><i class="fas fa-home me-2"></i>{{ __('Property Specifications') }}</h4>
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="premium-label">{{ __('Repair Status') }}</label>
                            <select name="repair" class="form-control-premium" required>
                                <option value="">{{ __('Select status') }}</option>
                                <option value="euro_repair">{{ __('Euro repair') }}</option>
                                <option value="medium_repair">{{ __('Medium repair') }}</option>
                                <option value="repair_required">{{ __('Repair required') }}</option>
                                <option value="white_box">{{ __('White box') }}</option>
                                <option value="box">{{ __('Box without repair') }}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="premium-label">{{ __('Rooms') }}</label>
                            <input type="number" name="rooms" class="form-control-premium" placeholder="e.g. 3" min="1" required>
                        </div>
                        <div class="form-group">
                            <label class="premium-label">{{ __('Floor') }}</label>
                            <input type="number" name="floor" class="form-control-premium" placeholder="e.g. 5" min="1" required>
                        </div>
                        <div class="form-group">
                            <label class="premium-label">{{ __('Total Floors') }}</label>
                            <input type="number" name="building_floor" class="form-control-premium" placeholder="e.g. 9" min="1" required>
                        </div>
                        <div class="form-group">
                            <label class="premium-label">{{ __('Area (m²)') }}</label>
                            <input type="number" name="square" class="form-control-premium" placeholder="e.g. 75" min="1" required>
                        </div>
                        <div class="form-group">
                            <label class="premium-label">{{ __('Sotix (for land)') }}</label>
                            <input type="text" name="sotix" class="form-control-premium" placeholder="e.g. 6.5">
                        </div>
                    </div>
                </div>

                <!-- Step 3: Location -->
                <div class="premium-content" data-step-content="3">
                    <h4 class="mb-4 text-primary fw-bold"><i class="fas fa-map-marker-alt me-2"></i>{{ __('Location & Landmarks') }}</h4>
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="premium-label">{{ __('Province') }}</label>
                            <select id="region_select" name="region_id" class="form-control-premium" required>
                                <option value="">{{ __('Select province') }}</option>
                                @foreach($address as $region)
                                    <option value="{{ $region->id }}">{{ $region->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="premium-label">{{ __('District / City') }}</label>
                            <select id="city_select" name="city_id" class="form-control-premium" required disabled>
                                <option value="">{{ __('Select city') }}</option>
                            </select>
                        </div>
                        <div class="form-group full-width">
                            <label class="premium-label">{{ __('Landmark') }}</label>
                            <textarea name="landmark" class="form-control-premium" rows="2" placeholder="{{ __('What is near?') }}" required></textarea>
                        </div>
                        <div class="form-group full-width">
                            <label class="premium-label">{{ __('Nearby Metro Stations') }}</label>
                            <div class="modern-toggle-group">
                                @foreach($metros as $m)
                                    <div class="modern-toggle-item" onclick="toggleCheckbox('metro_{{ $m->id }}')">
                                        <span class="text-sm font-medium">{{ $m->metro_name }}</span>
                                        <input type="checkbox" name="metro[]" id="metro_{{ $m->id }}" value="{{ $m->id }}" class="form-check-input ms-2" onclick="event.stopPropagation()">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="form-group full-width">
                            <label class="premium-label">{{ __('Nearby Universities') }}</label>
                            <div class="modern-toggle-group">
                                @foreach($university as $unver)
                                    <div class="modern-toggle-item" onclick="toggleCheckbox('unver_{{ $unver->id }}')">
                                        <span class="text-sm font-medium">{{ $unver->university_name }}</span>
                                        <input type="checkbox" name="university[]" id="unver_{{ $unver->id }}" value="{{ $unver->id }}" class="form-check-input ms-2" onclick="event.stopPropagation()">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 4: Pricing & Features -->
                <div class="premium-content" data-step-content="4">
                    <h4 class="mb-4 text-primary fw-bold"><i class="fas fa-tag me-2"></i>{{ __('Pricing & Features') }}</h4>
                    <div class="form-grid">
                        <div class="form-group full-width">
                            <label class="premium-label">{{ __('Price ($)') }}</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="fas fa-dollar-sign text-success"></i></span>
                                <input type="number" name="price" class="form-control-premium border-start-0 fs-4 fw-bold text-success" placeholder="0.00" required>
                            </div>
                        </div>

                        <div class="form-group full-width">
                            <label class="premium-label">{{ __('Additional Options') }}</label>
                            <div class="modern-toggle-group">
                                @php $opts = ['exchange' => 'Exchange', 'credit' => 'Mortgage Credit', 'pay_in_installments' => 'Installments']; @endphp
                                @foreach($opts as $key => $label)
                                    <div class="modern-toggle-item">
                                        <span class="font-medium">{{ __($label) }}</span>
                                        <div class="form-check form-switch p-0">
                                            <input type="hidden" name="{{ $key }}" value="0">
                                            <input type="checkbox" name="{{ $key }}" value="1" class="form-check-input ms-0" id="sw_{{ $key }}">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group full-width">
                            <label class="premium-label">{{ __('Main Features') }}</label>
                            <div class="modern-toggle-group">
                                @foreach($product_features as $feature)
                                    <div class="modern-toggle-item" onclick="toggleCheckbox('feat_{{ $feature->id }}')">
                                        <span class="text-sm font-medium">{{ $feature->feature_name }}</span>
                                        <input type="checkbox" name="features[]" id="feat_{{ $feature->id }}" value="{{ $feature->id }}" class="form-check-input ms-2" onclick="event.stopPropagation()">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 5: Media -->
                <div class="premium-content" data-step-content="5">
                    <h4 class="mb-4 text-primary fw-bold"><i class="fas fa-camera me-2"></i>{{ __('Photos & Final Description') }}</h4>
                    <div class="image-upload-zone" onclick="document.getElementById('images_input').click()">
                        <i class="fas fa-cloud-upload-alt fa-3x text-primary mb-3"></i>
                        <h5>{{ __('Click to upload property photos') }}</h5>
                        <p class="text-muted">{{ __('Drag and drop or select multiple files') }}</p>
                        <input type="file" name="images[]" id="images_input" class="d-none" multiple required>
                    </div>
                    <div id="image-previews" class="preview-grid"></div>

                    <div class="form-grid mt-4">
                        <div class="form-group full-width">
                            <label class="premium-label">{{ __('Contact Phone') }}</label>
                            <input type="text" name="phone" id="phone_mask" class="form-control-premium" placeholder="+998 90 123 45 67" required>
                        </div>
                        <div class="form-group full-width">
                            <label class="premium-label">{{ __('Detailed Description') }}</label>
                            <textarea name="description" class="form-control-premium" rows="5" placeholder="{{ __('Tell more about the property...') }}" required></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="wizard-footer-premium">
                <button type="button" class="btn-premium btn-prev" style="display: none;">
                    <i class="fas fa-chevron-left"></i> {{ __('Back') }}
                </button>
                <div class="ms-auto d-flex gap-2">
                    <button type="button" class="btn-premium btn-next">
                        {{ __('Next Step') }} <i class="fas fa-chevron-right"></i>
                    </button>
                    <button type="submit" class="btn-premium btn-submit" style="display: none;">
                        <i class="fas fa-check-circle"></i> {{ __('Publish Property') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"></script>
<script>
    function toggleCheckbox(id) {
        const cb = document.getElementById(id);
        if(cb) cb.checked = !cb.checked;
    }

    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('premium-product-form');
        const steps = document.querySelectorAll('.step-indicator');
        const contents = document.querySelectorAll('.premium-content');
        const prevBtn = document.querySelector('.btn-prev');
        const nextBtn = document.querySelector('.btn-next');
        const submitBtn = document.querySelector('.btn-submit');
        let currentStep = 1;

        function updateWizard() {
            steps.forEach(s => {
                const sNum = parseInt(s.dataset.step);
                s.classList.remove('active', 'completed');
                if(sNum === currentStep) s.classList.add('active');
                if(sNum < currentStep) s.classList.add('completed');
            });

            contents.forEach(c => {
                c.classList.toggle('active', parseInt(c.dataset.stepContent) === currentStep);
            });

            prevBtn.style.display = currentStep === 1 ? 'none' : 'flex';
            if (currentStep === steps.length) {
                nextBtn.style.display = 'none';
                submitBtn.style.display = 'flex';
            } else {
                nextBtn.style.display = 'flex';
                submitBtn.style.display = 'none';
            }

            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        nextBtn.addEventListener('click', () => {
            if(validateStep(currentStep)) {
                currentStep++;
                updateWizard();
            }
        });

        prevBtn.addEventListener('click', () => {
            currentStep--;
            updateWizard();
        });

        function validateStep(step) {
            const content = document.querySelector(`[data-step-content="${step}"]`);
            const fields = content.querySelectorAll('[required]:not(:disabled)');
            let valid = true;

            content.querySelectorAll('.invalid-feedback').forEach(f => f.remove());
            fields.forEach(f => {
                f.classList.remove('is-invalid');
                if(!f.value || (f.type === 'file' && f.files.length === 0)) {
                    f.classList.add('is-invalid');
                    valid = false;
                    const msg = document.createElement('div');
                    msg.className = 'invalid-feedback';
                    msg.innerText = '{{ __("This field is required") }}';
                    f.parentNode.appendChild(msg);
                }
            });

            if(!valid) {
                const first = content.querySelector('.is-invalid');
                if(first) first.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
            return valid;
        }

        // Subcategory Fetch
        const catSelect = document.getElementById('category_select');
        if(catSelect) {
            catSelect.addEventListener('change', function() {
                const cId = this.value;
                const sub = document.getElementById('subcategory_select');
                sub.innerHTML = '<option value="">{{ __("Loading...") }}</option>';
                sub.disabled = true;

                if(cId) {
                    fetch(`/subcategories/${cId}`)
                        .then(r => r.json())
                        .then(data => {
                            sub.innerHTML = '<option value="">{{ __("Select subcategory") }}</option>';
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
                city.innerHTML = '<option value="">{{ __("Loading...") }}</option>';
                city.disabled = true;

                if(rId) {
                    const url = `{{ route('get-cities', ['region_id' => 'PLACEHOLDER']) }}`.replace('PLACEHOLDER', rId);
                    fetch(url)
                        .then(r => r.json())
                        .then(data => {
                            city.innerHTML = '<option value="">{{ __("Select city") }}</option>';
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
                div.className = 'preview-item';
                
                const img = document.createElement('img');
                const reader = new FileReader();
                reader.onload = (e) => img.src = e.target.result;
                reader.readAsDataURL(file);
                
                const remove = document.createElement('div');
                remove.innerHTML = '<i class="fas fa-times"></i>';
                remove.style = 'position:absolute; top:8px; right:8px; background:white; border-radius:50%; width:28px; height:28px; display:flex; align-items:center; justify-content:center; cursor:pointer; font-weight:bold; color:red; box-shadow:0 2px 5px rgba(0,0,0,0.2); z-index:10;';
                remove.onclick = (e) => {
                    e.stopPropagation();
                    currentFiles.splice(idx, 1);
                    renderPreviews();
                    updateInputFiles();
                };

                div.appendChild(img);
                div.appendChild(remove);
                previewGrid.appendChild(div);
            });
        }

        function updateInputFiles() {
            const dt = new DataTransfer();
            currentFiles.forEach(f => dt.items.add(f));
            imgInput.files = dt.files;
        }

        if (typeof Sortable !== 'undefined' && previewGrid) {
            new Sortable(previewGrid, {
                animation: 150,
                onEnd: () => {
                    const reordered = [];
                    const imgs = previewGrid.querySelectorAll('.preview-item img');
                    // Note: Sorting logic for FileList is complex without tracking files by reference
                    // Note: Sorting visually works, but backend usually handles order via separate field
                }
            });
        }
    });
</script>
@endpush
