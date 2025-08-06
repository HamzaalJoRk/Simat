@extends('layouts.app')

@section('content')
    <div class="ml-4 mr-4">
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('simats.store') }}" method="POST" id="simat-form">
            @csrf
            <div class="row">
                <div class="col-md-4 mb-2">
                    <label>الاسم:</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
                </div>

                <div class="col-md-4 mb-2">
                    <label>اسم الأم:</label>
                    <input type="text" name="mother_name" value="{{ old('mother_name') }}" class="form-control">
                </div>

                <div class="col-md-4 mb-2">
                    <label>تاريخ الميلاد:</label>
                    <input type="text" name="birth_date" value="{{ old('birth_date') }}" class="form-control"
                        placeholder="dd/mm/yyyy" id="birth_date">
                </div>

                <div class="col-md-4 mb-2">
                    <label>رقم الجواز:</label>
                    <input type="text" name="passport_number" value="{{ old('passport_number') }}" class="form-control"
                        required>
                </div>

                <div class="col-md-4 mb-2 position-relative" style="z-index: 1050;">
                    <label>الجنسية:</label>
                    <input type="text" id="nationalitySearchInput" name="nationality_name" class="form-control"
                        placeholder="ابحث عن الجنسية..." autocomplete="off" value="{{ old('nationality_name', '') }}">
                    <input type="hidden" name="nationality" id="selectedNationalityId" value="{{ old('nationality') }}">

                    <ul id="nationalityList" class="list-group position-absolute w-100"
                        style="max-height: 180px; overflow-y: auto; display: none; background: white; border: 1px solid #ced4da; border-radius: 0 0 0.25rem 0.25rem;">
                        @foreach($nationalities as $id => $name)
                            <li class="list-group-item nationality-item" data-id="{{ $id }}" tabindex="-1"
                                style="cursor: pointer;">{{ $name }}</li>
                        @endforeach
                    </ul>
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', () => {
                        const input = document.getElementById('nationalitySearchInput');
                        const list = document.getElementById('nationalityList');
                        const items = Array.from(list.querySelectorAll('.nationality-item'));
                        const hiddenInput = document.getElementById('selectedNationalityId');
                        let currentIndex = -1;

                        // فلترة القائمة حسب البحث
                        input.addEventListener('input', () => {
                            const val = input.value.trim().toLowerCase();
                            currentIndex = -1;

                            let anyVisible = false;
                            items.forEach(item => {
                                if (item.textContent.toLowerCase().includes(val) && val !== '') {
                                    item.style.display = 'block';
                                    anyVisible = true;
                                } else {
                                    item.style.display = 'none';
                                }
                            });

                            list.style.display = anyVisible ? 'block' : 'none';
                        });

                        // تحكم الأسهم والاختيار
                        input.addEventListener('keydown', (e) => {
                            const visibleItems = items.filter(i => i.style.display === 'block');
                            if (visibleItems.length === 0) return;

                            if (e.key === 'ArrowDown') {
                                e.preventDefault();
                                currentIndex = (currentIndex + 1) % visibleItems.length;
                                visibleItems[currentIndex].focus();
                            } else if (e.key === 'ArrowUp') {
                                e.preventDefault();
                                currentIndex = (currentIndex - 1 + visibleItems.length) % visibleItems.length;
                                visibleItems[currentIndex].focus();
                            } else if (e.key === 'Enter') {
                                e.preventDefault();
                                if (currentIndex >= 0) {
                                    selectItem(visibleItems[currentIndex]);
                                }
                            }
                        });

                        // اختيار عنصر من القائمة
                        items.forEach(item => {
                            item.addEventListener('click', () => selectItem(item));
                            item.addEventListener('keydown', (e) => {
                                if (e.key === 'Enter') {
                                    e.preventDefault();
                                    selectItem(item);
                                }
                            });
                        });

                        // إخفاء القائمة إذا ضغطت خارجها
                        document.addEventListener('click', (e) => {
                            if (!e.target.closest('.position-relative')) {
                                list.style.display = 'none';
                            }
                        });

                        // دالة تعبي الحقول عند اختيار الجنسية
                        function selectItem(item) {
                            input.value = item.textContent;
                            hiddenInput.value = item.dataset.id;
                            list.style.display = 'none';
                            currentIndex = -1;
                            input.focus();
                        }

                        // إذا فيه قيمة محفوظة من قبل تظهرها
                        if (hiddenInput.value) {
                            const selected = items.find(i => i.dataset.id === hiddenInput.value);
                            if (selected) {
                                input.value = selected.textContent;
                            }
                        }
                    });


                </script>

                <!-- <div class="col-md-4 mb-2 position-relative">
                                                                <label>الجنسية:</label>
                                                                <input type="text" id="nationalitySearchInput" class="form-control" placeholder="ابحث عن الجنسية..."
                                                                    autocomplete="off">
                                                                <input type="hidden" name="nationality" id="selectedNationalityName" value="{{ old('nationality') }}">
                                                                <input type="hidden" id="selectedNationalityId" value="{{ old('nationality_id') }}">

                                                                <ul id="nationalityList" class="list-group position-absolute w-100"
                                                                    style="z-index: 1000; max-height: 200px; overflow-y: auto; display: none;">
                                                                    @foreach($nationalities as $id => $name)
                                                                        <li class="list-group-item nationality-item" data-id="{{ $id }}" tabindex="0">{{ $name }}</li>
                                                                    @endforeach
                                                                </ul>
                                                            </div> -->

                <div class="col-md-4 mb-2">
                    <label>نوع السمة:</label>
                    <select name="visa_type" id="visa_type" class="form-control" required>
                        <option value="">اختر النوع</option>
                        <option value="مرور" {{ old('visa_type') == 'مرور' ? 'selected' : '' }}>مرور</option>
                        <option value="دخول" {{ old('visa_type') == 'دخول' ? 'selected' : '' }}>دخول</option>
                    </select>
                </div>

                <div class="col-md-4 mb-2">
                    <label>الرسوم:</label>
                    <select name="fee_id" id="fee_select" class="form-control" required></select>
                </div>

                <div class="col-md-4 mb-2">
                    <label>رسوم عمالة:</label>
                    <input type="number" name="labor_fee" value="{{ old('labor_fee') }}" class="form-control">
                </div>
            </div>

            <div class="text-center mt-1">
                <button type="submit" class="btn btn-success px-5">إضافة</button>
            </div>
        </form>
    </div>

    @if (!session('error') && session('print_id'))
        <form id="receiptForm" action="{{ route('simats.receipt', session('print_id')) }}" method="GET" target="_blank"
            style="display: none;"></form>
        <script>window.onload = () => document.getElementById('receiptForm').submit();</script>
    @endif

    <script>
        document.getElementById('birth_date').addEventListener('input', function (e) {
            let input = e.target.value.replace(/[^\d]/g, '').substring(0, 8);
            let day = input.substring(0, 2);
            let month = input.substring(2, 4);
            let year = input.substring(4, 8);
            let formatted = day;
            if (month) formatted += '/' + month;
            if (year) formatted += '/' + year;
            e.target.value = formatted;
        });
    </script>



    <script>
        const fees = @json($fees);

        document.addEventListener('DOMContentLoaded', function () {
            const nationalityHiddenInput = document.getElementById('selectedNationalityId');
            const visaTypeSelect = document.getElementById('visa_type');
            const feeSelect = document.getElementById('fee_select');
            const oldFeeId = "{{ old('fee_id') }}";

            function filterFees() {
                const nationalityId = nationalityHiddenInput.value;
                const visaType = visaTypeSelect.value;

                feeSelect.innerHTML = '';

                if (nationalityId && visaType) {
                    const filtered = fees.filter(fee => fee.nationality_id == nationalityId && fee.type === visaType);
                    if (filtered.length > 0) {
                        feeSelect.disabled = false;
                        filtered.forEach(fee => {
                            let entryText = '';

                            // تحديد نوع الدخول بناءً على المدة
                            if (fee.duration === '15 يوم' || fee.duration === 'شهر') {
                                entryText = ' (دخول واحد)';
                            } else if (fee.duration === '3 أشهر') {
                                entryText = ' (دخول مرتين)';
                            } else if (fee.duration === '6 أشهر') {
                                entryText = ' (دخول متعدد)';
                            }

                            let option = document.createElement('option');
                            option.value = fee.id;
                            option.textContent = `${fee.type} - ${fee.duration}${entryText} - ${parseFloat(fee.amount).toFixed(2)}`;
                            if (oldFeeId && oldFeeId == fee.id) option.selected = true;
                            feeSelect.appendChild(option);
                        });

                    } else {
                        feeSelect.disabled = true;
                        feeSelect.innerHTML = '<option value="">لا توجد رسوم متاحة</option>';
                    }
                } else {
                    feeSelect.disabled = true;
                    feeSelect.innerHTML = '<option value="">اختر الجنسية والنوع أولاً</option>';
                }
            }

            visaTypeSelect.addEventListener('change', filterFees);
            document.querySelectorAll('.nationality-item').forEach(item => {
                item.addEventListener('click', () => setTimeout(filterFees, 100));
            });

            if (nationalityHiddenInput.value && visaTypeSelect.value) {
                filterFees();
            } else {
                feeSelect.disabled = true;
            }
        });
    </script>
@endsection