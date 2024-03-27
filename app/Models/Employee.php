<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = ["EmployeeID", "FullName", "Position", "Address", "MobilePhone", "Email", "DepartmentID", "Avatar"];
    protected $primaryKey = "EmployeeID";
    public $timestamps = false;
    public function department()
    {
        return $this->belongsTo(Department::class, "DepartmentID", "DepartmentID");
    }
    public function user()
    {
        return $this->hasOne(User::class, "EmployeeID", "EmployeeID");
    }
}