@extends('layouts.app')

@section('content')
    <h1 class="mb-1">قائمة الصلاحيات</h1>
    <table class="table mt-1">
        <thead>
            <tr>
                <th scope="col">
                    الصلاحية
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($roles as $role)
                <tr>
                    <td>
                        @if ($role->name == 'Simats')
                            موظف سمات
                        @elseif ($role->name == 'Tourist Insurance')
                            موظف تأمينات السياحي
                        @elseif ($role->name == 'Cargo Insurance')
                            موظف تأمينات الشحن
                        @elseif ($role->name == 'Admin')
                            مدير الفئة
                        @else
                            {{ $role->name }}
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection