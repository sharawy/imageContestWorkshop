<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{

  protected $fillable = ['id','value', 'item_id','user_id','user'];//missing category
  protected $hidden = [];



  function user(){
    return $this->belongsTo("App\User");
  }
}
