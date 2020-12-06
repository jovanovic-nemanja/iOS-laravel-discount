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

    public $fillable = ['title', 'description', 'discount_photo', 'vendor_id', 'sign_date', 'status'];

    public static function getVendorInformationByID($id)
    {
    	if (@$id) {
    		$result = Vendors::where('id', $id)->first();
    	}else{
    		$result = "";
    	}

    	return $result;
    }

    /**
    * @param discount_id
    * @since 2020-12-08
    * This is a feature to upload a profile logo
    */
    public static function upload_photo($discount_id, $existings = null) {
        if(!request()->hasFile('discount_photo')) {
            return false;
        }

        Storage::disk('public_local')->put('uploads/', request()->file('discount_photo'));

        self::save_logo_img($discount_id, request()->file('discount_photo'));
    }

    /**
    * file upload
    * @param userid and photo file
    * @return boolean true or false
    * @since 2020-12-08
    * @author Nemanja
    */
    public static function save_logo_img($discount_id, $image) {
        $discount = Discounts::where('id', $discount_id)->first();

        if($discount) {
            Storage::disk('public_local')->delete('uploads/', $discount->discount_photo);
            $discount->discount_photo = $image->hashName();
            $discount->update();
        }
    }
}
