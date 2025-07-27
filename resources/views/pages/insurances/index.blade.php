@extends('layouts.app')

@section('title', 'Insurances')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="fw-bold">سجل التأمينات</h2>
            <div>
                <a href="{{ route('insurances.create') }}" class="btn btn-primary">
                    <i class="fa fa-plus"></i> إضافة تأمين
                </a>
                <button id="exportExcel" class="btn btn-success">
                    <i class="fa fa-file-excel"></i> تصدير إلى Excel
                </button>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <div class="card text-white bg-info shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">عدد التأمينات</h5>
                        <h3 class="card-text fw-bold">{{ $insurances->count() }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card text-white bg-success shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">إجمالي الرسوم</h5>
                        <h3 class="card-text fw-bold">{{ number_format($insurances->sum('amount_numeric'), 2) }} $</h3>
                    </div>
                </div>
            </div>
        </div>

        @if($insurances->count())
            <div class="table-responsive">
                <table id="insurance-table" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>اسم السائق</th>
                            <th>نوع المركبة</th>
                            <th>الطراز</th>
                            <th>رقم الهيكل</th>
                            <th>رقم اللوحة</th>
                            <th>بداية التأمين</th>
                            <th>نهاية التأمين</th>
                            <th>المدة</th>
                            <th>الرسم</th>
                            <th>ملاحظات</th>
                            <th>خيارات</th>
                        </tr>
                    </thead>
                    <thead class="filters">
                        <tr>
                            <th></th>
                            @for($i = 0; $i < 10; $i++)
                                <th><input type="text" class="form-control form-control-sm" placeholder="بحث" /></th>
                            @endfor
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($insurances as $insurance)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $insurance->name }}</td>
                                <td>{{ $insurance->vehicle_type }}</td>
                                <td>{{ $insurance->model }}</td>
                                <td>{{ $insurance->chassis_number }}</td>
                                <td>{{ $insurance->plate_number }}</td>
                                <td>{{ $insurance->start_date }}</td>
                                <td>{{ $insurance->end_date }}</td>
                                <td>{{ $insurance->duration }}</td>
                                <td>{{ number_format($insurance->amount_numeric, 2) }}</td>
                                <td>{{ $insurance->notes ?? 'لا يوجد' }}</td>
                                <td>
                                    <a href="{{ route('insurances.edit', $insurance) }}" class="btn btn-sm btn-warning">تعديل</a>
                                    <form action="{{ route('insurances.destroy', $insurance) }}" method="POST" class="d-inline"
                                          onsubmit="return confirm('هل أنت متأكد من الحذف؟');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">حذف</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="alert alert-warning text-center">لا توجد سجلات تأمين.</p>
        @endif
    </div>

    {{-- DataTables CSS --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
@endsection

@push('scripts')
    {{-- jQuery + DataTables + Buttons --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

    <script>
        $(document).ready(function () {
            const table = $('#insurance-table').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        text: 'تصدير Excel',
                        className: 'd-none',
                        exportOptions: {
                            columns: ':not(:last-child)' // لا تصدّر عمود "خيارات"
                        },
                        filename: 'قائمة_التأمينات',
                        title: 'قائمة التأمينات'
                    }
                ],
                orderCellsTop: true,
                fixedHeader: true
            });

            // تصدير عند الضغط على الزر الخارجي
            $('#exportExcel').on('click', function () {
                table.button('.buttons-excel').trigger();
            });

            // فلاتر الأعمدة
            $('#insurance-table thead.filters input').on('keyup change', function () {
                let index = $(this).parent().index();
                table.column(index).search(this.value).draw();
            });
        });
    </script>
@endpush
