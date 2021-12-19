<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TestBox;
use App\Models\Test;
use App\Models\TestItem;
use Illuminate\Http\Request;
use Validator;

class TestBoxesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TestBox::all();
    }

    public function getDataTests()
    {
        return view('tests', ['tests' => TestBox::all()]);
    }

    public function getTest($id)
    {

        $testbox = TestBox::find($id);

        $tests = $testbox->tests()->get();

        // $test_items = $tests->test_items()->get();
        // $test_items = '';

        $arr_test = array();

        foreach($tests as $k=>$t){
            $test = Test::find($t['id']);
            $test_items = $test->test_items()->get();
            
            if(sizeof($test_items) > 0){
                // for($i=0; $i<count($test_items); $i++){
                //     $n=1;
                //     if($test_items[$i]['status'] == 'y') $n++;
                //     if($n>1) $arr_test[$k]['input'] = 'checkbox';
                // }
                $arr_test[$k] = $test_items;
            }
            // $arr_test[$k] = ["items" => $test_items];
        }

        // return view('test', ['tests' => $tests, 'test_items' => $test_items]);
        // return [
        //     "status" => true,
        //     "tests" => $tests
        // ];

        return ['testbox' => $testbox, 'tests' => $tests, 'test_items' => $arr_test];
        // return $arr_test;
    }

    public function getResult(Request $request, $id) {
        
        if($request){

            $testbox = TestBox::find($id);

            $arr = array();

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

            // for($i=0; $i<count($request); $i++){
            //     $test = Test::find($request[$i]);
            // }

            return $arr;

        }

        // return $request;

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
