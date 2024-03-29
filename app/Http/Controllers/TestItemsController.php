<?php

namespace App\Http\Controllers;

use App\Models\Test;
use App\Models\TestItem;
use Illuminate\Http\Request;
use Validator;

class TestItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $test = Test::find($id);

        $test_items = $test->test_items()->get();

        return $test_items;
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
    public function store(Request $request, $qid, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                "text" => ["required"]
            ]
        );

        if ($validator->fails()) {
            return [
                "status" => false,
                "errors" => $validator->messages()
            ];
        }

        if($id){

            $testitem = TestItem::find($id);
            $testitem->text = $request->text;
            $testitem->status = $request->status;

            if($testitem->isDirty('text') || $testitem->isDirty('status')){
                $testitem->save();
            }

        }else{

            $testitem = TestItem::create([
                // "test_id" => $request->test_id,
                "test_id" => $qid,
                "text" => $request->text,
                "status" => $request->status
            ]);

        }

        return [
            "status" => true,
            "testitem" => $testitem
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $test = Test::find($id);

        $test_items = $test->test_items()->get();

        return $test_items;
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
  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $test = TestItem::find($id);
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
