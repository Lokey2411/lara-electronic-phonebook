<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $primaryKey = 'DepartmentID';
    protected $fillable = ["DepartmentID", "DepartmentName", "Logo", "Website", "Address", "Phone", "Email", "ParentDepartmentID"];
    public $timestamps = false;
    public function parentDepartment()
    {
        return $this->belongsTo(Department::class, 'ParentDepartmentID', 'DepartmentID');
    }

    public function childrenDepartments()
    {
        return $this->hasMany(Department::class, 'ParentDepartmentID', 'DepartmentID');
    }
    public function employees()
    {
        return $this->hasMany(Employee::class, 'DepartmentID', 'DepartmentID');
    }
}