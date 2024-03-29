<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Test;
use App\Models\TestBox;
use App\Models\TestItem;
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
                // "text" => ["required"]
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

        // if(!$request->status){
        //     $testitem_status = 'n';
        // }else{
        //     $testitem_status = 'y';
        // }

        // $items_arr = $request->items_array;

        /* if($items_arr){
            foreach($items_arr as $key=>$item){
                // if($item['status']){
                //     $item_status = 'y';
                // }else{
                //     $item_status = 'n';
                // }

                $testitem = TestItem::create([
                    "test_id" => $test->id,
                    "text" => $item['text'],
                    "status" => $item['status']
                ]);
                // $item_item = $item['text'];
            }
        }else{
            $testitem = TestItem::create([
                "test_id" => $test->id,
                "text" => $request->text,
                "status" => $testitem_status
            ]);
        } */

        return [
            "status" => true,
            "test" => $test
            // "test_id" => $test->id,
            // "testitem" => $testitem,
            // "items_array" => $items_arr
            // "item" => $item_item
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
    public function update(Request $request, $id, $qid)
    {
        $validator = Validator::make(
            $request->all(),
            [
                "name" => ["required"]
                // "text" => ["required"]
            ]
        );

        if ($validator->fails()) {
            return [
                "status" => false,
                "errors" => $validator->messages()
            ];
        }

        // $arr_req = $request->all();

        $test = Test::find($qid);

        $test->test_box_id = $request->test_box_id;

        $test->name = $request->name;

        if($test->isDirty('name')){
            $test->save();
        }

        $test->note = $request->note;

        if($test->isDirty('note')){
            $test->save();
        }

        // $test->fill($arr_req);

        // if($test->isDirty()){
        //     $test->update([
        //         "test_box_id" => $request->test_box_id,
        //         "name" => $request->name,
        //         "note" => $request->note
        //     ]);
        // }

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
        $test = Test::find($id);
        if ($test) {
            $test->delete();
        }
    }
}
