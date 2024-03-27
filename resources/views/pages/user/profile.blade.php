@extends('layout.index')
@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card user-info">
                    <div class="text-center">
                        <img src="{{ file_exists(public_path('uploads/' . session('user')['Avatar'])) ? asset('uploads/' . session('user')['Avatar']) : asset('uploads/png-transparent-user-profile-computer-icons-login-user-avatars-thumbnail.png') }}"
                            alt="User Avatar" class="rounded img-thumbnail " id="js-image-preview">
                    </div>
                    <div class="card-body">
                        <h3 id="js-preview-name"></h3>
                        <form id="edit-user-form" method="post"
                            action="{{ route('profile.update', session('user')['EmployeeID']) }}"
                            enctype="multipart/form-data">
                            <input type="hidden" name="EmployeeID" value="{{ session('user')['EmployeeID'] }}">
                            @csrf
                            @if ($errors->any())
                                <div class="col-12">
                                    @foreach ($errors->all() as $error)
                                        <div class="bg-danger rounded-2 p-2 text-white text-center">{{ $error }}
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                            @if (session()->has('error'))
                                <div class="bg-danger rounded-2 p-2 text-white text-center">{{ session('error') }}</div>
                            @endif
                            <label for="avatar">Chỉnh sửa ảnh đại diện:</label>
                            <input type="hidden" name="avatar" value="{{ session('user')['Avatar'] }}">
                            <input type="file" name="avatar" id="js-upload-image" onchange="previewImage(event)" />
                            <div class="form-group">
                                <label for="name">Họ tên:</label>
                                <input type="text" class="form-control" id="name"
                                    value="{{ session('user')['FullName'] }}" name="name" />
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email"
                                    value="{{ session('user')['Email'] }}" name="email">
                            </div>
                            <div class="form-group">
                                <label for="phone">Số điện thoại:</label>
                                <input type="tel" class="form-control" id="phone"
                                    value="{{ session('user')['MobilePhone'] }}" name="phone">
                            </div>
                            <div class="form-group">
                                <label for="address">Địa chỉ:</label>
                                <input type="text" class="form-control" id="address"
                                    value="{{ session('user')['Address'] }}" name="address">
                            </div>
                            <div class="form-group">
                                <label for="position">Vị trí:</label>
                                @if (session('role') == 'Admin')
                                    <input type="tel" class="form-control" id="position"
                                        value="{{ session('user')['Position'] }}" name="position" />
                                @else
                                    <input type="tel" class="form-control" id="position"
                                        value="{{ session('user')['Position'] }}" name="position" disabled />
                                @endif
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-success mt-1">Lưu</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function previewImage(event) {
            const image = document.getElementById('js-image-preview');
            const reader = new FileReader();
            reader.onload = function() {
                image.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection
