<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Tracks;
use App\Vendors;
use App\Discounts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class TracksController extends Controller
{
    public function __construct(){
        $this->middleware(['auth', 'admin']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tracks = DB::table('tracks')
                    ->join('discounts', 'discounts.id', "=", 'tracks.discountID')
                    ->join('vendors', 'vendors.id', "=", 'discounts.vendor_id')
                    ->select('vendors.vendorname', 'vendors.location', 'vendors.photo as vendorPhoto', 'vendors.email as vendorEmail', 'discounts.title', 'discounts.description', 'discounts.discount_photo', 'tracks.sign_date', 'tracks.id')
                    ->get();

        $allCounts = count(Tracks::all());

        return view('admin.tracks.index', compact('tracks', 'allCounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = Tracks::where('id', $id)->delete();
        
        return redirect()->route('tracks.index');
    }
}
