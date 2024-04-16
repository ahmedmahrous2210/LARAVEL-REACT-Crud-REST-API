<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserStoreRequest;
class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json([
            'results' => $users
        ],200);
    }

    public function store(UserStoreRequest $request)
    {
        try {
            User::create([ 
                'name' =>$request->name,
                'email' =>$request->email,
                'password' =>$request->password
            ]);

            return response()->json([
                'message' => "User succcessfullu created."
            ],200);
            
        } catch (\Exception $e){
            return response()->json([
                'message' =>"Something went really Wrong!"
            ],500);
        }
    }

    public function show($id)
    {
        $users = User::find($id);
        if(!$users){
            return response()->json([
                'message'=>'User Not Found.'
            ],404);
        }
        return response()->json([
            'users' => $users
        ],200);
    }

    public function update(UserStoreRequest $request, $id)
    {
        try{
             $users = User::find($id);
             if(!$users){
                return response()->json([
                    'message'=>'User Not Found.'
                ],404);
             } 
              $users->name = $request->name;
              $users->email = $request->email;
              $users->password = $request->password;

              $users->save();
              return response()->json([
                'message' =>"user succefully updated."
              ],200);

        }catch (\Exception $e) {
            return response()->json([
                'message' => "something went really wrong"
            ],500);
        }
    }

    public function destroy($id)
    {  
        $users = User::find($id);
        if(!$users){
            return response()->json([
                'message'=>'User Not Found.'
            ],404);
        }

        $users->delete();

        return response()->json([
            'message' => "User successfully deleted."
        ],200);

    }
}
