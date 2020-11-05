<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
	use SoftDeletes;

    function getCategory(){
      return $this->hasOne('App\Models\Category', 'id', 'category_id');
    }
}
