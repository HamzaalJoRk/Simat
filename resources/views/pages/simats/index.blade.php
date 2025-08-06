@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-1">
        <h1 class="mb-0">قائمة السمات</h1>
        <div>
            @if (auth()->user()->hasRole('Simats'))
                <a href="{{ route('simats.create') }}" class="btn btn-primary">إضافة سمة</a>
            @endif
            @if (auth()->user()->hasRole('Super Admin'))
                <button id="exportExcel" class="btn btn-success ms-1">
                    <i class="fa fa-file-excel"></i> تصدير إلى Excel
                </button>
            @endif
        </div>
    </div>


    <div class="row mb-1">
        <div class="col-md-4">
            <div class="alert alert-info p-2">
                <h4 class="fw-bold">عدد السمات:</h4>
                <h4 class="fw-bold">{{ $simats->count() }}</h4>
            </div>
        </div>
        <div class="col-md-4">
            <div class="alert alert-success p-2">
                <h4 class="fw-bold">إجمالي رسوم السمات :</h4>
                <h4 class="fw-bold">
                    {{ number_format($simats->sum('fee_number'), 2) }} $
                </h4>
            </div>
        </div>
        <div class="col-md-4">
            <div class="alert alert-success p-2">
                <h4 class="fw-bold">إجمالي رسوم العمالة:</h4>
                <h4 class="fw-bold">
                    {{ number_format($simats->sum('labor_fee'), 2)}} $
                </h4>
            </div>
        </div>
    </div>
    <form method="GET" action="{{ route('simats.index') }}" class="row mb-1">
        <div class="col-md-4">
            <label for="from_date">من تاريخ:</label>
            <input type="date" name="from_date" id="from_date" class="form-control"
                value="{{ old('from_date', $fromDate->toDateString()) }}">
        </div>
        <div class="col-md-4">
            <label for="to_date">إلى تاريخ:</label>
            <input type="date" name="to_date" id="to_date" class="form-control"
                value="{{ old('to_date', $toDate->toDateString()) }}">
        </div>
        <div class="col-md-4 d-flex align-items-end">
            <button type="submit" class="btn btn-primary me-2">بحث</button>
            <a href="{{ route('simats.index') }}" class="btn btn-secondary">إعادة تعيين</a>
        </div>
    </form>
    <div class="table-responsive">
        <table id="simat-table" class="table table-bordered">
            <thead>
                <tr>
                    <th>الاسم</th>
                    <th>اسم الام</th>
                    <th>الميلاد</th>
                    <th>الجنسية</th>
                    <th>رقم جواز السفر</th>
                    <th>تاريخ الدخول</th>
                    <th>نوع السمة</th>
                    <th>مدة الصلاحية</th>
                    <th>الرسوم رقما</th>
                    <th>رمز السمة</th>
                    <th>رسوم عمالة</th>
                    <th>خيارات</th>
                    <th style="display:none;">تاريخ الإنشاء</th>
                </tr>
            </thead>
            <tbody>
                @foreach($simats as $simat)
                    <tr>
                        <td>{{ $simat->name }}</td>
                        <td>{{ $simat->mother_name }}</td>
                        <td>{{ $simat->birth_date }}</td>
                        <td>{{ $simat->nationality }}</td>
                        <td>{{ $simat->passport_number }}</td>
                        <td>{{ $simat->entry_date }}</td>
                        <td>{{ $simat->visa_type }}</td>
                        <td>{{ $simat->validity_duration }}</td>
                        <td>{{ $simat->fee_number }} $</td>
                        <td>{{ $simat->country_code }}</td>
                        <td>{{ $simat->labor_fee }}</td>
                        <td>
                            <a href="{{ route('simats.receipt', $simat->id) }}" target="_blank"
                                class="btn btn-sm btn-secondary mt-1">
                                طباعة إيصال
                            </a>
                            @if (auth()->user()->hasRole('Super Admin'))
                                <a href="{{ route('simats.edit', $simat) }}" class="btn btn-sm btn-info">تعديل</a>

                                <form action="{{ route('simats.destroy', $simat) }}" method="POST" class="d-inline-block"
                                    onsubmit="return confirm('هل أنت متأكد من الحذف؟');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">حذف</button>
                                </form>


                            @endif
                        </td>
                        <td style="display:none;">{{ $simat->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{-- CSS --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
@endsection

@push('scripts')
    {{-- Scripts --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

    <script>
        $(document).ready(function () {
            // نسخ الصف لفلترة الأعمدة
            $('#simat-table thead tr')
                .clone(true)
                .addClass('filters')
                .appendTo('#simat-table thead');

            let table = $('#simat-table').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        text: 'تصدير إلى Excel',
                        className: 'd-none',
                        exportOptions: {
                            columns: ':not(:last-child)' // لا تصدّر عمود "خيارات"
                        },
                        filename: 'قائمة_السمات',
                        title: 'قائمة السمات'
                    }
                ],
                order: [[11, 'desc']],
                orderCellsTop: true,
                fixedHeader: true,
                initComplete: function () {
                    let api = this.api();
                    api.columns().eq(0).each(function (colIdx) {
                        let cell = $('.filters th').eq($(api.column(colIdx).header()).index());
                        $(cell).html('<input type="text" placeholder="بحث" style="width: 100%;" />');

                        $('input', cell).on('keyup change', function () {
                            api.column(colIdx).search(this.value).draw();
                        });
                    });
                }
            });

            // ربط الزر الخارجي بزر التصدير
            $('#exportExcel').on('click', function () {
                table.button('.buttons-excel').trigger();
            });
        });
    </script>
@endpush