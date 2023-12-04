<?php

namespace App\Http\Controllers;

use Respect\Validation\Validator as v;
use App\Models\User;
use App\Models\Users;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
;
class UserController extends Controller
{
    public function register(Request $request)
    {
        $user = new Users();
        $val = $user->login($request);
        if (!$val) {
            if ($user->register($request)) {
                return view("login", ["message" => "Please login now"]);
            }
        } else {
            return view("register", ["message" => "This email already exist"]);
        }
    }
    public function login(Request $request)
    {

        $emailValidator = v::email();
        $passwordValidator = v::stringType()->notEmpty();
        if ($passwordValidator->validate($request['password']) && $emailValidator->validate($request['email'])) {
            $user = new Users();
            $val = $user->login($request);
            $password = "No User";
            if ($val) {
                $password =  $val->password;
                $role = $val->role;
            } else {
                return view("login", ["message" => "User does not exist"]);
            }
            if (Crypt::decrypt($password) ==  $request['password']) {
                if ($role == 'admin') {
                    $allUsers = $user->getAllUsers();
                    return view("dashboard", ["allUsers" => $allUsers]);
                } else {
                    session(['user' => 'user']);
                    return view("homepage");
                }
            } else {
                return view("login", ["message" => "Wronge password"]);
            }
        }
    }

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
