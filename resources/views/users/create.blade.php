@extends('layouts.app')

@section('content')
<div class="container py-2">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <!-- Card Container -->
            <div class="card shadow rounded-lg border-0">
                <div class="card-header bg-primary text-center">
                    <h4 class="mb-0 text-white ">إضافة مستخدم جديد</h4>
                </div>

                <div class="card-body p-2">
                    <!-- Validation Errors -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Success Message -->
                    @if (session('success'))
                        <div class="alert alert-success text-center">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-1">
                                <label for="name" class="form-label">الاسم</label>
                                <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control" placeholder="أدخل الاسم" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">البريد الإلكتروني</label>
                                <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="example@email.com" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label">كلمة المرور</label>
                                <input type="password" id="password" name="password" class="form-control" placeholder="********" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="confirm-password" class="form-label">تأكيد كلمة المرور</label>
                                <input type="password" id="confirm-password" name="password_confirmation" class="form-control" placeholder="********" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">الصلاحيات</label>
                            <div class="border rounded p-3" style="background-color: #f9f9f9;">
                                <div class="row">
                                    @foreach ($allRoles as $roleName => $roleLabel)
                                        <div class="col-md-4">
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" name="roles[]" id="role_{{ $roleName }}" value="{{ $roleName }}">
                                                <label class="form-check-label" for="role_{{ $roleName }}">
                                                    {{ $roleLabel }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-success px-5">إضافة المستخدم</button>
                        </div>
                    </form>
                </div> <!-- End Card Body -->
            </div> <!-- End Card -->
        </div>
    </div>
</div>
@endsection
