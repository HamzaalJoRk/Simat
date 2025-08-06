@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>اضافة أمانة</h2>
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <form action="{{ route('insurances.store') }}" method="POST" id="insurance-form">
            @csrf
            <div class="row mb-2">
                <div class="col-md-3">
                    <label class="form-label">اسم السائق</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">نوع المركبة</label>
                    <select name="vehicle_type" id="vehicle_type" class="form-control" required>
                        @if (auth()->user()->hasRole('Tourist Insurance'))
                            <option value="">-- اختر النوع --</option>
                            <option value="سيارة خاصة">سيارة خاصة</option>
                            <option value="سيارة عمومية">سيارة عمومية</option>
                            <option value="حافلة عمومي">حافلة عمومي</option>
                            <option value="فان مغلقة">فان مغلقة</option>
                            <option value="بولمان">بولمان</option>
                        @elseif (auth()->user()->hasRole('Cargo Insurance'))
                            <option value="شحن">شحن</option>
                        @endif
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="form-label">الطراز</label>
                    <input type="text" name="model" class="form-control" required>
                </div>

                <div class="col-md-3">
                    <label class="form-label">رقم الشاسيه</label>
                    <input type="text" name="chassis_number" class="form-control" required>
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-md-3">
                    <label class="form-label">رقم اللوحة</label>
                    <input type="text" name="plate_number" class="form-control" required>
                </div>

                <div class="col-md-3">
                    <label class="form-label">المدة الزمنية (يوم)</label>
                    <select name="duration" id="duration" class="form-control" required>
                        <option value="">-- اختر المدة --</option>
                        <option value="30">30</option>
                        <option value="90">90</option>
                        <option value="182">182</option>
                        <option value="365">365</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="form-label">بداية التأمين</label>
                    <input type="date" name="start_date" class="form-control" value="{{ date('Y-m-d') }}" required>
                </div>

                <div class="col-md-3">
                    <label class="form-label">الرسوم</label>
                    <input type="number" step="0.01" name="amount_numeric" id="amount_numeric" class="form-control" readonly
                        required>
                </div>

            </div>

            <div class="row mb-2">

                <div class="col-md-9">
                    <label class="form-label">ملاحظات</label>
                    <input class="form-control" name="notes" class="form-control">
                </div>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary px-5">حفظ</button>
            </div>
        </form>
    </div>

    @if (session('print_id'))
        <script>
            window.addEventListener('DOMContentLoaded', function () {
                if (localStorage.getItem('open_receipt') === 'yes') {
                    localStorage.removeItem('open_receipt');
                    window.open("{{ route('insurances.receipt', session('print_id')) }}");
                }
            });
        </script>
    @endif

    <script>
        document.getElementById('insurance-form').addEventListener('submit', function () {
            localStorage.setItem('open_receipt', 'yes');
        });
    </script>


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
        });
    </script>
@endsection