@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>تعديل التأمين</h2>
        <form action="{{ route('insurances.update', $insurance->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3"><label class="form-label">اسم السائق</label><input type="text" name="owner_name"
                    class="form-control" value="{{ $insurance->owner_name }}" required></div>
            <div class="mb-3"><label class="form-label">نوع المركبة</label><input type="text" name="vehicle_type"
                    class="form-control" value="{{ $insurance->vehicle_type }}" required></div>
            <div class="mb-3"><label class="form-label">الطراز</label><input type="text" name="model" class="form-control"
                    value="{{ $insurance->model }}" required></div>
            <div class="mb-3"><label class="form-label">رقم الهيكل</label><input type="text" name="chassis_number"
                    class="form-control" value="{{ $insurance->chassis_number }}" required></div>
            <div class="mb-3"><label class="form-label">رقم اللوحة =</label><input type="text" name="plate_number"
                    class="form-control" value="{{ $insurance->plate_number }}" required></div>
            <div class="mb-3"><label class="form-label">بداية التأمين</label><input type="date" name="start_date"
                    class="form-control" value="{{ $insurance->start_date }}" required></div>
            <div class="mb-3"><label class="form-label">نهاية التأمين</label><input type="date" name="end_date"
                    class="form-control" value="{{ $insurance->end_date }}" required></div>
            <div class="mb-3"><label class="form-label">المدة الزمنية</label><input type="text" name="duration"
                    class="form-control" value="{{ $insurance->duration }}" required></div>
            <div class="mb-3"><label class="form-label">الرسم</label><input type="number" step="0.01"
                    name="amount_numeric" class="form-control" value="{{ $insurance->amount_numeric }}" required></div>
            <div class="mb-3"><label class="form-label">Amount (Written)</label><input type="text" name="amount_written"
                    class="form-control" value="{{ $insurance->amount_written }}" required></div>
            <div class="mb-3"><label class="form-label">ملاحظات</label><textarea name="notes"
                    class="form-control">{{ $insurance->notes }}</textarea></div>
            <button type="submit" class="btn btn-success">تعديل</button>
        </form>
    </div>
@endsection