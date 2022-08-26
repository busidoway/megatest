<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TestBox;
use App\Models\Test;
use App\Models\TestItem;
use App\Models\Student;
use Illuminate\Http\Request;
use Validator;

class TestBoxesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $student_curr;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {

            if ($request->session()->has('student')) {
                $this->student_curr = $request->session()->get('student');
            }

            return $next($request);
        });
    }

    public function index()
    {
        return TestBox::all();
    }

    public function getDataTests()
    {

        $testboxes = TestBox::paginate(18);

        return view('tests', ['tests' => $testboxes]);
    }

    public function getTest($id)
    {

        $testbox = TestBox::find($id);

        $tests = $testbox->tests()->get();

        $arr_test = array();

        foreach($tests as $k=>$t){
            $test = Test::find($t['id']);
            $test_items = $test->test_items()->get();
            
            if(sizeof($test_items) > 0){
                // $arr_test[$k] = $test_items;
                foreach($test_items as $ki=>$vi){
                    unset($vi['status']);
                    $arr_test[$k][$ki] = $vi;
                }
            }
        }

        return ['testbox' => $testbox, 'tests' => $tests, 'test_items' => $arr_test];
    }

    public function getResult(Request $request, $id) {
        
        if($request){

            $testbox = TestBox::find($id);

            $arr = array();

            $student = "null";

            if ($request->session()->has('student')) {
                $student_session = $request->session()->get('student');
                $student = Student::find($student_session);
            }

            if($student->cheat == 'y'){

                $tests = Test::where('test_box_id', $id)->get();

                foreach($tests as $t){
                    $key = $t->id;
                    $test_item = TestItem::where('test_id', $t->id)->where('status', 'y')->first();
                    $arr[$key]['name'] = $t->name;
                    $arr[$key]['item'] = $test_item->text;
                    $arr[$key]['status'] = true;
                }

            }else{

                foreach($request->result as $key=>$val){
                    foreach($val as $k=>$v){
                        $test = Test::find($k);
                        $test_item = TestItem::find($v);
                        if($test_item->status == 'y'){
                            $arr[$k]['name'] = $test->name;
                            $arr[$k]['item'] = $test_item->text;
                            $arr[$k]['status'] = true;
                        }else{
                            $arr[$k]['name'] = $test->name;
                            $arr[$k]['item'] = $test_item->text;
                            $arr[$k]['status'] = false;
                        }
                    }
                }   
                
            }

            return ['result_data' => $arr, 'student' => $student];

        }

        // return $request;

    }

    public function getRandTestBox(Request $request) {
        $testboxes = TestBox::all();

        $tbox = $testboxes->random();

        return redirect()->route('data-test', ['id' => $tbox]);
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
    public function store(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                "name" => ["required"]
            ]
        );

        if ($validator->fails()) {
            return [
                "status" => false,
                "errors" => $validator->messages()
            ];
        }

        if($id){

            $testbox = TestBox::find($id);
            $testbox->name = $request->name;

            if($testbox->isDirty('name')){
                $testbox->save();
            }

            return [
                "status" => true,
                "store" => false,
                "testbox" => $testbox
            ];

        }else{

            $testbox = TestBox::create([
                "name" => $request->name,
                "note" => $request->note
            ]);

            return [
                "status" => true,
                "store" => true,
                "testbox" => $testbox
            ];

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        // $testbox = TestBox::find($id);

        // $tests = $testbox->tests();

        // return response()->json($tests);

        // return $tests;

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $test = TestBox::find($id);

        return $test;
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
        //
    }

    public function updateNote(Request $request, $id)
    {

        $test = TestBox::find($id);

        $test->note = $request->note;

        if($test->isDirty('note')){
            $test->save();
        }

        return [
            "status" => true,
            "test" => $test
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
        $test = TestBox::find($id);
        if ($test) {
            $test->delete();
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
