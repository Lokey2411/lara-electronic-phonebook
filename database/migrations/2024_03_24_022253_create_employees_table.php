<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->integer('EmployeeID')->unsigned()->autoIncrement()->primary();
            $table->text('FullName');
            $table->text('Address');
            $table->text('Email');
            $table->string('MobilePhone');
            $table->string('Position');
            $table->text('Avatar');
            $table->integer("DepartmentID");
            $table->foreign('DepartmentID')->references('DepartmentID')->on('departments');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};