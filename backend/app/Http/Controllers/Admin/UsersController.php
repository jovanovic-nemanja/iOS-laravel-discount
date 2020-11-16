<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Role;
use App\Vendors;
use App\RoleUser;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    public function __construct(){
        $this->middleware(['auth', 'admin'])->except(['store', 'loginUser', 'logout']);
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
     * Swift API : User register by iOS mobile.
     *
     * @since 2020-11-16
     * @author Nemanja
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed'
        ]);

        if ($validator->fails()) {
            //pass validator errors as errors object for ajax response
            return response()->json(['status' => "error", 'msg' => $validator->errors()]);
        }

        DB::beginTransaction();

        try {
            $user = User::create([
                'username' => $request['username'],
                'instagram_id' => @$request['instagram_id'],
                'birthday' => @$request['birthday'],
                'email' => $request['email'],
                'block' => 0,
                'password' => Hash::make($request['password']),
                'address' => @$request['address'],
                'remarks' => @$request['remarks'],
                'sign_date' => date('Y-m-d h:i:s'),
            ]);

            RoleUser::create([
                'user_id' => $user->id,
                'role_id' => 3,
            ]);

            $result = [];
            $result = $user;

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();

            throw $e;
        }  

        return response()->json(['status' => "success", 'data' => $result, 'msg' => 'Successfully registered.']);
    }

    /**
     * Swift API : User login by iOS mobile.
     *
     * @since 2020-11-16
     * @author Nemanja
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function loginUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        if ($validator->fails()) {
            //pass validator errors as errors object for ajax response
            return response()->json(['status' => "error", 'msg' => $validator->errors()]);
        }

        $credentials = request(['email', 'password']);

        if (!Auth::attempt($credentials))
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized Access, please confirm credentials or verify your email.'
            ]);

        $user = $request->user();
        
        return response()->json(['success' => true, 'data' => $user]);
    }
    
    /**
     * Swift API : User logout by iOS mobile.
     *
     * @since 2020-11-16
     * @author Nemanja
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */  
    public function logout(Request $request)
    {
        Auth::logout();

        return response()->json([
            'success' => true,
            'message' => 'Successfully logged out'
        ]);
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
