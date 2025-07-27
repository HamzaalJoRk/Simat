@extends('layouts.app')

@section('content')
<div class="container">
    <h2>اضافة رسم</h2>
    <form action="{{ route('fees.store') }}" method="POST">
        @csrf
        <div style="display: none" class="mb-3">
            <label class="form-label">Nationality</label>
            <select name="nationality_id" class="form-select" required>
                @foreach($nationalities as $nat)
                    <option value="{{ $nat->id }}">{{ $nat->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">النوع</label>
            <input type="text" name="type" class="form-control" value="{{ old('type') }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">مدة البقاء</label>
            <input type="text" name="duration" class="form-control" value="{{ old('duration') }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">عدد مرات الدخول</label>
            <input type="number" name="entry_count" class="form-control" value="{{ old('entry_count') }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">الرسم</label>
            <input type="number" step="0.01" name="amount" class="form-control" value="{{ old('amount') }}" required>
        </div>
        <button class="btn btn-primary">حفظ</button>
    </form>
</div>
@endsection
