@extends('layouts.app')

@section('content')
<div class="container py-2">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <!-- Card Container -->
            <div class="card shadow rounded-lg border-0">
                <div class="card-header bg-warning text-white text-center">
                    <h4 class="mb-0">تعديل بيانات المستخدم</h4>
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

                    <form action="{{ route('users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <div class="row">
                            <div class="col-md-6 mb-1">
                                <label for="name" class="form-label">الاسم</label>
                                <input type="text" id="name" name="name" value="{{ $user->name }}" class="form-control" required>
                            </div>

                            <div class="col-md-6 mb-1">
                                <label for="email" class="form-label">البريد الإلكتروني</label>
                                <input type="email" id="email" name="email" value="{{ $user->email }}" class="form-control" required>
                            </div>

                            <div class="col-md-6 mb-1">
                                <label for="password" class="form-label">كلمة المرور <small class="text-muted">(اتركه فارغاً إذا لا تريد تغييره)</small></label>
                                <input type="password" id="password" name="password" class="form-control" placeholder="********">
                            </div>

                            <div class="col-md-6 mb-1">
                                <label for="confirm-password" class="form-label">تأكيد كلمة المرور</label>
                                <input type="password" id="confirm-password" name="password_confirmation" class="form-control" placeholder="********">
                            </div>
                        </div>

                        <div class="mb-1">
                            <label class="form-label">الصلاحيات</label>
                            <div class="border rounded p-3" style="background-color: #f9f9f9;">
                                <div class="row">
                                    @foreach ($allRoles as $roleName => $roleLabel)
                                        <div class="col-md-4">
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" name="roles[]" id="role_{{ $roleName }}"
                                                    value="{{ $roleName }}" {{ in_array($roleName, $userRole) ? 'checked' : '' }}>
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
                            <button type="submit" class="btn btn-warning px-5">حفظ التعديلات</button>
                        </div>
                    </form>
                </div> <!-- End Card Body -->
            </div> <!-- End Card -->
        </div>
    </div>
</div>
@endsection
