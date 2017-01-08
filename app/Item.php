<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{

  protected $fillable = ['id','user_id','name', 'description',
   'image_url','votes','approve'];//missing category
  protected $hidden = [];



  //votes relation
function votes(){
  return $this->hasMany("App\Vote");
}
}
