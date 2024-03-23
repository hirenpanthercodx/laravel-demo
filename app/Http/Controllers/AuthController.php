<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login (Request $request) {
        if (Auth::attempt(['email'=>$request->email, 'password'=>$request->password])) {
            $user = Auth::User(); 
            Session::regenerate();
            Session::put('auth_user', Auth::user());

            // $success['token'] = $user->createToken('MyApp')->plainTextToken;
            // $success['email'] = $user->email; 

            // $response = [
            //     'success' => true,
            //     'data' => $success,
            //     'message' => 'user login successfully'
            // ];

            // return response()->json($response, 200);
            return $user->role === 'admin' ? redirect('/admin') : redirect('/employee');
        } else {
            $response = [
                'success' => false,
                'message' => 'something went wrong'
            ];

            return response()->json($response, 500);
        }
    }

    public function logout() {
        Auth::logout();
 
        Session::invalidate();
        Session::regenerateToken();
        return redirect('/login');
    }

    public function register (Request $request) {
        try {

            $validator = Validator::make(request()->all(), [
                'email' => 'required|email',
                'password' => 'required|string|min:1',
                'role' => 'required|string',
                'permission' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->messages(), 400);
            }

            $user = new User();
            
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role = $request->role;
            $user->permisssion = json_encode($request->permission);
            
            $user->save();
            
            Session::regenerate();
            Session::put('auth_user', $user);
            // $success['token'] = $user->createToken('MyApp')->plainTextToken;
            // $success['email'] = $user->email;

            // $response = [
            //     'success' => true,
            //     'data' => $success,
            //     'message' => 'user register successfully'
            // ];

            // return response()->json($response, 200);
            return $user->role === 'admin' ? redirect('/admin') : redirect('/employee');

        } catch ( \Exception $e ) {
            return response()->json(['error'=>$e->getMessage()], 500);
        }
        
    }
}
