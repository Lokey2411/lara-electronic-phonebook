@extends('layout.index')
@section('content')
    @include('components.navbar')
    @include('components.banner')
    @include('components.introduce')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2>Thống kê số lượng đơn vị và nhân viên</h2>
                <p>Số lượng đơn vị: <span class="text-primary bold badge-primary"
                        id="js-num-departments">{{ $numDepartment }}</span></p>
                <p>Tổng số nhân viên: <span class="text-primary bold badge-primary"
                        id="js-num-employees">{{ $numEmployee }}</span></p>
            </div>
        </div>
    </div>
    @include('components.footer')
@endsection
