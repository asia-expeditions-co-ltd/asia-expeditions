<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SlideShow extends Model
{
    //
    protected $table = 'tbl_slide';


    public function country(){
    	return $this->belongsTo(Country::class);
    }
}
