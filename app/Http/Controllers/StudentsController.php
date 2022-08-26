<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Validator;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::all();

        return $students;
    }

    public function getStudents()
    {
        $students = Student::all();

        return view('index', ['students' => $students]);
    }

    public function selectStudent(Request $request)
    {

        $id = $request->student_select;

        $student = Student::find($id);

        if($student){

            session(['student' => $student->id]);

            return redirect()->route('tests');

            // $data_session = $request->session()->all();
            // return response()->json($data_session);
        }else{
            return redirect()->route('home')->with(['error' => true]);
        }
    }

    public function toggleCheat(Request $request, $id){
        $student = Student::find($id);

        $student->cheat = $request->cheat;

        if($student->isDirty()){
            $student->save();
        }

        return [
            "status" => true,
            "cheat" => $request->cheat
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                "name" => ["required"],
                "position" => ["required"],
            ]
        );

        if ($validator->fails()) {
            return [
                "status" => false,
                "errors" => $validator->messages()
            ];
        }

        $student = Student::create([
            "name" => $request->name,
            "position" => $request->position
        ]);

        return [
            "status" => true,
            "student" => $student
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = Student::find($id);
        return $student;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = Student::find($id);
        return $student;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                "name" => ["required"],
                "position" => ["required"],
            ]
        );

        if ($validator->fails()) {
            return [
                "status" => false,
                "errors" => $validator->messages()
            ];
        }

        $student = Student::find($id);

        $student->name = $request->name;
        $student->position = $request->position;

        if($student->isDirty()){
            $student->save();
        }

        return [
            "status" => true,
            "test" => $student
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::find($id);
        if ($student) {
            $student->delete();
            return [
                "status" => true
            ];
        }else{
            return [
                "status" => false
            ];
        }
    }
}
