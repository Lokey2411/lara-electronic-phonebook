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
        Schema::create('departments', function (Blueprint $table) {
            $table->integer("DepartmentID")->autoIncrement()->primary();
            $table->text('DepartmentName');
            $table->text('Address');
            $table->text('Email');
            $table->string('Phone');
            $table->text('Logo')->default('png-transparent-user-profile-computer-icons-login-user-avatars-thumbnail.png');
            $table->string('Website');
            $table->integer('ParentDepartmentID')->default(0);
            $table->foreign('ParentDepartmentID')->references('DepartmentID')->on('departments');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departments');
    }
};