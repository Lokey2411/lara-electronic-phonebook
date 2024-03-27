<?php

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Employee;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BaseController;


Route::get('/', function () {
    $numDepartment = count(Department::all());
    $numEmployee = count(Employee::all());
    return view('welcome', compact('numDepartment', 'numEmployee'));
})->name("home");
// resource route
Route::resource('/user', UserController::class);
Route::resource('/department', DepartmentController::class);
Route::resource('/employee', EmployeeController::class);

Route::get("/search", [BaseController::class, 'search'])->name("search");
// auth
Route::post('/loginPost', [AuthController::class, 'handleLogin'])->name("login.post");
Route::get("/logout", [AuthController::class, "handleLogout"])->name("logout");
Route::get("/login", [AuthController::class, "loginRoute"])->name("login");

// user
Route::get("/user", [UserController::class, "index"])->name("users");
Route::get("/profile", [UserController::class, "profile"])->name("user.profile");
Route::post('/profile', [UserController::class, 'updateProfile'])->name("profile.update");

Route::get('/admin', function () {
    $employees = Employee::paginate(5);
    $departments = Department::where("DepartmentID", ">", 0)->paginate(5);
    return view('admin', compact('employees', 'departments'));
})->name("admin");
// employee
Route::post('/employee/edit', [EmployeeController::class, 'edit'])->name("employee.edit");
Route::post("/employee/store", [EmployeeController::class, 'store'])->name("employee.store");
Route::get("/employee/delete/{id}", [EmployeeController::class, "delete"])->name("employee.delete");
// department
Route::post("/department/delete/{id}", [DepartmentController::class, "delete"])->name("department.delete");
Route::post('/department/edit', [DepartmentController::class, 'edit'])->name("department.edit");
Route::post("/department/store", [DepartmentController::class, 'store'])->name("department.store");