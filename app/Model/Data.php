<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    //
    
    protected $fillable = [
        'date',	'amount'
    ];
    
    public function fields() {
		return $this->belongsToMany('App\Model\Field', 'field_datas', 'data_id', 'field_id');
	}
}
