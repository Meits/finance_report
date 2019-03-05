<?php

namespace App\Http\Controllers\Api;

use App\Model\Field;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user  = Auth::user();
        $collection = $user->fields;

        $result = $collection->map(function($item) {
            return array(
                'id' => $item->id,
                'type' => $item->type,
                'is_profit' => $item->is_profit == true ? '1' : '0' ,
            );
        });


        return response()->json([
            'fields' => $result->toArray()
        ]);

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

        $user  = Auth::user();

        if(!$user) {
            abort('403');
        }

        $data = $request->all();

        if(!isset($data['fields'])) {
            abort('404');
        }

        $ids = array();

        foreach($data['fields'] as $k =>$field) {
            if(!$field) {
                continue;
            }

            if($user->fields->where('id',$k)->isEmpty()) {
                $model = new Field;
                $model->type = $field['type'];
                $model->is_profit = $field['is_profit'];
                $model->save();
                array_push($ids,$model->id);
            }
            else {
                $model = $user->fields->where('id',$k)->first();
                $model->type = $field['type'];
                $model->is_profit = $field['is_profit'];
                $model->save();
            }
        }

        $user->fields()->attach($ids);
        $user->load('fields');
        return response()->json([
            'success' => '1',
            'ids' => $user->fields->transform(function($item) {
                return $item->id;
            })
        ]);
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
    public function destroy($category)
    {
        //dd($user);
        $user  = Auth::user();
        if(!$user) {
            abort('403');
        }
        $user->fields()->detach($category);
        Field::destroy($category);

        return response()->json([
            'success' => '1'
        ]);

    }
}
