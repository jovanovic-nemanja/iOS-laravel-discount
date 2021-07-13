<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use Stripe;
use App\User;
use App\Video;
use App\Tracks;
use App\Reviews;
use App\Vendors;
use App\Category;
use Carbon\Carbon;
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
     * Swift API: get link of Video for ADS.
     *
     * @since 2020-12-03
     * @author Nemanja
     * @return \Illuminate\Http\Response
     */
    public function getvideolink(Request $request)
    {
        $result = Video::where('active', 1)->first();
        if (@$result) {
            $status = "success";
            $link = env('APP_URL') . "uploads/" . $result->link;
        }else {
            $status = "success";
            $link = "https://youtu.be/VSo41Y9i2Ug";
        }

        return response()->json(['status' => $status, 'data' => $link, 'msg' => 'success']);
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

        $path = env('APP_URL')."uploads/";

    	return response()->json(['status' => $status, 'data' => $result, 'path' => $path]);
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

        $path = env('APP_URL')."uploads/";    

    	return response()->json(['status' => $status, 'data' => $result, 'msg' => $msg, 'path' => $path]);
    }

    /**
     * Swift API: getting discounts data by vendor.
     *
     * @param vendor Id
     * @since 2020-11-16
     * @author Nemanja
     * @return \Illuminate\Http\Response
     */
    public function getDiscountlists(Request $request)
    {
        $arr = [];
        
        /*
            SELECT discounts.*, vendors.vendorname, vendors.location, vendors.photo, vendors.email, vendors.phone, vendors.instagram_id, discounts.sign_date as discounts_date, categories.category_name, categories.id as category_id, AVG(reviews.mark) as avg_marks, COUNT(reviews.id) as count_reviews

            FROM discounts
            INNER JOIN vendors ON vendors.id = discounts.vendor_id
            INNER JOIN categories ON categories.id = vendors.category_id
            INNER JOIN reviews ON reviews.discount_id = discounts.id
            WHERE vendors.category_id = 2
            GROUP BY discounts.id
        */

        if (@$request->category_id) {
            $result = DB::table('discounts')
                            ->join('vendors', 'vendors.id', '=', 'discounts.vendor_id')
                            ->join('categories', 'categories.id', '=', 'discounts.category_id')
                            ->leftJoin('reviews', 'reviews.discount_id', '=', 'discounts.id')
                            ->where('discounts.category_id', $request->category_id)
                            ->where('vendors.vendorname', 'like', '%'.$request->vendor_name.'%')
                            ->select('discounts.*', 'vendors.vendorname', 'vendors.location', 'vendors.photo', 'vendors.email', 'vendors.phone', 'vendors.instagram_id', 'vendors.website_link', 'discounts.sign_date as discounts_date', 'categories.category_name', 'categories.id as category_id', DB::raw('avg(reviews.mark) AS avg_marks'), DB::raw('COUNT(reviews.id) AS count_reviews'))
                            ->groupby('discounts.id')
                            ->orderBy('avg_marks', 'DESC')
                            ->get();
        }else{
            $result = DB::table('discounts')
                            ->join('vendors', 'vendors.id', '=', 'discounts.vendor_id')
                            ->join('categories', 'categories.id', '=', 'discounts.category_id')
                            ->leftJoin('reviews', 'reviews.discount_id', '=', 'discounts.id')
                            ->where('vendors.vendorname', 'like', '%'.$request->vendor_name.'%')
                            ->select('discounts.*', 'vendors.vendorname', 'vendors.location', 'vendors.photo', 'vendors.email', 'vendors.phone', 'vendors.instagram_id', 'vendors.website_link', 'discounts.sign_date as discounts_date', 'categories.category_name', 'categories.id as category_id', DB::raw('avg(reviews.mark) AS avg_marks'), DB::raw('COUNT(reviews.id) AS count_reviews'))
                            ->groupby('discounts.id')
                            ->orderBy('avg_marks', 'DESC')
                            ->get();
        }
        
        if (@$result) {
            $status = "success";
            $msg = "Success.";
        }else {
            $status = "failed";
            $msg = "Failed.";
        }

        $path = env('APP_URL')."uploads/"; 

        return response()->json(['status' => $status, 'data' => $result, 'msg' => $msg, 'path' => $path]);
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
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'user_id' => 'required'
        ]);

        if ($validator->fails()) {
            $messages = $validator->messages();

            //pass validator errors as errors object for ajax response
            return response()->json(['status' => "failed", 'msg' => $messages->first()]);
        }

        $result = DB::table('discounts')
                        ->join('vendors', 'vendors.id', '=', 'discounts.vendor_id')
                        ->join('categories', 'categories.id', '=', 'discounts.category_id')
                        ->where('discounts.id', $request->id)
                        ->select('discounts.*', 'vendors.vendorname', 'vendors.location', 'vendors.photo', 'vendors.email', 'discounts.sign_date as discounts_date', 'categories.category_name', 'categories.id as category_id')
                        ->get();

        $discount = Discounts::where('id', $request->id)->first();
        $track = Tracks::where('userID', $request->user_id)->where('discountID', $request->id)->orderBy('id', 'desc')->take(1)->first();

        if (@$discount) {
            $discount_redeem_type = $discount->type;
            switch ($discount_redeem_type) {
                case 1: //redeem type is forever....
                    if (@$track) {
                        $is_tracked = 1;    //redeemed.
                    }else{
                        $is_tracked = 0;    //not redeemed yet.
                    }

                    break;
                
                case 2: //redeem type is once 1 month....
                    if (@$track) {
                        $today = Carbon::parse(date('Y-m-d H:i:s')); 
                        $diff_in_months = $today->diffInDays($track->sign_date);

                        if($diff_in_months > 31) {
                            $is_tracked = 0;
                        }else{
                            $is_tracked = 1;
                        }
                    }else{
                        $is_tracked = 0;
                    }
                    
                    break;

                case 3: //redeem type is one time....
                    $is_tracked = 0;
                    
                    break;

                default:
                    $is_tracked = 0;

                    break;
            }

            $result[0]->isTracked = $is_tracked;
        }

        $reviews = DB::table('reviews')
                        ->join('users', 'users.id', '=', 'reviews.putter')
                        ->where('reviews.discount_id', $request->id)
                        ->select('reviews.*', 'users.username', 'users.photo')
                        ->orderBy('reviews.id', 'DESC')
                        ->get();

        if (@$reviews) {
            $result[0]->reviews = $reviews;
        }

        $status = "success";
        $msg = "Success.";

        $path = env('APP_URL')."uploads/"; 
        
        return response()->json(['status' => $status, 'data' => $result, 'msg' => $msg, 'path' => $path]);
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

    /**
     * Swift API: put reviews data by API.
     *
     * @since 2021-01-04
     * @author Nemanja
     * @return \Illuminate\Http\Response
     */
    public function putReviewsbyAPI(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'putter' => 'required',
            'discount_id' => 'required',
            'mark' => 'required',
            'comments' => 'required'
        ]);

        if ($validator->fails()) {
            $messages = $validator->messages();

            //pass validator errors as errors object for ajax response
            return response()->json(['status' => "failed", 'msg' => $messages->first()]);
        }

        if (@$request->review_id) {
            $review = Reviews::where('id', $request['review_id'])->first();
            if (@$review) {
                $review->mark = $request->mark;
                $review->comments = $request->comments;
                $review->update();

                $data = $review;
                $msg = "Successfully updated your review.";
                $status = 'success';
            }else{
                $data = "";
                $msg = "Can't find your review.";
                $status = "failed";
            }
        }else{
            $reviews = Reviews::create([
                'putter' => $request['putter'],
                'discount_id' => $request['discount_id'],
                'mark' => $request['mark'],
                'comments' => $request['comments'],
                'put_date' => date('Y-m-d h:i:s')
            ]);
            $data = $reviews;
            $msg = "Successfully putted your review.";
            $status = 'success';
        }

        return response()->json(['status' => $status, 'data' => $data, 'msg' => $msg]);
    }

    /**
     * Swift API: validate the pin code.
     *
     * @since 2021-07-12
     * @author Nemanja
     * @return \Illuminate\Http\Response
     */
    public function validatePinCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'discount_id' => 'required',
            'user_id' => 'required',
            'code' => 'required'
        ]);

        if ($validator->fails()) {
            $messages = $validator->messages();

            //pass validator errors as errors object for ajax response
            return response()->json(['status' => "failed", 'msg' => $messages->first()]);
        }

        $discount = Discounts::where('id', $request['discount_id'])->first();
        if (@$discount) {
            $vendor = Vendors::where('id', $discount->vendor_id)->first();
            if (@$vendor) {
                if ($request->code == $vendor['code']) {
                    $track = Tracks::create([
                        'discountID' => $request['discount_id'],
                        'userID' => $request['user_id'],
                        'sign_date' => date('Y-m-d h:i:s'),
                    ]);

                    $msg = "Successfully updated your review.";
                    $status = 'success';
                }else{
                    $msg = "Pin code was wrong. Please enter the correct pin code.";
                    $status = 'failed';
                }
            }else{
                $msg = "Looks vendor doesn't exist now.";
                $status = 'failed';
            }

            $data = "";                
        }else{
            $data = "";
            $msg = "Couldn't find the discount offer.";
            $status = "failed";
        }

        return response()->json(['status' => $status, 'data' => $data, 'msg' => $msg]);
    }

    /**
     * success response method.
     * stripe 
     * @author Nemanja
     * @since 2021-01-13
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        Stripe\Charge::create ([
            "amount" => $request->amount,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Test payment from itsolutionstuff.com." 
        ]);
          
        return response()->json(['status' => "success", 'data' => '', 'msg' => 'Successfully made a payment.']);
    }
}
