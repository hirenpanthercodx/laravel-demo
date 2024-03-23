<?php

namespace App\Http\Controllers;

use App\Models\post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    public function employeeDashboardData() {
        $id = Session::get('auth_user')->id;
        $postdata = User::find($id)->getPostById;
        // $postdata2 = User::with('getPostById')->find($id);

        // $postData = \DB::table('users')->where('users.id', $id)->select('posts.id as post_id','users.*')->leftJoin('posts', 'posts.user_id', '=', 'users.id')->get();

        return view('Employee.index', ['postByUser' => $postdata]);
    }

    public function editPost(Request $request) {
        $postdata = post::findOrFail($request->id);
        return view('Employee.addPost', ['editPost' => $postdata]);
    }

    public function store(Request $request) {
        try {

            $validator = Validator::make(request()->all(), [
                'uploadfile' => 'required',
                'description' => 'required|string',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->messages(), 400);
            }

            $file = $request->file('uploadfile');
            $name = $file->getFilename() . '.' . $file->extension();
            Storage::putFileAs('public', $file, $name);

            $user = new post();
            $user->user_id = Session::get('auth_user')->id;
            $user->image = $name;
            $user->description = $request->description;
            $user->save();

            return redirect('/employee');

        } catch ( \Exception $e ) {
            return response()->json(['error'=>$e->getMessage()], 500);
        }
    }

    public function update(Request $request) {
        try {

            $validator = Validator::make(request()->all(), [
                'uploadfile' => 'required',
                'description' => 'required|string',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->messages(), 400);
            }

            if ($request->image !== $request->oldImage) {
                Storage::delete('public/' . $request->oldImage);

                $file = $request->file('uploadfile');
                $name = $file->getFilename() . '.' . $file->extension();
                Storage::putFileAs('public', $file, $name);
            }
            $user = post::find($request->id);
            $user->user_id = Session::get('auth_user')->id;
            $user->image = $name;
            $user->description = $request->description;
            $user->update();
            return redirect('/employee');

        } catch ( \Exception $e ) {
            return response()->json(['error'=>$e->getMessage()], 500);
        }
    }

    public function delete(Request $request) {
        post::destroy($request->id);
        return redirect('/employee');
    }
}
