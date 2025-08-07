@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>تعديل الأمانة</h2>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('insurances.update', $insurance->id) }}" method="POST" id="insurance-form">
            @csrf
            @method('PUT')

            <div class="row mb-2">
                <div class="col-md-3">
                    <label class="form-label">اسم السائق</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $insurance->name) }}" required>
                </div>

                <div class="col-md-3">
                    <label class="form-label">نوع المركبة</label>
                    <select name="vehicle_type" id="vehicle_type" class="form-control" required>
                        @if (auth()->user()->hasRole('Tourist Insurance'))
                            <option value="">-- اختر النوع --</option>
                            @foreach(['سيارة خاصة', 'سيارة عمومية', 'حافلة عمومي', 'فان مغلقة', 'بولمان'] as $type)
                                <option value="{{ $type }}" {{ old('vehicle_type', $insurance->vehicle_type) == $type ? 'selected' : '' }}>{{ $type }}</option>
                            @endforeach
                        @elseif (auth()->user()->hasRole('Cargo Insurance'))
                            <option value="شحن" {{ old('vehicle_type', $insurance->vehicle_type) == 'شحن' ? 'selected' : '' }}>شحن</option>
                        @elseif (auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Super Admin'))
                            @foreach(['سيارة خاصة', 'سيارة عمومية', 'حافلة عمومي', 'فان مغلقة', 'بولمان','شحن'] as $type)
                                <option value="{{ $type }}" {{ old('vehicle_type', $insurance->vehicle_type) == $type ? 'selected' : '' }}>{{ $type }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="form-label">الطراز</label>
                    <input type="text" name="model" class="form-control" value="{{ old('model', $insurance->model) }}" required>
                </div>

                <div class="col-md-3">
                    <label class="form-label">رقم الشاسيه</label>
                    <input type="text" name="chassis_number" class="form-control" value="{{ old('chassis_number', $insurance->chassis_number) }}" required>
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-md-3">
                    <label class="form-label">رقم اللوحة</label>
                    <input type="text" name="plate_number" class="form-control" value="{{ old('plate_number', $insurance->plate_number) }}" required>
                </div>

                <div class="col-md-3">
                    <label class="form-label">المدة الزمنية (يوم)</label>
                    <select name="duration" id="duration" class="form-control" required>
                        <option value="">-- اختر المدة --</option>
                        @foreach([30, 90, 182, 365] as $day)
                            <option value="{{ $day }}" {{ old('duration', $insurance->duration) == $day ? 'selected' : '' }}>{{ $day }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="form-label">بداية التأمين</label>
                    <input type="date" name="start_date" class="form-control"
                        value="{{ old('start_date', \Carbon\Carbon::parse($insurance->start_date)->format('Y-m-d')) }}" required>
                </div>

                <div class="col-md-3">
                    <label class="form-label">الرسوم</label>
                    <input type="number" step="0.01" name="amount_numeric" id="amount_numeric"
                        value="{{ old('amount_numeric', $insurance->amount_numeric) }}"
                        class="form-control" readonly required>
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-md-9">
                    <label class="form-label">ملاحظات</label>
                    <input type="text" name="notes" class="form-control" value="{{ old('notes', $insurance->notes) }}">
                </div>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary px-5">تحديث</button>
            </div>
        </form>
    </div>

    <script>
        const fees = {
            "سيارة خاصة": { "30": 80, "90": 100, "182": 160, "365": 260 },
            "سيارة عمومية": { "30": 180, "90": 240, "182": 350, "365": 590 },
            "حافلة عمومي": { "30": 190, "90": 250, "182": 380, "365": 620 },
            "فان مغلقة": { "30": 110, "90": 140, "182": 210, "365": 340 },
            "بولمان": { "30": 450, "90": 600, "182": 900, "365": 1500 },
            "شحن": { "30": 240, "90": 320, "182": 480, "365": 800 },
        };

        document.addEventListener('DOMContentLoaded', () => {
            const vehicleType = document.getElementById('vehicle_type');
            const duration = document.getElementById('duration');
            const amount = document.getElementById('amount_numeric');

            function updateAmount() {
                const type = vehicleType.value;
                const days = duration.value;
                if (fees[type] && fees[type][days]) {
                    amount.value = fees[type][days];
                } else {
                    amount.value = '';
                }
            }

            vehicleType.addEventListener('change', updateAmount);
            duration.addEventListener('change', updateAmount);

            updateAmount(); // حساب الرسوم عند فتح الصفحة
        });
    </script>
@endsection
