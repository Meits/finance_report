<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    //
    protected $fillable = array('type');

    public function datas() {
        return $this->hasMany('App\Model\Data'/*, 'field_datas', 'field_id', 'data_id'*/);
    }
    public function datasByDate($date, $date_end = false) {
        if($date_end) {
            return $this->hasMany('App\Model\Data'/*, 'field_datas', 'field_id', 'data_id'*/)->whereDate('date', '>=',$date)->whereDate('date', '<=',$date_end);
        }
        else {
            return $this->hasMany('App\Model\Data'/*, 'field_datas', 'field_id', 'data_id'*/)->whereDate('date',$date);
        }

    }
}
