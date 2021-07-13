<?php

namespace App;

use App\User;
use App\Vendors;
use App\Discounts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Tracks extends Model
{
    public $table = "tracks";

    public $fillable = ['discountID', 'userID', 'sign_date'];
}
