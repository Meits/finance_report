<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //exit('ku');

        if(!$request->input('dateStart')) {
            $dateStart = Carbon::now()->startOfMonth();
        }
        else {
            $dateStart = Carbon::parse($request->input('dateStart'));
        }
        if(!$request->input('dateEnd')) {
            $dateEnd = Carbon::now()->endOfMonth();
        }
        else {
            $dateEnd = Carbon::parse($request->input('dateEnd'));
        }

        $user  = Auth::user();
        $user->fields->transform(function($item) use ($dateStart, $dateEnd) {
            $item->datas = $item->datasByDate($dateStart->toDateString(), $dateEnd->toDateString())->get();
            $item->datas->transform(function($data) {
                $data->amount = decrypt($data->amount);
                return $data;
            });
            return $item;
        });



        $fields = $user->fields->transform(function($field) {
            $datas = 0;
            $datas = $field->datas->sum('amount');

            return array(
                'id' => $field->id,
                'type' => $field->type,
                'amount' => $datas
            );

        });

        //print_r($user->fields);
        if($request->isMethod('post')) {

            return response()->json([
                'success' => '1',
                'fields'=>$fields
            ]);
        }

        return view('result')->with(['fields' => $user->fields,'dateStart'=>$dateStart, 'dateEnd' => $dateEnd]);
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
        //
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
