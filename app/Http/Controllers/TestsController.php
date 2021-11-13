<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Test;
use App\Models\TestBoxTestRel;
use Illuminate\Http\Request;
use Validator;


class TestsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // $table = DB::table('test_boxes')
        //             ->join('test_box_test_rels', 'test_boxes.id', '=', 'test_box_test_rels.test_box_id')
        //             ->join('tests', 'tests.id', '=', 'test_box_test_rels.test_id')
        //             -select('tests.*')
        //             ->where('test_boxes.id', 1)
        //             ->get();
        
        // return $table->all();

        return Test::all();
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
            // "test_box_id" => $request->test_box_id,
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
        $test = Test::find($id);
        if (!$test) {
            return response()->json([
                "status" => false,
                "message" => "Test not found"
            ])->setStatusCode(404);
        }

        return $test;
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
