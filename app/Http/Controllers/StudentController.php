<?php

namespace App\Http\Controllers;
use App\Models\Student;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    //store function
    public function store(Request $request)
    {
        //validate the request
        $validate = $request -> validate([
            'name' => 'required',
            'email' => 'required|email|unique:students,email',
            'phone' => 'required',
            'address' => 'required',
        ]);
        //create new student using validated data
        $student = Student::create($validate);
        //return with success message
        return redirect()->route('dashboard')-> with(['success' => 'Student added successfully!', 'newStudent' => $student,]);
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('dashboard')->with('destroy', 'Student deleted successfully!');
    }
}
