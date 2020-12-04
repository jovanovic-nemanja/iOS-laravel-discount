<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Role;
use App\Vendors;
use App\RoleUser;
use App\Category;
use App\Discounts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class VendorsController extends Controller
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
        $vendors = Vendors::all();
        return view('admin.vendors.index', compact('vendors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('admin.vendors.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
            'vendorname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255unique:vendors',
            'category_id' => 'required',
            'phone' => 'required|string|max:32',
            'location' => 'required|string'
        ]);

        DB::beginTransaction();

        try {
            $vendor = Vendors::create([
                'vendorname' => $request['vendorname'],
                'email' => $request['email'],
                'category_id' => $request['category_id'],
                'status' => 0,
                'phone' => $request['phone'],
                'location' => $request['location'],
                'photo' => @$request['photo'],
                'instagram_id' => @$request['instagram_id'],
                'facebook_id' => @$request['facebook_id'],
                'remarks_vendor' => @$request['remarks_vendor'],
                'sign_date' => date('Y-m-d h:i:s'),
            ]);

            Vendors::upload_photo($vendor->id);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();

            throw $e;
        }  

        return redirect()->route('vendor.index')->with('flash', 'Successfully added Vendor account.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vendor = Vendors::where('id', $id)->first();
        $categories = Category::all();

        return view('admin.vendors.edit', compact('vendor', 'categories'));
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
        $this->validate(request(), [
            'vendorname' => 'required|string|max:255',
            'category_id' => 'required',
            'phone' => 'required|string|max:32',
            'location' => 'required|string'
        ]);

        $record = Vendors::where('id', $id)->first();
        if (@$record) {
            $record->vendorname = $request->vendorname;
            $record->email = $request->email;
            $record->category_id = $request->category_id;
            $record->phone = $request->phone;
            $record->location = $request->location;
            $record->photo = @$request->photo;
            $record->instagram_id = @$request->instagram_id;
            $record->facebook_id = @$request->facebook_id;
            $record->remarks_vendor = @$request->remarks_vendor;

            $record->update();
        }
        
        Vendors::upload_photo($record->id);

        return redirect()->route('vendor.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rec = Vendors::where('id', $id)->first();
        $res = Discounts::where('vendor_id', $rec->id)->delete();
        $record = Vendors::where('id', $id)->delete();
        
        return redirect()->route('vendor.index');
    }
}
