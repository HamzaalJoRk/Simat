@extends('layouts.app')

@section('title', 'Fees')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>الرسوم</h2>
            <a href="{{ route('fees.create') }}" class="btn btn-primary">اضافة رسم</a>
        </div>

        @if($fees->count())
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>الجنسية</th>
                        <th>النوع</th>
                        <th>مدة البقاء</th>
                        <th>عدد المرات</th>
                        <th>الرسم</th>
                        <th>خيارات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($fees as $fee)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $fee->nationality->name }}</td>
                            <td>{{ $fee->type }}</td>
                            <td>{{ $fee->duration }}</td>
                            <td>{{ $fee->entry_count }}</td>
                            <td>{{ number_format($fee->amount, 2) }}</td>
                            <td>
                                <a href="{{ route('fees.edit', $fee) }}" class="btn btn-sm btn-warning">تعديل</a>
                                <form action="{{ route('fees.destroy', $fee) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">حذف</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>لا يوجد بيانات...</p>
        @endif
    </div>
@endsection