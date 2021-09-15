<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends ApiResponseController
{
    public function validarLogin()
    {
        $user=auth()->user();
        return isset($user)? $this->successResponse($user): $this->errorResponse('fail');
    }

    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $validacion=$validator->fails() ? $validator->errors()  : "ok" ;
        if($validacion=="ok")
        {
            $token= $this->crearToken($request);
            return $token==0 ? $this->errorResponse('Usuario o contraseña incorrecto') : $this->successResponse($token);

        }else
        {
            return  $this->errorResponse($validator->errors(),500,'error');
        }
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return $this->respuesta('ok');
    }
    public function crearToken($request)
    {
        $data=request(['email','password']);

        if(Auth::attempt($data))
        {

            $user = $request->user();

            $tokenAuth= $user->createToken('Acceso Correcto');
            $token= $tokenAuth->token;
            $token->expires_at= Carbon::now()->addHours(8);
            $token->save();

            $data=collect(["access_token"=>$tokenAuth->accessToken,
            "token_type"=>'Bearer','expires_at'=> Carbon::parse($tokenAuth->token->expires_at)->toDateTimeString(),'Usuario'=>$user]);
            return $data->all();
        }else{
            return 0;
        }
    }
}
