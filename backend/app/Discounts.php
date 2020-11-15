<?php

namespace App;

use App\Vendors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;

class Discounts extends Model
{
	public $table = "discounts";

    public $fillable = ['title', 'description', 'vendor_id', 'sign_date', 'status'];

    public static function getVendorInformationByID($id)
    {
    	if (@$id) {
    		$result = Vendors::where('id', $id)->first();
    	}else{
    		$result = "";
    	}

    	return $result;
    }
}
