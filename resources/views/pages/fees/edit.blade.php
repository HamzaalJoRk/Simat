@extends('layouts.app')

@section('content')
<div class="container">
    <h2>تعديل رسم</h2>
    <form action="{{ route('fees.update', $fee->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">الجنسية</label>
            <select name="nationality_id" class="form-select" required>
                @foreach($nationalities as $nat)
                    <option value="{{ $nat->id }}" @selected($fee->nationality_id == $nat->id)>{{ $nat->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">النوع</label>
            <input type="text" name="type" class="form-control" value="{{ old('type', $fee->type) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">مدة البقاء</label>
            <input type="text" name="duration" class="form-control" value="{{ old('duration', $fee->duration) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">عدد مرات الدخول</label>
            <input type="number" name="entry_count" class="form-control" value="{{ old('entry_count', $fee->entry_count) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">رسم الدخول</label>
            <input type="number" step="0.01" name="amount" class="form-control" value="{{ old('amount', $fee->amount) }}" required>
        </div>
        <button class="btn btn-success">تعديل</button>
    </form>
</div>
@endsection
