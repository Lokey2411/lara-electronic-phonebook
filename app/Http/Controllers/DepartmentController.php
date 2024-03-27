<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    private $numpage = 5;
    // views
    public function index()
    {
        $departments = Department::where('DepartmentID', '!=', '0')->paginate($this->numpage);
        $numpage = $this->numpage;
        return view('pages.department.index', compact('departments', 'numpage'));
    }
    public function show($id)
    {
        $department = Department::find($id);
        $departments = Department::where('DepartmentID', '!=', '0')->get();
        return view('pages.department.information', compact('department'), compact('departments'));
    }
    // controllers
    public function edit(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric|regex:/0[0-9]{9}/',
            'address' => 'required',
        ]);
        $department = Department::find($request->DepartmentID);
        if (!$department)
            return redirect(route("department.show", $request->id))->with("error", "Không tìm thấy người dùng" . $request->EmployeeID);
        if (file_exists(public_path('uploads/' . $request->logo))) {
            $fileName = $request->logo;
        } else {
            $file = $request->file('logo');
            $fileName = time() . '-' . $file->getClientOriginalName();
            $file->move(public_path('uploads/'), $fileName);
        }
        $department->Logo = $fileName;
        $department->DepartmentName = $request->name;
        $department->Email = $request->email;
        $department->Phone = $request->phone;
        $department->Address = $request->address;
        $department->Website = $request->website;
        $department->save();
        return redirect(route('admin'))->with("message", "Cập nhật thành công");
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric|regex:/0[0-9]{9}/',
            'address' => 'required',
        ]);
        Department::create([
            'DepartmentName' => $request->name,
            'Email' => $request->email,
            'Phone' => $request->phone,
            'Address' => $request->address,
            'Website' => $request->website,
            'ParentDepartmentID' => $request->parent
        ]);
        return redirect(route('admin'))->with("message", "Thêm thành công");
    }
    public function delete($id)
    {
        $employees = Employee::where("DepartmentID", '=', $id)->get();
        foreach ($employees as $employee) {
            $employee->DepartmentID = 0;
            $employee->save();
        }
        $departments = Department::where('ParentDepartmentID', '=', $id)->get();
        foreach ($departments as $department) {
            $department->ParentDepartmentID = 0;
            $department->save();
        }
        Department::find($id)->delete();
        return redirect(route("admin"))->with("message", "Xóa thành công");
    }
}