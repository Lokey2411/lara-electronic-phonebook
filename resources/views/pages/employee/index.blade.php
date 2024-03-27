@extends('layout.index')
@section('content')
    @include('components.navbar')
    <div>
        <div class="h1 text-center text-white px-5 py-3 rounded bgGradient"
            style="background-image: linear-gradient(
    to right,
    red,
    orange,
    rgb(224, 224, 14),
    green,
    blue,
    indigo,
    violet
  );">
            Danh sách giảng viên</div>
        <table class="table table-hover table-dark" id="js-employee-table">
            <thead>
                <tr>
                    <th scope="col">STT</th>
                    <th scope="col">Họ và tên</th>
                    <th scope="col">Địa chỉ</th>
                    <th scope="col">Email</th>
                    <th scope="col">Số điện thoại</th>
                    <th scope="col">Vị trí</th>
                    <th scope="col">Phòng ban</th>
                </tr>
            </thead>
            <tbody>
                @if (isset($employees))
                    @foreach ($employees as $index => $e)
                        <tr>
                            <th scope="row">{{ $index + 1 }}</th>
                            <td>{{ $e['FullName'] }}</td>
                            <td>{{ $e['Address'] }}</td>
                            <td>{{ $e['Email'] }}</td>
                            <td>{{ $e['MobilePhone'] }}</td>
                            <td>{{ $e->Position }}</td>
                            <td>{{ $e->department->DepartmentName }}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        <div class="w-100">
            {{ $employees->links('layout.pagination') }}
        </div>
    @endsection
