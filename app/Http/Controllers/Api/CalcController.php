<?php

namespace App\Http\Controllers\Api;

use App\Model\Data;
use App\Model\Field;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CalcController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if(!$request->input('date')) {
            $date = Carbon::now();
        }
        else {
            $date = Carbon::parse($request->input('date'));
        }

        $user  = Auth::user();
        $user->fields->transform(function($item) use ($date) {
            $item->datas = $item->datasByDate($date->toDateString())->first();
            return $item;
        });

        if(!$user) {
            abort('403');
        }

        $fields = $user->fields->transform(function($field) {
            $datas = 0;

            if(isset($field->datas->amount)) {
                $datas = decrypt($field->datas->amount);;
            }
            return array(
                        'id' => $field->id,
                        'type' => $field->type,
                        'amount' => $datas
            );

        });


        if($request->isMethod('post')) {
            return response()->json([
                'success' => '1',
                'fields' => $fields->toArray()
            ]);
        }
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

        if(!isset($data['calcs'])) {
            abort('404');
        }

        $ids = array();

        if(!isset($data['date']) || !$data['date']) {
            $date = Carbon::now();
        }
        else {
            $date = Carbon::createFromFormat('d.m.Y', $data['date']);
        }

        foreach($data['calcs'] as $k =>$field) {
            if(!$field) {
                continue;
            }

            $model = false;
            if($date) {

                $f = Field::find($k);
                $model = $f->datasByDate($date->toDateString())->first();
                //$model = Data::whereDate('date',$date->toDateString())->first();
            }

            if(!$model) {
                $model = new Data;
            }

            $model->amount = encrypt($field);
            $model->date = $date->toDateString();
            //$model->save();

            //$model->fields()->attach($k);
            $f->datas()->save($model);

        }

        return response()->json([
            'success' => '1',
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
    public function destroy($id)
    {
        //
    }
}
