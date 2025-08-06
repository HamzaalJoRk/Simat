@extends('layouts.app')

@section('title', 'Nationalities')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-1">
            <h2>الجنسيات</h2>
            <a href="{{ route('nationalities.create') }}" class="btn btn-primary">اضافة جنسية</a>
        </div>

        {{-- نموذج البحث --}}
        <form method="GET" action="{{ route('nationalities.index') }}" class="mb-2">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="ابحث بالاسم..."
                    value="{{ request('search') }}">
                <button type="submit" class="btn btn-outline-primary">بحث</button>
            </div>
        </form>

        @if($nationalities->count())
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>الاسم</th>
                        <th>الرسوم</th>
                        <th>خيارات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($nationalities as $nationality)
                        <tr>
                            <td>{{ $loop->iteration + ($nationalities->currentPage() - 1) * $nationalities->perPage() }}</td>
                            <td>{{ $nationality->name }}</td>
                            <td class="p-0">
                                @if($nationality->fees->count())
                                    <table class="table mb-0 table-sm table-bordered">
                                        <thead class="table-light">
                                            <tr>
                                                <th>النوع</th>
                                                <th>المدة</th>
                                                <th>الرسم</th>
                                                <th>خيارات</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($nationality->fees as $fee)
                                                <tr>
                                                    <td>{{ $fee->type }}</td>
                                                    <td>{{ $fee->duration }} يوم</td>
                                                    <td><strong>{{ number_format($fee->amount, 2) }} $</strong></td>
                                                    <td>
                                                        <a href="{{ route('fees.edit', $fee->id) }}"
                                                            class="btn btn-sm btn-outline-warning">تعديل</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <span class="text-muted d-block p-2">لا توجد رسوم</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('nationalities.edit', $nationality) }}" class="btn btn-sm btn-warning">تعديل</a>
                                <form action="{{ route('nationalities.destroy', $nationality->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">حذف</button>
                                </form>
                                <a href="{{ route('fees.create', ['nationality_id' => $nationality->id]) }}"
                                    class="btn btn-sm btn-success mt-2 d-block">إضافة رسوم</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            @if ($nationalities->hasPages())
                <div class="d-flex justify-content-center mt-5">
                    <nav>
                        <ul class="pagination pagination-lg shadow-sm rounded-pill">
                            @if ($nationalities->onFirstPage())
                                <li class="page-item disabled">
                                    <span class="page-link rounded-pill">&laquo;</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link rounded-pill" href="{{ $nationalities->previousPageUrl() }}"
                                        rel="prev">&laquo;</a>
                                </li>
                            @endif

                            @foreach ($nationalities->getUrlRange(1, $nationalities->lastPage()) as $page => $url)
                                @if ($page == $nationalities->currentPage())
                                    <li class="page-item active">
                                        <span class="page-link rounded-pill">{{ $page }}</span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link rounded-pill" href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endif
                            @endforeach

                            @if ($nationalities->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link rounded-pill" href="{{ $nationalities->nextPageUrl() }}" rel="next">&raquo;</a>
                                </li>
                            @else
                                <li class="page-item disabled">
                                    <span class="page-link rounded-pill">&raquo;</span>
                                </li>
                            @endif
                        </ul>
                    </nav>
                </div>
            @endif
        @else
            <p>لا يوجد بيانات..</p>
        @endif
    </div>
@endsection