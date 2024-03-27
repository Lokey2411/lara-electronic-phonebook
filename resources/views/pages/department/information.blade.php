@extends('layout.index')

@section('content')
    @include('components.navbar')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card user-info">
                    <div class="text-center">
                        <img src="{{ file_exists(public_path('uploads/' . $department['Logo'])) ? asset('uploads/' . $department['Logo']) : asset('uploads/png-transparent-user-profile-computer-icons-login-user-avatars-thumbnail.png') }}"
                            alt="User Avatar" class="rounded img-thumbnail " id="js-image-preview">
                    </div>
                    <div class="card-body">
                        <h3 id="js-preview-name"></h3>
                        <form id="edit-user-form" method="post"
                            action='{{ route('department.edit', $department['DepartmentID']) }}'
                            enctype="multipart/form-data">
                            <input type="hidden" name="DepartmentID" value="{{ $department['DepartmentID'] }}">
                            @csrf
                            @method('PUT')
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
                            <label for="logo">Chỉnh sửa ảnh đại diện:</label>
                            <input type="file" name="avatar" value="{{ asset('uploads/' . $department['Logo']) }}"
                                onchange="showImage(event)">
                            <div class="form-group">
                                <label for="name">Tên:</label>
                                <input type="text" class="form-control" id="name"
                                    value="{{ $department->DepartmentName }}" name="name">
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" value="{{ $department->Email }}"
                                    name="email">
                            </div>
                            <div class="form-group">
                                <label for="phone">Số điện thoại:</label>
                                <input type="tel" class="form-control" id="phone" value="{{ $department->Phone }}"
                                    name="phone">
                            </div>
                            <div class="form-group">
                                <label for="address">Địa chỉ:</label>
                                <input type="text" class="form-control" id="address" value="{{ $department->Address }}"
                                    name="address">
                            </div>
                            <div class="form-group">
                                <label for="website">Website:</label>
                                <input type="tel" class="form-control" id="website"
                                    value="{{ $department->Website }}" name="website" />
                            </div>
                            <div class="form-group col-md-6">
                                <label for="parent">Phòng ban trực thuộc</label>
                                <select type="text" class="form-control " id="parent-department" name="parent"
                                    placeholder="Nhập phòng ban" class="form-select">
                                    <option value="0">--Chọn phòng ban trực thuộc--</option>
                                    @foreach ($departments as $d)
                                        <option value="{{ $d->DepartmentID }}"
                                            {{ $d->DepartmentID == $department->parentDepartment->DepartmentID ? 'selected' : '' }}>
                                            {{ $d->DepartmentName }}</option>
                                    @endforeach
                                </select>
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
        function showImage(event) {
            var image = document.getElementById('js-image-preview');
            const reader = new FileReader();
            reader.onload = function() {
                image.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection
