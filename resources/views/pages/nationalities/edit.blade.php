@extends('layouts.app')

@section('content')
<div class="container">
    <h2>تعديل الجنسية</h2>
    <form action="{{ route('nationalities.update', $nationality->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">الاسم</label>
            <input type="text" class="form-control" name="name" value="{{ old('name', $nationality->name) }}" required>
        </div>
        <button type="submit" class="btn btn-success">تعديل</button>
    </form>
</div>
@endsection
