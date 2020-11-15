<?php

namespace App;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;

class Vendors extends Model
{
    public $fillable = ['vendorname', 'email', 'category_id', 'phone', 'status', 'location', 'photo', 'instagram_id', 'facebook_id', 'sign_date', 'remarks_vendor'];

    public function getStatus($id) {
        if (@$id) {
            if ($id == 0) { //normal status
                $result = "Normal";
            }else if ($id == 1) {   //user blocked status
                $result = "Blocked";
            }
        }else{
            $result = "Normal";
        }

        return $result;
    }

    public function getVendorname($id) {
        if (@$id) {
            $vendor = Vendors::where('id', $id)->first();
            $name = $vendor->vendorname;
        }

        return $name;
    }

    /**
    * @param vendor_id
    * This is a feature to upload a profile logo
    */
    public static function upload_photo($vendor_id, $existings = null) {
        if(!request()->hasFile('photo')) {
            return false;
        }

        Storage::disk('public_local')->put('uploads/', request()->file('photo'));

        self::save_logo_img($vendor_id, request()->file('photo'));
    }

    /**
    * file upload
    * @param userid and photo file
    * @return boolean true or false
    * @since 2020-10-16
    * @author Nemanja
    */
    public static function save_logo_img($vendor_id, $image) {
        $vendor = Vendors::where('id', $vendor_id)->first();

        if($vendor) {
            Storage::disk('public_local')->delete('uploads/', $vendor->photo);
            $vendor->photo = $image->hashName();
            $vendor->update();
        }
    }

    public static function getCategoryNameByID($cateid)
    {
        if (@$cateid) {
            $category = Category::where('id', $cateid)->first();
            if (@$category) {
                $name = $category->category_name;
            }else{
                $name = "";
            }
        }else{
            $name = "";
        }

        return $name;
    }
}
