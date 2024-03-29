<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{

    public function dashboardData() {
        $data = Admin::simplePaginate(10);
        return view('Dashboard.admin', ['listingData' => $data]);
    }
    
    public function dashboardDropdown() {
        $data = Admin::all();
        return response()->json($data);
    }

    public function editRecord(Request $request) {
        $id = $request->route('id');

        $data = Admin::findOrFail($id);
        return view('Dashboard.addRecord', ['editData' => $data]); 
    }

    public function store (Request $request) {
        try {

            $validator = Validator::make(request()->all(), [
                'firstName' => 'required|string',
                'lastName' => 'required|string|min:1',
                'email' => 'required|email',
                'gender' => 'required|string',
                'occupation' => 'required|string',
                'hobby' => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json($validator->messages(), 400);
                // return redirect()->back()->withErrors($validator)->withInput();
            }

            $user = new Admin();

            $user->firstName = $request->firstName;
            $user->lastName = $request->lastName;
            $user->email = $request->email;
            $user->gender = $request->gender;
            $user->occupation = $request->occupation;
            $user->hobby = json_encode($request->hobby);

            $user->save();
            session()->flash('create_user', 'User create successfully');
            return redirect('/admin');

        } catch ( \Exception $e ) {
            session()->flash('create_error_user', 'User create unsuccessful');
            return response()->json(['error'=>$e->getMessage()], 500);
        }
    }   

    public function update (Request $request) {
        try {

            $validator = Validator::make(request()->all(), [
                'firstName' => 'required|string',
                'lastName' => 'required|string|min:1',
                'email' => 'required|email',
                'gender' => 'required|string',
                'occupation' => 'required|string',
                'hobby' => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json($validator->messages(), 400);
            }

            $user = Admin::findOrFail(request()->id);

            $user->update([
                'firstName' => $request->firstName,
                'lastName' => $request->lastName,
                'email' => $request->email,
                'gender' => $request->gender,
                'occupation' => $request->occupation,
                'hobby' => gettype($request->hobby) === 'string' ? $request->hobby : json_encode($request->hobby)
            ]);
            session()->flash('update_user', 'User update successfully');
            return redirect('/admin');

        } catch ( \Exception $e ) {
            session()->flash('update_error_user', 'User update unsuccessful');
            return response()->json(['error'=>$e->getMessage()], 500);
        }
    }  

    public function delete(Request $request) {
        try {
            Admin::destroy($request->deleteUserId);
			session()->flash('delete_user', 'User delete successfully!');
        } catch (\Exception $e) {
            session()->flash('delete_error_user', 'User delete unsuccessful');
        }
        return redirect('/admin');
    }
}
