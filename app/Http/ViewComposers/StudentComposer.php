<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\Student;

class StudentComposer
{
    public function compose(View $view)
    {

        if (session()->has('student')) {
            $student_session = session('student');

            $student = Student::find($student_session);

            return $view->with('student_curr', $student->name);
        }
    }
}