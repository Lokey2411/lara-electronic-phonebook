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
            Danh sách Đơn vị</div>
        <table class="table table-hover table-dark" id="js-department-table">
            <thead>
                <tr>
                    <th scope="col">STT</th>
                    <th scope="col">Tên phòng ban</th>
                    <th scope="col">Địa chỉ</th>
                    <th scope="col">Email</th>
                    <th scope="col">Số điện thoại</th>
                    <th scope="col">Website</th>
                    <th scope="col">Phòng ban trực thuộc</th>
                </tr>
            </thead>
            <tbody>
                @if (isset($departments))
                    @foreach ($departments as $index => $d)
                        <tr>
                            <th scope="row">{{ $index + 1 }}</th>
                            <td>{{ $d['DepartmentName'] }}</td>
                            <td>{{ $d['Address'] }}</td>
                            <td>{{ $d['Email'] }}</td>
                            <td>{{ $d['Phone'] }}</td>
                            <td><a href="https://{{ $d['Website'] }}">${{ $d['Website'] }}</a></td>
                            <td>{{ $d->parentDepartment->DepartmentName }}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        {{-- pagination --}}
        {{ $departments->links('layout.pagination') }}
    @endsection
