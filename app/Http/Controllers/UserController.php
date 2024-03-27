<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function index()
    {
        return redirect(route("home"));
    }
    public function profile()
    {
        $user = session('user');
        return view("pages.user.profile", compact('user'));
    }
    public function updateProfile(Request $request)
    {
        $user = Employee::where('EmployeeID', '=', $request->EmployeeID)->first();
        if (!$user)
            return redirect(route("user.profile"))->with("error", "Không tìm thấy người dùng" . $request->EmployeeID);
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
        $user->avatar = $fileName;
        $user->save();
        $request->session()->remove('user');
        $request->session()->put('user', $user);
        return redirect(route("home"));
    }
}