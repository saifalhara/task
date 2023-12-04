<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;

class AdminController extends Controller
{

    public function delete($id){
        $user = new Users();
        if ($user->deleteById($id)) {
            return response()->json(["message" => "user deleted successfully"] , 200);
        } else {
            return response()->json(["message" => "Deleted failed"] , 404);
        }
    }
    public function edit($id, $username, $email)
    {
            $user = new Users();
            if($user->findUser($email)){
                return response()->json(["message" => "This email already exists"], 404);
            }
            if ($user->editUser($id, $username, $email)) {
                return response()->json(["message" => "User updated successfully"] , 200);
            } else {
                return response()->json(["message" => "User not found or update failed"], 404);
            }
        }
    public function addUser(Request $request)
    {
        $user = new Users();
        if($user->findUser($request['email'])){
            return response()->json(['message' => 'This email already exists'], 404);
        }
        $username = $request->input('username');
        $email = $request->input('email');
        $password = $request->input('password');
            if ($user->addUser($username, $email, $password)) {
                return response()->json(['message' => 'User added successfully'], 200);
            } else {
                return response()->json(['message' => 'error'], 404);
            }

    }
}
