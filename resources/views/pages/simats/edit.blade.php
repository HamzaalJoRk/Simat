@extends('layouts.app')

@section('content')
    <div class="ml-4 mr-4">
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('simats.update', $simat->id) }}" method="POST" id="simat-form">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-4 mb-2">
                    <label>الاسم:</label>
                    <input type="text" name="name" value="{{ old('name', $simat->name) }}" class="form-control" required>
                </div>

                <div class="col-md-4 mb-2">
                    <label>اسم الأم:</label>
                    <input type="text" name="mother_name" value="{{ old('mother_name', $simat->mother_name) }}"
                        class="form-control">
                </div>

                <div class="col-md-4 mb-2">
                    <label>تاريخ الميلاد:</label>
                    <input type="text" name="birth_date" value="{{ old('birth_date', $simat->birth_date) }}"
                        class="form-control">
                </div>

                <div class="col-md-4 mb-2">
                    <label>رقم الجواز:</label>
                    <input type="text" name="passport_number" value="{{ old('passport_number', $simat->passport_number) }}"
                        class="form-control" required>
                </div>

                <div class="col-md-4 mb-2 position-relative">
                    <label>الجنسية:</label>
                    <input type="text" id="nationalitySearchInput" class="form-control" placeholder="ابحث عن الجنسية..."
                        autocomplete="off" value="{{ old('nationality', $simat->nationality) }}">
                    <input type="hidden" name="nationality" id="selectedNationalityName"
                        value="{{ old('nationality', $simat->nationality) }}">
                    <input type="hidden" name="selected_nationality_id" id="selectedNationalityId"
                        value="{{ old('selected_nationality_id') }}">

                    <ul id="nationalityList" class="list-group position-absolute w-100"
                        style="z-index: 1000; max-height: 200px; overflow-y: auto; display: none;">
                        @foreach($nationalities as $id => $name)
                            <li class="list-group-item nationality-item" data-id="{{ $id }}">{{ $name }}</li>
                        @endforeach
                    </ul>
                </div>

                <div class="col-md-4 mb-2">
                    <label>نوع السمة:</label>
                    <select name="visa_type" id="visa_type" class="form-control" required>
                        <option value="">اختر النوع</option>
                        <option value="مرور" {{ old('visa_type', $simat->visa_type) == 'مرور' ? 'selected' : '' }}>مرور
                        </option>
                        <option value="دخول" {{ old('visa_type', $simat->visa_type) == 'دخول' ? 'selected' : '' }}>دخول
                        </option>
                    </select>
                </div>

                <div class="col-md-4 mb-2">
                    <label>الرسوم:</label>
                    <select name="fee_id" id="fee_select" class="form-control" required>
                        <option value="">اختر الجنسية والنوع أولاً</option>
                    </select>
                </div>

                <div class="col-md-4 mb-2">
                    <label>رسوم عمالة:</label>
                    <input type="number" name="labor_fee" value="{{ old('labor_fee', $simat->labor_fee) }}"
                        class="form-control">
                </div>
            </div>

            <div class="text-center mt-1">
                <button type="submit" class="btn btn-success px-5">تحديث</button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const input = document.getElementById('nationalitySearchInput');
            const list = document.getElementById('nationalityList');
            const items = list.querySelectorAll('.nationality-item');
            const hiddenInputName = document.getElementById('selectedNationalityName');
            const hiddenInputId = document.getElementById('selectedNationalityId');

            const selectedName = hiddenInputName.value;
            if (selectedName) {
                const selectedItem = Array.from(items).find(item => item.textContent.trim() === selectedName.trim());
                if (selectedItem) {
                    input.value = selectedItem.textContent;
                    hiddenInputId.value = selectedItem.dataset.id;
                }
            }

            input.addEventListener('input', function () {
                const search = this.value.toLowerCase().trim();
                let anyMatch = false;

                items.forEach(item => {
                    const match = item.textContent.toLowerCase().includes(search);
                    item.style.display = match ? 'block' : 'none';
                    if (match) anyMatch = true;
                });

                list.style.display = anyMatch ? 'block' : 'none';
            });

            items.forEach(item => {
                item.addEventListener('click', function () {
                    input.value = this.textContent;
                    hiddenInputName.value = this.textContent;
                    hiddenInputId.value = this.dataset.id;
                    list.style.display = 'none';
                    input.blur();
                    setTimeout(filterFees, 100);
                });
            });

            document.addEventListener('click', function (e) {
                if (!e.target.closest('.position-relative')) {
                    list.style.display = 'none';
                }
            });
        });
    </script>

    <script>
        const fees = @json($fees);

        document.addEventListener('DOMContentLoaded', function () {
            const nationalityHiddenInput = document.getElementById('selectedNationalityId');
            const visaTypeSelect = document.getElementById('visa_type');
            const feeSelect = document.getElementById('fee_select');
            const oldFeeId = "{{ old('fee_id', $simat->fee_id ?? '') }}";

            function filterFees() {
                const nationalityId = nationalityHiddenInput.value;
                const visaType = visaTypeSelect.value;

                feeSelect.innerHTML = '';

                if (nationalityId && visaType) {
                    const filtered = fees.filter(fee =>
                        fee.nationality_id == nationalityId && fee.type === visaType
                    );

                    if (filtered.length > 0) {
                        feeSelect.disabled = false;
                        let defaultOption = document.createElement('option');
                        defaultOption.value = '';
                        defaultOption.textContent = 'اختر الرسوم';
                        feeSelect.appendChild(defaultOption);

                        filtered.forEach(fee => {
                            let option = document.createElement('option');
                            option.value = fee.id;
                            option.textContent = `${fee.type} - ${fee.duration} - ${parseFloat(fee.amount).toFixed(2)}`;
                            if (oldFeeId && oldFeeId == fee.id) {
                                option.selected = true;
                            }
                            feeSelect.appendChild(option);
                        });
                    } else {
                        feeSelect.disabled = true;
                        let option = document.createElement('option');
                        option.value = '';
                        option.textContent = 'لا توجد رسوم متاحة';
                        feeSelect.appendChild(option);
                    }
                } else {
                    feeSelect.disabled = true;
                    let option = document.createElement('option');
                    option.value = '';
                    option.textContent = 'اختر الجنسية والنوع أولاً';
                    feeSelect.appendChild(option);
                }
            }

            visaTypeSelect.addEventListener('change', filterFees);
            if (nationalityHiddenInput.value && visaTypeSelect.value) {
                filterFees();
            }
        });
    </script>
@endsection