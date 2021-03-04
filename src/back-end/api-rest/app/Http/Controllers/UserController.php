<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Users;


class UserController extends Controller
{
    public function login(Request $request){

        $jwtAuth = new \JwtAuth();
        $json = $request->input('json', null);
        $requestParams = json_decode($json);
        $params_array = json_decode($json, true);

        $validate = \Validator::make($params_array,[
            'mail'  => 'required|email',
            'pass' => 'required',
    ]);

    if($validate ->fails()){
        $signup = array(
                'status' => 'error',
                'code' => 404,
                'message' => 'El usuario no se ha podido indentificar',
                'errors' => $validate->errors()
        );
    }else{

        $pwd = hash('sha256',$requestParams->pass);
        $signup = $jwtAuth->signup($requestParams->mail,$pwd);

        if(!empty($requestParams->gettoken)){
            $signup = $jwtAuth->signup($params->mail,$pwd,true);
        }
    }
    return response()->json($signup,200);

    }
}
