@extends('layout.index')
@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card user-info">
                    <div class="text-center">
                        <img src="{{ file_exists(public_path('uploads/' . $employee['Avatar'])) ? asset('uploads/' . $employee['Avatar']) : asset('uploads/png-transparent-user-profile-computer-icons-login-user-avatars-thumbnail.png') }}"
                            alt="User Avatar" class="rounded img-thumbnail " id="js-image-preview">
                    </div>
                    <div class="card-body">
                        <h3 id="js-preview-name"></h3>
                        <form id="edit-user-form" method="post"
                            action="{{ route('employee.edit', $employee['EmployeeID']) }}" enctype="multipart/form-data">
                            <input type="hidden" name="EmployeeID" value="{{ $employee['EmployeeID'] }}">
                            <input type="hidden" name="id" value={{ $employee['EmployeeID'] }}>
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
                            <input type="hidden" name="avatar" value="{{ $employee['Avatar'] }}">
                            <input type="file" name="avatar" id="js-upload-image" onchange="previewImage(event)" />
                            <div class="form-group">
                                <label for="name">Họ tên:</label>
                                <input type="text" class="form-control" id="name"
                                    value="{{ $employee['FullName'] }}" name="name" />
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" value="{{ $employee['Email'] }}"
                                    name="email">
                            </div>
                            <div class="form-group">
                                <label for="phone">Số điện thoại:</label>
                                <input type="tel" class="form-control" id="phone"
                                    value="{{ $employee['MobilePhone'] }}" name="phone">
                            </div>
                            <div class="form-group">
                                <label for="address">Địa chỉ:</label>
                                <input type="text" class="form-control" id="address"
                                    value="{{ $employee['Address'] }}" name="address">
                            </div>
                            <div class="form-group">
                                <label for="position">Vị trí:</label>
                                @if (session('role') == 'Admin')
                                    <input type="tel" class="form-control" id="position"
                                        value="{{ $employee['Position'] }}" name="position" />
                                @else
                                    <input type="tel" class="form-control" id="position"
                                        value="{{ $employee['Position'] }}" name="position" disabled />
                                @endif
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-success mt-1">Lưu</button>
                            </div>
                            <select name="department" id="">
                                <option value="0">--Chọn phòng ban--</option>
                                @foreach ($departments as $d)
                                    <option value="{{ $d['DepartmentID'] }}"
                                        {{ $d['DepartmentID'] == $employee['DepartmentID'] ? 'selected' : '' }}>
                                        {{ $d['DepartmentName'] }}
                                    </option>
                                @endforeach
                            </select>
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
