<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Role;
use App\Vendors;
use App\RoleUser;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class UsersController extends Controller
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
        $users = User::where('username', '!=', 'Admin')->get();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
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
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255unique:vendors',
            'password' => 'required|string|min:6|confirmed'
        ]);

        DB::beginTransaction();

        try {
            $user = User::create([
                'username' => $data['username'],
                'instagram_id' => $data['instagram_id'],
                'birthday' => @$data['birthday'],
                'email' => $data['email'],
                'block' => 0,
                // 'password' => Hash::make($data['password']),
                'password' => Hash::make("111111"),
                'address' => @$data['address'],
                'remarks' => @$data['remarks'],
                'sign_date' => date('Y-m-d h:i:s'),
            ]);

            RoleUser::create([
                'user_id' => $user->id,
                'role_id' => $role,
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();

            throw $e;
        }  

        return redirect()->route('users.index')->with('flash', 'Successfully added User account.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where('id', $id)->first();

        return view('admin.users.edit', compact('user'));
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
        $record = User::where('id', $id)->first();
        if (@$record) {
            $record->username = @$request->username;
            $record->email = @$request->email;
            // $record->instagram_id = @$request->instagram_id;
            // $record->password = Hash::make($request->password);
            $record->block = $request->block;
            $record->birthday = @$request->birthday;
            $record->address = @$request->address;
            $record->remarks = @$request->remarks;

            $record->update();
        }

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rec = RoleUser::where('user_id', $id)->delete();
        $record = User::where('id', $id)->delete();
        
        return redirect()->route('users.index');
    }
}
