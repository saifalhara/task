<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use function PHPSTORM_META\map;

class Users extends Model
{
    use HasFactory;
    public function register($request)
    {
        $user = DB::table("users")->insert([
            'user_name' => $request['userName'],
            'email' => $request['email'],
            'password' => Crypt::encrypt($request['password']),
            "role" => "user"
        ]);
        return $user;
    }
    public function login($request)
    {
        return DB::table("users")
            ->select("email", "password", "role")
            ->where("email", $request['email'])
            ->first();
    }
    public function getAllUsers()
    {
        return $this->select('id' ,'user_name', 'email')
                ->where('role' , '!=' , 'admin')
                ->get();
    }
    public function deleteById($id){
        return DB::table('users')->where('id', $id)->delete();
    }
    public function editUser($id , $username , $email){
        return DB::update("update users set email = ? , user_name = ? where id = ?",
                [$email, $username, $id]);
    }
    public function findUser($email){
        if( DB::table("users")
            ->select("user_name")
            ->where("email", $email)
            ->first()){
            return 1;
            }return 0;
    }
    public function addUser( $username , $email , $password){
            $user = DB::table("users")->insert([
                'user_name' => $username,
                'email' => $email,
                'password' => Crypt::encrypt($password),
                "role" => "user"
            ]);
            return $user;
        }
    };
