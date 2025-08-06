@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>الجنسيات</h2>
        <form action="{{ route('nationalities.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">الاسم</label>
                <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
            </div>
            <button type="submit" class="btn btn-primary">حفظ</button>
        </form>
    </div>
@endsection