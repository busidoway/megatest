<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Test;
use App\Models\TestBox;
use Illuminate\Http\Request;
use Validator;


class TestsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {

        $testbox = TestBox::find($id);

        $tests = $testbox->tests()->get();

        return $tests;

        // return response()->json($tests);
        // return Test::all();
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

        $test = Test::create([
            "test_box_id" => $request->test_box_id,
            "name" => $request->name,
            "note" => $request->note
        ]);

        // TestBoxTestRel::create([
        //     "test_box_id" => 
        // ]);

        return [
            "status" => true,
            "test" => $test
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
        // $test = Test::find($id);
        // if (!$test) {
        //     return response()->json([
        //         "status" => false,
        //         "message" => "Test not found"
        //     ])->setStatusCode(404);
        // }

        // return $test;

        // $testbox = TestBox::find($id);

        // $tests = $testbox->tests()->get();

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
        $test = Test::find($id);
        if ($test) {
            $test->delete();
        }
    }
}
