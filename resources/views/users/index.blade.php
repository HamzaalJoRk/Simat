@extends('layouts.app')

@section('content')
    <h1 class="mb-1"> قائمة المستخدمين</h1>

    <a href="/user-create" class="btn btn-primary mb-2">
        اضافة مستخدم
    </a>
    <table class="table table-bordered mt-4">
        <thead>
            <tr class="flex">
                <th scope="col">
                    الاسم
                </th>
                <th scope="col">
                    البريد الالكتروني
                </th>
                <th scope="col">
                    الصلاحية
                </th>
                <th scope="col">
                    اجراء
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>
                        {{ $user->name }}
                    </td>
                    <td>
                        {{ $user->email }}
                    </td>
                    <td>
                        @if(!empty($user->getRoleNames()))
                            @foreach($user->getRoleNames() as $v)
                                <label class="badge badge-secondary text-dark">{{ $v }}</label>
                            @endforeach
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('users.edit', ['user' => $user->id]) }}" class="btn btn-info btn-sm">
                            تعديل
                        </a>
                        <form method="POST" action="{{ route('users.destroy', $user->id) }}"
                            onsubmit="return confirm('Are you sure you want to delete this user?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                حذف
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection