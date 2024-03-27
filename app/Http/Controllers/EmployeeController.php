<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    //
    private $numPerPage = 5;
    // route
    public function index()
    {
        $numPerPage = $this->numPerPage;
        $employees = Employee::paginate($numPerPage);
        return view('pages.employee.index', compact('employees', 'numPerPage'));
    }
    public function show($id)
    {
        $employee = Employee::find($id);
        $departments = Department::all();
        return view('pages.employee.information', compact('employee', 'departments'));
    }
    // controller
    public function edit(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric|regex:/0[0-9]{9}/',
            'address' => 'required',
        ]);
        $user = Employee::find($request->id);
        if (!$user)
            return redirect(route("employee.show", $request->id))->with("error", "Không tìm thấy người dùng" . $request->EmployeeID);
        if (file_exists(public_path('uploads/' . $request->avatar))) {
            echo "hehehe";
            $fileName = $request->avatar;
        } else {
            $file = $request->file('avatar');
            $fileName = time() . '-' . $file->getClientOriginalName();
            $file->move(public_path('uploads/'), $fileName);
        }
        $user->FullName = $request->name;
        $user->Email = $request->email;
        $user->MobilePhone = $request->phone;
        $user->Address = $request->address;
        $user->Position = $request->position;
        $user->Avatar = $fileName;
        $user->DepartmentID = $request->department;
        $user->save();
        return redirect(route("admin"))->with("message", "Cập nhật thành công");
    }
    public function delete($id)
    {
        $employee = Employee::find($id);
        $user = User::where("EmployeeID", $id)->first();
        if (!$employee) {
            return redirect(route("admin"))->with("error", "Không tìm thấy người dùng");
        }
        $employee->delete();
        $user->delete();
        return redirect(route("admin"))->with("message", "Xóa thành công");
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric|regex:/0[0-9]{9}/',
            'address' => 'required',
            'position' => 'required',
        ]);
        $employee = new Employee();
        $employee->FullName = $request->name;
        $employee->Email = $request->email;
        $employee->MobilePhone = $request->phone;
        $employee->Address = $request->address;
        $employee->Position = $request->position;
        $employee->DepartmentID = $request->department;
        $employee->save();
        return redirect(route("admin"))->with("message", "Thêm thành công");
    }
}