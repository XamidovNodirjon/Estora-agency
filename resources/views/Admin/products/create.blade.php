@extends('layouts.admin_layout')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h4 class="text-center">{{__('Create Product')}}</h4>
            </div>

            <div class="card-body">
                <form id="product-form" action="{{ route('store-product') }}" method="post"
                      enctype="multipart/form-data" novalidate>
                    @csrf
                    <div class="wizard-nav">
                        <div class="wizard-step active" data-step="1">
                            <div class="step-number">1</div>
                            <div class="step-title">{{__('Basic Information')}}</div>
                        </div>
                        <div class="wizard-step" data-step="2">
                            <div class="step-number">2</div>
                            <div class="step-title">{{__('Location & Price')}}</div>
                        </div>
                        <div class="wizard-step" data-step="3">
                            <div class="step-number">3</div>
                            <div class="step-title">{{__('Details')}}</div>
                        </div>
                        <div class="wizard-step" data-step="4">
                            <div class="step-number">4</div>
                            <div class="step-title">{{__('Media & Contact')}}</div>
                        </div>
                    </div>

                    <div class="wizard-content active" data-step-content="1">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="type">{{__('Ad type')}}<span class="text-danger"></span></label>
                                <select id="type" name="name" class="form-control" required>
                                    <option value="">{{__('Select ad type')}}</option>
                                    <option value="rent">{{__('Rent')}}</option>
                                    <option value="sale">{{__('Sale')}}</option>
                                    <option value="expats">{{__('Expats')}}</option>
                                </select>
                                <div class="invalid-feedback">{{__("Please select ad type")}}</div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="category">{{__('Category')}}<span class="text-danger"></span></label>
                                <select id="category" name="category_id" class="form-control" required>
                                    <option value="">{{__('Select a category')}}</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">{{__('Please select a category')}}</div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="subcategory">{{__('Sub category')}}<span class="text-danger"></span></label>
                                <select id="subcategory" name="subcategory_id" class="form-control" required disabled>
                                    <option value="">{{__('Select a sub category')}}</option>
                                </select>
                                <div class="invalid-feedback">{{__('Please select a sub category')}}</div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="repair">{{__("Repair")}}<span class="text-danger"></span></label>
                                <select id="repair" name="repair" class="form-control" required>
                                    <option value="">{{__("Repair status")}}</option>
                                    <option value="euro_repair">{{__('Euro repair')}}</option>
                                    <option value="medium_repair">{{__('Medium repair')}}</option>
                                    <option value="repair_required">{{__('Repair required')}}</option>
                                    <option value="white_box">{{__('White box')}}</option>
                                    <option value="box">{{__('Box without repair')}}</option>
                                </select>
                                <div class="invalid-feedback">{{__('Please select a repair status')}}</div>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="description">{{__('Description')}}<span class="text-danger"></span></label>
                                <textarea name="description" id="description" class="form-control"
                                          placeholder="{{__('Enter product information')}}" rows="3"
                                          required></textarea>
                                <div class="invalid-feedback">{{__('Please enter a description')}}</div>
                            </div>
                        </div>
                    </div>

                    <div class="wizard-content" data-step-content="2">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="region_id">{{__('Province')}}<span class="text-danger"></span></label>
                                <select id="region_id" name="region_id" class="form-control" required>
                                    <option value="">{{__('Select province')}}</option>
                                    @foreach($address as $region)
                                        <option value="{{ $region->id }}">{{ $region->name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">{{__('Please select a province')}}</div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="city_id">{{__('District / City')}} <span class="text-danger"></span></label>
                                <select id="city_id" name="city_id" class="form-control" required disabled>
                                    <option value="">{{__('Select a district/city')}}</option>
                                </select>
                                <div class="invalid-feedback">{{__('Please select a district/city')}}</div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="price">{{__('Price')}}<span class="text-danger"></span></label>
                                <input type="number" name="price" id="price" class="form-control"
                                       placeholder="{{__('Price')}}"
                                       required>
                                <div class="invalid-feedback">{{__('Please select a price')}}</div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="sotix">Sotix</label>
                                <input type="text" name="sotix" id="sotix" class="form-control" placeholder="50">
                            </div>

                            <div class="form-group col-md-12">
                                <label class="d-block mb-3">{{__('Additional options')}}</label>
                                <div class="toggle-column">
                                    <div class="toggle-item">
                                        <input type="hidden" name="exchange" value="0">
                                        <input type="checkbox" name="exchange" id="exchange" class="toggle-input"
                                               value="1" {{ old('exchange', $product->exchange ?? false) ? 'checked' : '' }}>
                                        <label for="exchange" class="toggle-label">
                                            <span class="toggle-switch"></span>
                                            <span class="toggle-text">{{__('Exchange')}}</span>
                                        </label>
                                    </div>

                                    <div class="toggle-item">
                                        <input type="hidden" name="credit" value="0">
                                        <input type="checkbox" name="credit" id="credit" class="toggle-input"
                                               value="1" {{ old('credit', $product->credit ?? false) ? 'checked' : '' }}>
                                        <label for="credit" class="toggle-label">
                                            <span class="toggle-switch"></span>
                                            <span class="toggle-text">Ipoteka credit</span>
                                        </label>
                                    </div>

                                    <div class="toggle-item">
                                        <input type="hidden" name="pay_in_installments" value="0">
                                        <input type="checkbox" name="pay_in_installments" id="pay_in_installments"
                                               class="toggle-input"
                                               value="1" {{ old('pay_in_installments', $product->pay_in_installments ?? false) ? 'checked' : '' }}>
                                        <label for="pay_in_installments" class="toggle-label">
                                            <span class="toggle-switch"></span>
                                            <span class="toggle-text">Installment / Payment in installments</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="wizard-content" data-step-content="3">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="floor">{{__('Floor')}}<span class="text-danger"></span></label>
                                <input type="number" name="floor" id="floor" class="form-control" placeholder="1"
                                       min="1" required>
                                <div class="invalid-feedback">{{__('Please select a floor')}}</div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="building_floor">{{__('Building floor')}}<span
                                        class="text-danger"></span></label>
                                <input type="number" name="building_floor" id="building_floor" class="form-control"
                                       placeholder="1" min="1" required>
                                <div class="invalid-feedback">Please enter the building floor</div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="square">Area (m²)<span class="text-danger"></span></label>
                                <input type="number" name="square" id="square" class="form-control" placeholder="50"
                                       min="1" required>
                                <div class="invalid-feedback">{{__('Please enter the field')}}</div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="rooms">{{__('Number of rooms')}}<span class="text-danger"></span></label>
                                <input type="number" name="rooms" id="rooms" class="form-control" placeholder="5"
                                       min="1" required>
                                <div class="invalid-feedback">{{__('Please enter the number of rooms.')}}</div>
                            </div>
                        </div>
                    </div>

                    <div class="wizard-content" data-step-content="4">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="images">{{__('Photos')}}<span class="text-danger"></span></label>
                                <input type="file" name="images[]" id="images" class="form-control-file" multiple
                                       required>
                                <small class="form-text text-muted">You can select multiple images.</small>
                                <div class="invalid-feedback">{{__('Please upload at least one image.')}}</div>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="phone">{{__('Phone')}}<span class="text-danger"></span></label>
                                <input type="text" name="phone" id="phone" class="form-control"
                                       placeholder="+998901234567" maxlength="13" minlength="9" required>
                                <div class="invalid-feedback">{{__('Please enter your phone number.')}}</div>
                            </div>
                        </div>
                    </div>

                    <div class="wizard-controls">
                        <button type="button" class="wizard-prev-btn btn btn-secondary" disabled>
                            <i class="fas fa-arrow-left mr-2"></i>{{__('To back')}}
                        </button>

                        <button type="button" class="wizard-next-btn btn btn-primary">
                            {{__('Next')}}<i class="fas fa-arrow-right ml-2"></i>
                        </button>

                        <button type="submit" class="wizard-submit-btn btn btn-success" style="display: none;">
                            <i class="fas fa-check-circle mr-2"></i> {{__('Creat')}}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        .wizard-nav {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 1px solid #e0e0e0;
            position: relative;
        }

        .wizard-step {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            flex: 1;
            cursor: pointer;
            padding: 0 10px;
        }

        .wizard-step:not(:last-child):after {
            content: '';
            position: absolute;
            top: 20px;
            left: 60%;
            width: 80%;
            height: 2px;
            background-color: #e0e0e0;
            z-index: 0;
        }

        .wizard-step.active:not(:last-child):after {
            background-color: #4CAF50;
        }

        .step-number {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #fff;
            border: 2px solid #e0e0e0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            color: #6c757d;
            position: relative;
            z-index: 1;
            transition: all 0.3s ease;
        }

        .wizard-step.active .step-number {
            border-color: #4CAF50;
            background-color: #4CAF50;
            color: white;
            box-shadow: 0 4px 8px rgba(76, 175, 80, 0.2);
        }

        .step-title {
            margin-top: 8px;
            font-size: 14px;
            font-weight: 500;
            color: #6c757d;
            text-align: center;
            transition: all 0.3s ease;
        }

        .wizard-step.active .step-title {
            color: #4CAF50;
            font-weight: 600;
        }

        /* Wizard Content */
        .wizard-content {
            display: none;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .wizard-content.active {
            display: block;
            animation: fadeIn 0.4s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Form Styling */
        .form-row {
            display: flex;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
        }

        .form-group {
            padding-right: 15px;
            padding-left: 15px;
            margin-bottom: 1.5rem;
            flex: 0 0 100%;
            max-width: 100%;
        }

        @media (min-width: 768px) {
            .form-group {
                flex: 0 0 50%;
                max-width: 50%;
            }
        }

        label {
            display: inline-block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #444;
        }

        .form-control {
            display: block;
            width: 100%;
            padding: 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: 6px;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .form-control:focus {
            color: #495057;
            background-color: #fff;
            border-color: #80bdff;
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        textarea.form-control {
            height: auto;
            min-height: 120px;
        }

        .form-control-file {
            display: block;
            width: 100%;
        }

        /* Wizard Controls */
        .wizard-controls {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e0e0e0;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 500;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            user-select: none;
            border: 1px solid transparent;
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            line-height: 1.5;
            border-radius: 6px;
            transition: all 0.3s ease;
            min-width: 120px;
        }

        .btn-secondary {
            color: #fff;
            background-color: #6c757d;
            border-color: #6c757d;
        }

        .btn-secondary:hover {
            color: #fff;
            background-color: #5a6268;
            border-color: #545b62;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            color: #fff;
            background-color: #4CAF50;
            border-color: #4CAF50;
        }

        .btn-primary:hover {
            color: #fff;
            background-color: #3d8b40;
            border-color: #368239;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(76, 175, 80, 0.3);
        }

        .btn-success {
            color: #fff;
            background-color: #2196F3;
            border-color: #2196F3;
        }

        .btn-success:hover {
            color: #fff;
            background-color: #0b7dda;
            border-color: #0a76d1;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(33, 150, 243, 0.3);
        }

        /* Toggle Switches Column */
        .toggle-column {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-top: 10px;
        }

        .toggle-item {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .toggle-item:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .toggle-input {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        .toggle-label {
            display: flex;
            align-items: center;
            cursor: pointer;
            width: 100%;
            justify-content: space-between;
        }

        .toggle-switch {
            position: relative;
            width: 60px;
            height: 30px;
            background-color: #e0e0e0;
            border-radius: 34px;
            transition: background-color 0.3s;
        }

        .toggle-switch:after {
            content: "";
            position: absolute;
            width: 26px;
            height: 26px;
            border-radius: 50%;
            background-color: white;
            top: 2px;
            left: 2px;
            transition: transform 0.3s;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .toggle-input:checked + .toggle-label .toggle-switch {
            background-color: #4CAF50;
        }

        .toggle-input:checked + .toggle-label .toggle-switch:after {
            transform: translateX(30px);
        }

        .toggle-text {
            font-size: 15px;
            color: #333;
            font-weight: 500;
            margin-right: 15px;
        }

        /* Validation */
        .is-invalid {
            border-color: #dc3545 !important;
        }

        .invalid-feedback {
            width: 100%;
            margin-top: 0.4rem;
            font-size: 0.85rem;
            color: #dc3545;
            display: none;
        }

        .is-invalid ~ .invalid-feedback {
            display: block;
        }

        .text-danger {
            color: #dc3545;
        }

        /* Required field indicator */
        label:has(+ .form-control[required])::after,
        label:has(+ select[required])::after {
            content: " *";
            color: #dc3545;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Wizard functionality
            const form = document.getElementById('product-form');
            const steps = document.querySelectorAll('.wizard-step');
            const stepContents = document.querySelectorAll('[data-step-content]');
            const prevBtn = document.querySelector('.wizard-prev-btn');
            const nextBtn = document.querySelector('.wizard-next-btn');
            const submitBtn = document.querySelector('.wizard-submit-btn');
            let currentStep = 1;

            function updateWizard() {
                steps.forEach(step => {
                    const stepNum = parseInt(step.dataset.step);
                    if (stepNum === currentStep) {
                        step.classList.add('active');
                    } else {
                        step.classList.remove('active');
                    }
                });

                stepContents.forEach(content => {
                    const contentStep = parseInt(content.dataset.stepContent);
                    if (contentStep === currentStep) {
                        content.classList.add('active');
                    } else {
                        content.classList.remove('active');
                    }
                });

                if (currentStep === 1) {
                    prevBtn.disabled = true;
                    nextBtn.style.display = 'flex';
                    submitBtn.style.display = 'none';
                } else if (currentStep === steps.length) {
                    nextBtn.style.display = 'none';
                    submitBtn.style.display = 'flex';
                } else {
                    prevBtn.disabled = false;
                    nextBtn.style.display = 'flex';
                    submitBtn.style.display = 'none';
                }

                form.scrollIntoView({behavior: 'smooth', block: 'start'});
            }

            nextBtn.addEventListener('click', function () {
                if (validateStep(currentStep)) {
                    currentStep++;
                    updateWizard();
                }
            });

            prevBtn.addEventListener('click', function () {
                currentStep--;
                updateWizard();
            });

            steps.forEach(step => {
                step.addEventListener('click', function () {
                    const stepNum = parseInt(this.dataset.step);
                    if (stepNum < currentStep) {
                        currentStep = stepNum;
                        updateWizard();
                    }
                });
            });

            function validateStep(step) {
                let isValid = true;
                const currentContent = document.querySelector(`[data-step-content="${step}"]`);
                const requiredFields = currentContent.querySelectorAll('[required]');

                currentContent.querySelectorAll('.is-invalid').forEach(el => {
                    el.classList.remove('is-invalid');
                });

                requiredFields.forEach(field => {
                    if (!field.value || (field.type === 'file' && field.files.length === 0)) {
                        field.classList.add('is-invalid');
                        isValid = false;

                        if (isValid === false) {
                            field.scrollIntoView({behavior: 'smooth', block: 'center'});
                        }
                    }
                });

                return isValid;
            }

            form.addEventListener('submit', function (e) {
                let allValid = true;

                for (let i = 1; i <= steps.length; i++) {
                    if (!validateStep(i)) {
                        allValid = false;
                        currentStep = i;
                        updateWizard();
                        break;
                    }
                }

                if (!allValid) {
                    e.preventDefault();
                    alert("Please fill in all required fields!");
                }
            });

            const categorySelect = document.getElementById('category');
            const subcategorySelect = document.getElementById('subcategory');
            const regionSelect = document.getElementById('region_id');
            const citySelect = document.getElementById('city_id');

            // Category and Subcategory
            categorySelect.addEventListener('change', function () {
                const categoryId = this.value;
                subcategorySelect.innerHTML = '<option value="">Loading...</option>';
                subcategorySelect.disabled = true;

                if (categoryId) {
                    fetch(`/subcategories/${categoryId}`)
                        .then(response => response.json())
                        .then(data => {
                            subcategorySelect.innerHTML = '<option value="">Select a subcategory...</option>';
                            if (data.length > 0) {
                                data.forEach(subcategory => {
                                    const option = document.createElement('option');
                                    option.value = subcategory.id;
                                    option.textContent = subcategory.name;
                                    subcategorySelect.appendChild(option);
                                });
                                subcategorySelect.disabled = false;
                            } else {
                                subcategorySelect.innerHTML = '<option value="">No subcategories found</option>';
                                subcategorySelect.disabled = true;
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            subcategorySelect.innerHTML = '<option value="">Loading error</option>';
                            subcategorySelect.disabled = true;
                        });
                } else {
                    subcategorySelect.innerHTML = '<option value="">Select a subcategory</option>';
                    subcategorySelect.disabled = true;
                }
            });

            regionSelect.addEventListener('change', function () {
                const regionId = this.value;
                citySelect.innerHTML = '<option value="">Loading...</option>';
                citySelect.disabled = true;

                if (regionId) {
                    fetch(`{{ route('get-cities', ['region_id' => 'PLACEHOLDER']) }}`.replace('PLACEHOLDER', regionId))
                        .then(response => response.json())
                        .then(data => {
                            citySelect.innerHTML = '<option value="">Select a district/city</option>';
                            if (data.length > 0) {
                                data.forEach(city => {
                                    const option = document.createElement('option');
                                    option.value = city.id;
                                    option.textContent = city.name;
                                    citySelect.appendChild(option);
                                });
                                citySelect.disabled = false;
                            } else {
                                citySelect.innerHTML = '<option value="">District/city not found</option>';
                                citySelect.disabled = true;
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            citySelect.innerHTML = '<option value="">Loading error</option>';
                            citySelect.disabled = true;
                        });
                } else {
                    citySelect.innerHTML = '<option value="">Select a district/city</option>';
                    citySelect.disabled = true;
                }
            });

            updateWizard();
            subcategorySelect.disabled = true;
            citySelect.disabled = true;
        });
    </script>
@endsection
