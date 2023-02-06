<?php

namespace App\Http\Controllers;

use App\Models\User;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
            'phone' => 'required|unique:users',
        ]);
   
        // if($validator->fails()){
        //     return $this->sendError('Validation Error.', $validator->errors());       
        // }
   
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        try {
            $user = User::create($input);
            $success['token'] =  $user->createToken('MyApp')->plainTextToken;
            $success['name'] =  $user->first_name . ' ' . $user->last_name;
            $success['user'] = $user;
    
            return $this->sendResponse($success, 'User register successfully.');
        } catch (Error $err) {
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        }
    }
   
    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')->plainTextToken; 
            $success['name'] =  $user->first_name . ' ' . $user->last_name;
            $success['user'] = $user;
   
            return $this->sendResponse($success, 'User login successfully.');
        } 
        else{ 
            return $this->sendError('Invalid Email or Password', ['error'=>'Unauthorised']);
        } 
    }

    public function logout()
    {
        // Auth::user()->currentAccessToken()->delete();
        $success['user'] = Auth::user();
        return $this->sendResponse($success , 'Success Logout');
    }

    public function getUsers() {
        $users = User::all();
        return response()->json($users);
    }

    public function getUser($id) {
        $user = User::where('id' , $id)->get();
        return response()->json($user);
    }

    public function updateInfo($id ,Request $request) {
        // dd($request);
        // return response()->json($id);
        $user = User::find($id);

        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone
        ]);

        $user->save();
        $success['user'] = $user;
        return $this->sendResponse($success, 'User Updated successfully.');
    }

    public function updateImage($id ,Request $request) {
        // dd($request);
        $user = User::find($id);
        $user->update([
            'image' => $request->image
        ]);
        // return response()->json($request->image);

        $user->save();
        $success['user'] = $user;
        return $this->sendResponse($success, 'User Updated Image.');
    }

}
