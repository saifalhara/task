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
}
