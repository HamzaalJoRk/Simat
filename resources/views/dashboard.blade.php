@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">📊 الإحصائيات العامة</h2>

        <form method="GET" action="{{ route('dashboard') }}" class="row mb-4">
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
                <a href="{{ route('dashboard') }}" class="btn btn-secondary">إعادة تعيين</a>
            </div>
        </form>

        <div class="row">
            <div class="col-md-4">
                <div class="card text-white bg-info shadow-sm mb-3">
                    <div class="card-body">
                        <h5 class="card-title text-white">تأمينات الشحن</h5>
                        <p>عدد: <strong>{{ $cargo->count() }}</strong></p>
                        <p>إجمالي الرسوم: <strong>{{ number_format($cargo->sum('amount_numeric'), 2) }} $</strong></p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card text-white bg-success shadow-sm mb-3">
                    <div class="card-body">
                        <h5 class="card-title text-white">تأمينات السياحي</h5>
                        <p>عدد: <strong>{{ $tourist->count() }}</strong></p>
                        <p>إجمالي الرسوم: <strong>{{ number_format($tourist->sum('amount_numeric'), 2) }} $</strong></p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card text-white bg-warning shadow-sm mb-3">
                    <div class="card-body">
                        <h5 class="card-title text-white">السمات</h5>
                        <p>عدد: <strong>{{ $simats->count() }}</strong></p>
                        <p>إجمالي الرسوم: <strong>{{ number_format($simats->sum('fee_number'), 2) + number_format($simats->sum('labor_fee'), 2) }} $</strong></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection