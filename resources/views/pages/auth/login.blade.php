@extends('layout.index')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <img src="https://www.tlu.edu.vn/Portals/0/2021/Th%C3%A1ng%203/baner-webthumb.jpg" class="card-img-top"
                        alt="...">
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="col-12">
                                @foreach ($errors->all() as $error)
                                    <div class="bg-danger text-white rounded-2 p-2">{{ $error }}</div>
                                @endforeach
                            </div>
                        @endif
                        @if (session()->has('error'))
                            <div class="bg-danger text-white rounded-2 p-2">{{ session('error') }}</div>
                        @endif
                        <h5 class="card-title">Đăng nhập</h5>
                        <form action="{{ route('login.post') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="username">Tên đăng nhập</label>
                                <input type="text" class="form-control" id="username" name="username"
                                    placeholder="Nhập tên đăng nhập">
                            </div>
                            <div class="form-group">
                                <label for="password">Mật khẩu</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Nhập mật khẩu">
                            </div>

                            <button type="submit" class="btn btn-primary">Đăng nhập</button>
                            <div class="text-center">
                                <a href="#" class="text-center">Quên mật khẩu?</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
