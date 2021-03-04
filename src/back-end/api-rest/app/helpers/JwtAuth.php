<?php

namespace App\Helpers;

use Firebase\JWT\JWT;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class JwtAuth{
    
    public $key = "TFGjavierRivillaSalcedoBK0624";

    public function __construct(){
        $this->key = "TFGjavierRivillaSalcedoBK0624";
    }

    

    public function signup($email, $password, $getToken=null){

        $user = User::where(['mail' => $email, 'pass' => $password,'active' => 1])->first();

        $data = array(
            'status' => 'Error',
            'message' => 'Login incorrecto'
        );

        if(is_object($user)){

            $token = $this->generateToken($user);
            $jwt = JWT::encode($token,$this->key,'HS256');
            $decoded = JWT::decode($jwt,$this->key,["HS256"]);

            if(is_null($getToken)){
                $data = $jwt;
            }else{
                $data = $decoded;
            }
        }
        return $data;

    }

    public function generateToken($user){

        return array(
            'sub' =>   $user->idUser,
            'email'=>  $user->mail,
            'name' => $user->userName,
            'surname'=>  $user->userSurname,
            'dni' => $user->dni,
            'image' => $user->profileImage,
            'role' => $user->idRole,
            'iat'=>  time(),
            'exp'=>  time() + (7*24*60*60)
        );
    }

    public function checkToken($jwt, $getIdentity=false){

        $auth=false;

        try{
            $jwt = \str_replace('"','',$jwt);
            $decoded = JWT::decode($jwt,$this->key,["HS256"]);
        }catch(\UnexpectedValueException $e){
            $auth=false;
        }catch(\DomainException $e){
            $auth=false;
        }
        
        $auth = (!empty($decoded) && is_object($decoded) && isset($decoded->sub));
       
        if($getIdentity){
            return $decoded;
        }else{
            return $auth;
        }
    }


}