<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    //
    protected $fillable = array('type','is_profit');

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

    public function setIsProfitAttribute($value) {
        $result = "0";
        if(strval($value)) {
            $result = strval($value);
        }
        $this->attributes['is_profit'] = $result;
    }
}
