<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TestBox;
use App\Models\Test;
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
            
            if(sizeof($test_items) > 0)
                $arr_test[$k] = $test_items;
            // $arr_test[$k] = ["items" => $test_items];
        }

        // return view('test', ['tests' => $tests, 'test_items' => $test_items]);
        // return [
        //     "status" => true,
        //     "tests" => $tests
        // ];

        return ['tests' => $tests, 'test_items' => $arr_test];
        // return $arr_test;
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
                "name" => ["required"]
            ]
        );

        if ($validator->fails()) {
            return [
                "status" => false,
                "errors" => $validator->messages()
            ];
        }

        $testbox = TestBox::create([
            "name" => $request->name,
            "note" => $request->note
        ]);

        return [
            "status" => true,
            "testbox" => $testbox
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
        //
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
