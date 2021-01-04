<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    public $table = "reviews";

    public $fillable = ['putter', 'discount_id', 'mark', 'comments', 'put_date'];
}
