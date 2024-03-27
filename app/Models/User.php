<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = ['Username', "Password", "Role", "EmployeeID"];
    public function employee()
    {
        return $this->belongsTo(Employee::class, "EmployeeID", "EmployeeID");
    }
}