@extends('layout.index')
@section('content')
    <style>
        .model {
            background-color: rgba(0, 0, 0, 0.2);
        }

        .form-group.col-md-6 {
            /* margin: 0 8px; */
            margin-right: 6px;
        }

        .p-6 {
            padding: 24px;
        }

        .form-row {
            display: flex;
            margin-top: 8px;
        }

        #js-input-search:focus {
            outline: none;
            box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.5);
        }
    </style>
    @include('components.navbar')
    <main class="mt-3 w-100">
        <input type="search" name="" id="js-input-search" placeholder="Filter" class="rounded-2 outline-none p-2" />
        <div class="container">
            <div class="row">
                <div class="col-md">
                    <h3 class="text-center text-primary">DANH SÁCH NHÂN VIÊN</h3>
                    @if ($errors->any())
                        <div class="col-12">
                            @foreach ($errors->all() as $error)
                                <script type="text/javascript">
                                    const Toast = Swal.mixin({
                                        toast: true,
                                        position: "top-end",
                                        showConfirmButton: false,
                                        timer: 3000,
                                        timerProgressBar: true,
                                        didOpen: (toast) => {
                                            toast.onmouseenter = Swal.stopTimer;
                                            toast.onmouseleave = Swal.resumeTimer;
                                        }
                                    });
                                    Toast.fire({
                                        icon: "success",
                                        title: "{{ $error }}"
                                    });
                                </script>
                            @endforeach
                        </div>
                    @endif
                    @if (session()->has('error'))
                        <script type="text/javascript">
                            const Toast = Swal.mixin({
                                toast: true,
                                position: "top-end",
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.onmouseenter = Swal.stopTimer;
                                    toast.onmouseleave = Swal.resumeTimer;
                                }
                            });
                            Toast.fire({
                                icon: "error",
                                title: "{{ $session('error') }}"
                            });
                        </script>
                    @endif
                    @if ($message = Session::get('message'))
                        <script type="text/javascript">
                            const Toast = Swal.mixin({
                                toast: true,
                                position: "top-end",
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.onmouseenter = Swal.stopTimer;
                                    toast.onmouseleave = Swal.resumeTimer;
                                }
                            });
                            Toast.fire({
                                icon: "success",
                                title: "{{ $message }}"
                            });
                        </script>
                    @endif
                    <button type="button" id="js-add-employee" class="btn btn-primary">Thêm mới</button>
                    <table class="table w-100 mw-100" id="js-employee-table">
                        <thead>
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">Mã nhân viên</th>
                                <th scope="col">Họ và tên</th>
                                <th scope="col">Địa chỉ</th>
                                <th scope="col">Email</th>
                                <th scope="col">Số điện thoại</th>
                                <th scope="col">Vị trí</th>
                                <th scope="col">Phòng ban</th>
                                <th scope="col" colspan="4" class="text-center">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employees as $index => $e)
                                @csrf
                                <th scope="row">{{ $index + 1 }}</th>
                                <td>{{ $e['EmployeeID'] }}</td>
                                <td>{{ $e['FullName'] }}</td>
                                <td>{{ $e['Address'] }}</td>
                                <td>{{ $e['Email'] }}</td>
                                <td>{{ $e['MobilePhone'] }}</td>
                                <td>{{ $e->Position }}</td>
                                <td>{{ $e->department->DepartmentName }}</td>
                                <td><a href="{{ route('employee.show', $e->EmployeeID) }}"><i
                                            class="fa-solid fa-eye fs-5 d-flex justify-content-center"></i></a></td>
                                <td
                                    onclick="showNotice(()=>{
                                        window.location.href =' {{ route('employee.delete', $e['EmployeeID']) }}';
                                        })">
                                    <i class="fa-solid fa-trash fs-5 d-flex justify-content-center "></i>
                                </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <nav aria-label="Page navigation example">
                        {{ $employees->links('layout.pagination') }}
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="col-md">
                    <h3 class="text-center text-primary text-uppercase">Danh sách phòng ban</h3>
                    <button type="button" id="js-add-department" class="btn btn-primary">Thêm mới</button>
                    <table class="table w-100 mw-100" id="js-department-table">
                        <thead>
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">Mã Phòng ban</th>
                                <th scope="col">Tên phòng ban</th>
                                <th scope="col">Địa chỉ</th>
                                <th scope="col">Email</th>
                                <th scope="col">Số điện thoại</th>
                                <th scope="col">Website</th>
                                <th scope="col">Phòng ban trực thuộc</th>
                                <th scope="col" colspan="4" class="text-center">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($departments as $index => $d)
                                <tr>
                                    <th scope="row">{{ $index + 1 }}</th>
                                    <td>{{ $d['DepartmentID'] }}</td>
                                    <td>{{ $d['DepartmentName'] }}</td>
                                    <td>{{ $d['Address'] }}</td>
                                    <td>{{ $d['Email'] }}</td>
                                    <td>{{ $d['Phone'] }}</td>
                                    <td><a href="https://{{ $d['Website'] }}">{{ $d['Website'] }}</a></td>
                                    <td>{{ $d->parentDepartment->DepartmentName }}</td>
                                    <td><a href="{{ route('department.show', $d['DepartmentID']) }}"><i
                                                class="fa-solid fa-eye fs-5 d-flex justify-content-center"></i></a></td>
                                    <td
                                        onclick="showNotice(()=>{
                                        window.location.href =' {{ route('department.delete', $d['DepartmentID']) }}';
                                        })">
                                        <i class="fa-solid fa-trash fs-5 d-flex justify-content-center "></i>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <nav aria-label="Page navigation example">
                        {{ $departments->links('layout.pagination') }}
                    </nav>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div id="js-employee-modal"
            class="fixed-top fixed-bottom model d-flex justify-content-center d-none
            align-items-center">
            <div class="bg-white rounded-3 p-6 w-50 h-50">
                <form class="w-100" action="{{ route('employee.store') }}" method="post">
                    @method('POST')
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="name">Họ và tên</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Nhập họ và tên">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Nhập email">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="address">Địa chỉ</label>
                            <input type="text" class="form-control" id="address" name="address"
                                placeholder="Nhập địa chỉ">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="phoneNumber">Số điện thoại</label>
                            <input type="tel" class="form-control" id="phoneNumber" name="phone"
                                placeholder="Nhập số điện thoại">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="position">Vị trí</label>
                            <input type="text" class="form-control" id="position" name="position"
                                placeholder="Nhập vị trí">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="department">Phòng ban</label>
                            <select type="text" class="form-control" id="department" name="department"
                                placeholder="Nhập phòng ban" class="form-select">
                                <option value="0">--Chọn phòng ban--</option>
                                @foreach ($departments as $d)
                                    <option value="{{ $d['DepartmentID'] }}">{{ $d['DepartmentName'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Thêm</button>
                    <button type="button" class="btn btn-secondary" id="js-close-employee-modal">Đóng</button>
                </form>


            </div>
        </div>
        <!-- Department Modal -->
        <div id="js-department-modal"
            class="fixed-top fixed-bottom model d-flex justify-content-center d-none
            align-items-center">
            <div class="bg-white rounded-3 p-6 w-50 h-50">
                <form class="w-100" action="{{ route('department.store') }}" method="post">
                    @method('POST')
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="name">Tên phòng ban</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Nhập tên phòng ban">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Nhập email">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="address">Địa chỉ</label>
                            <input type="text" class="form-control" id="address" name="address"
                                placeholder="Nhập địa chỉ">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="phone">Số điện thoại</label>
                            <input type="tel" class="form-control" id="phoneNumber" name="phone"
                                placeholder="Nhập số điện thoại">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="website">Website</label>
                            <input type="text" class="form-control" id="website" name="website"
                                placeholder="Website của bộ phận">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="parent">Phòng ban trực thuộc</label>
                            <select type="text" class="form-control " id="parent-department" name="parent"
                                placeholder="Nhập phòng ban" class="form-select">
                                <option value="0">--Chọn phòng ban trực thuộc--</option>
                                @foreach ($departments as $d)
                                    <option value="{{ $d['DepartmentID'] }}">{{ $d['DepartmentName'] }}></option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Thêm</button>
                    <button type="button" class="btn btn-secondary" id="js-close-department-modal">Đóng</button>
                </form>
            </div>
        </div>
        <script>
            const toggleModal = (modal) => {
                modal.classList.toggle("d-none");
            }

            function showNotice(onConfirm) {
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: "btn btn-success",
                        cancelButton: "btn btn-danger"
                    },
                    buttonsStyling: false
                });
                swalWithBootstrapButtons.fire({
                    title: "Bạn có chắc chắn muốn xóa?",
                    text: "Dữ liệu đã xóa sẽ không thể lấy lại!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Phải, xóa nó đi",
                    cancelButtonText: "Không, đừng xóa!",
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        onConfirm();
                    } else if (
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        swalWithBootstrapButtons.fire({
                            title: "Dữ liệu sẽ không được xóa",
                            text: "",
                            icon: "error"
                        });
                    }
                });
            }
            document.getElementById('js-add-employee').addEventListener('click', function() {
                const modal = document.getElementById('js-employee-modal');
                toggleModal(modal);
            });
            document.getElementById('js-close-employee-modal').addEventListener('click', function() {
                const modal = document.getElementById('js-employee-modal');
                if (modal) {
                    toggleModal(modal);
                }
            });
            document.getElementById('js-add-department').addEventListener('click', function() {
                const modal = document.getElementById('js-department-modal');
                toggleModal(modal);
            })
            document.getElementById('js-close-department-modal').addEventListener('click', function() {
                const modal = document.getElementById('js-department-modal');
                if (modal) {
                    toggleModal(modal);
                }
            })
        </script>
    </main>
@endsection
