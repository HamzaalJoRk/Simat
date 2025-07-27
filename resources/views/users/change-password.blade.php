@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-0 shadow rounded-lg">
                    <div class="card-header bg-primary text-white text-center">
                        <h5 class="mb-0">تغيير كلمة المرور</h5>
                    </div>

                    <div class="card-body p-4">
                        @if (session('success'))
                            <div class="alert alert-success text-center">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('password.update') }}" method="POST">
                            @csrf

                            @method('PUT')
                            <div class="mb-3">
                                <label for="current_password" class="form-label">كلمة المرور الحالية</label>
                                <input type="password" id="current_password" name="current_password" class="form-control"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label for="new_password" class="form-label">كلمة المرور الجديدة</label>
                                <input type="password" id="new_password" name="new_password" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="new_password_confirmation" class="form-label">تأكيد كلمة المرور الجديدة</label>
                                <input type="password" id="new_password_confirmation" name="new_password_confirmation"
                                    class="form-control" required>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary px-5">حفظ التغييرات</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection