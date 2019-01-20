<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    //
    protected $fillable = array('type');
    
    public function datas() {
		return $this->belongsToMany('App\Data', 'field_datas', 'field_id', 'data_id');
	}
	public function datasByDate($date) {
		return $this->belongsToMany('App\Data', 'field_datas', 'field_id', 'data_id')->whereDate('date',$date);
	}
}
