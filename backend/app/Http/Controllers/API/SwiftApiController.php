<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use App\User;
use App\Vendors;
use App\Category;
use App\Discounts;
use App\GeneralSetting;
use Illuminate\Support\Facades\DB;

class SwiftApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @since 2020-11-16
     * @author Nemanja
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Swift API: getting all category information by API.
     *
     * @since 2020-11-16
     * @author Nemanja
     * @return \Illuminate\Http\Response
     */
    public function getAllcategories(Request $request)
    {
    	$result = Category::all();
        if (@$result) {
            $status = "success";
        }else {
            $status = "failed";
        }

    	return response()->json(['status' => $status, 'data' => $result]);
    }

    /**
     * Swift API: getting all vendors information by params.
     *
     * @param category_id or all
     * @since 2020-11-16
     * @author Nemanja
     * @return \Illuminate\Http\Response
     */
    public function getAllvendors(Request $request)
    {
    	if (@$request->category_id) {
            $result = DB::table('vendors')
                            ->join('categories', 'categories.id', '=', 'vendors.category_id')
                            ->where('vendors.category_id', $request->category_id)
                            ->select('vendors.*', 'categories.category_name', 'categories.slug')
                            ->get();
        }else{
            $result = DB::table('vendors')
                            ->join('categories', 'categories.id', '=', 'vendors.category_id')
                            ->select('vendors.*', 'categories.category_name', 'categories.slug')
                            ->get();
        }

        if (@$result) {
            $status = "success";
            $msg = "Success.";
        }else {
            $status = "failed";
            $msg = "Failed.";
        }
            

    	return response()->json(['status' => $status, 'data' => $result, 'msg' => $msg]);
    }

    /**
     * Swift API: getting discounts data by vendor.
     *
     * @param vendor Id
     * @since 2020-11-16
     * @author Nemanja
     * @return \Illuminate\Http\Response
     */
    public function getDiscountlistsByVendor(Request $request)
    {
        if (@$request->vendor_id) {
            $result = DB::table('discounts')
                            ->join('vendors', 'vendors.id', '=', 'discounts.vendor_id')
                            ->join('categories', 'categories.id', '=', 'vendors.category_id')
                            ->where('discounts.vendor_id', $request->vendor_id)
                            ->select('discounts.*', 'vendors.vendorname', 'discounts.sign_date as discounts_date', 'categories.category_name')
                            ->get();
        }else{
            $result = DB::table('discounts')
                            ->join('vendors', 'vendors.id', '=', 'discounts.vendor_id')
                            ->join('categories', 'categories.id', '=', 'vendors.category_id')
                            ->select('discounts.*', 'vendors.vendorname', 'discounts.sign_date as discounts_date', 'categories.category_name')
                            ->get();
        }
        
        if (@$result) {
            $status = "success";
            $msg = "Success.";
        }else {
            $status = "failed";
            $msg = "Failed.";
        }
        $result['path'] = "https://tdguae.com/uploads/";

        return response()->json(['status' => $status, 'data' => $result, 'msg' => $msg]);
    }

    /**
     * Swift API: getting discounts data by vendor.
     *
     * @param vendor Id
     * @since 2020-11-16
     * @author Nemanja
     * @return \Illuminate\Http\Response
     */
    public function getDetaildiscountById(Request $request)
    {
        if (@$request->id) {
            $result = DB::table('discounts')
                            ->join('vendors', 'vendors.id', '=', 'discounts.vendor_id')
                            ->join('categories', 'categories.id', '=', 'vendors.category_id')
                            ->where('discounts.id', $request->id)
                            ->select('discounts.*', 'vendors.vendorname', 'vendors.location', 'vendors.photo', 'vendors.email', 'discounts.sign_date as discounts_date', 'categories.category_name')
                            ->get();
        }else{
            $result = DB::table('discounts')
                            ->join('vendors', 'vendors.id', '=', 'discounts.vendor_id')
                            ->join('categories', 'categories.id', '=', 'vendors.category_id')
                            ->select('discounts.*', 'vendors.vendorname', 'vendors.location', 'vendors.photo', 'vendors.email', 'discounts.sign_date as discounts_date', 'categories.category_name')
                            ->get();
        }
            
        if (@$result) {
            $status = "success";
            $msg = "Success.";
        }else {
            $status = "failed";
            $msg = "Failed.";
        }
        $result['path'] = "https://tdguae.com/uploads/";

        return response()->json(['status' => $status, 'data' => $result, 'msg' => $msg]);
    }

    /**
     * Swift API: getting all settings(like app name...) information by API.
     *
     * @since 2020-11-16
     * @author Nemanja
     * @return \Illuminate\Http\Response
     */
    public function getAllsettings(Request $request)
    {
    	$result = GeneralSetting::all();
        if (@$result) {
            $data = $result;
            $status = "success";
        }else{
            $data = [];
            $status = "failed";
        }

    	return response()->json(['status' => $status, 'data' => $data]);
    }
}
