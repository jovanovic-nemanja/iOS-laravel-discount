<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Vendors;
use App\Discounts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DiscountsController extends Controller
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
        $discounts = Discounts::all();
        return view('admin.discounts.index', compact('discounts'));
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function creatediscounts($id)
    {
        return view('admin.discounts.create', compact('id'));
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
            'title' => 'required|string',
            'description' => 'required|string',
            'vendor_id' => 'required'
        ]);

        DB::beginTransaction();

        try {
            if (@$request['title'] && @$request['description']) {
                $discount = Discounts::create([
                    'title' => $request['title'],
                    'description' => $request['description'],
                    'vendor_id' => $request['vendor_id'],
                    'status' => 0,
                    'sign_date' => date('Y-m-d h:i:s'),
                ]);
            }

            if (@$request['title2'] && @$request['description2']) {
                $discount = Discounts::create([
                    'title' => $request['title2'],
                    'description' => $request['description2'],
                    'vendor_id' => $request['vendor_id'],
                    'status' => 0,
                    'sign_date' => date('Y-m-d h:i:s'),
                ]);
            }

            if (@$request['title3'] && @$request['description3']) {
                $discount = Discounts::create([
                    'title' => $request['title3'],
                    'description' => $request['description3'],
                    'vendor_id' => $request['vendor_id'],
                    'status' => 0,
                    'sign_date' => date('Y-m-d h:i:s'),
                ]);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();

            throw $e;
        }  

        return redirect()->route('discounts.index')->with('flash', 'Successfully added Discount.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $discount = Discounts::where('id', $id)->first();

        return view('admin.discounts.edit', compact('discount'));
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
            'title' => 'required|string',
            'description' => 'required|string',
            'vendor_id' => 'required'
        ]);

        $record = Discounts::where('id', $id)->first();
        if (@$record) {
            $record->title = $request->title;
            $record->description = $request->description;

            $record->update();
        }
        
        return redirect()->route('discounts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = Discounts::where('id', $id)->delete();
        
        return redirect()->route('discounts.index');
    }
}
