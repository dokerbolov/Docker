<?php

namespace App\Http\Controllers;

use App\Models\Students;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function getList() {
        $students = Students::with(['group'])->get();

        return view('students', compact('students'));
    }

    public function getStudent(Request $request) {
        $student = Students::with(['group'])->where('id', $request->id)->first();

        return view('students-edit', compact('student'));
    }

    public function create(Request $request) {
        $student = new Students();
        $student->name = $request->name;
        $student->age = $request->age;
        $student->save();

        return redirect()->route('main');
    }

    public function update(Request $request) {
        $student = Students::findOrFail($request->id);

        if(!empty($request->name)){
            $student->name = $request->name;
        }
        if(!empty($request->age)){
            $student->age = $request->age;
        }

        $student->save();

        return redirect()->route('main');
    }

    public function delete(Request $request) {
        $student = Students::findOrFail($request->id);

        $student->delete();

        return redirect()->route('main');
    }
}
