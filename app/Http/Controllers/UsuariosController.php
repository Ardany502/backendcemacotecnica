<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuariosController extends ApiResponseController
{
    public function index()
    {

    }
    public function postCrearUsuario(Request $request)
    {
         $data=$request->all();
         $data['password']= Hash::make($request->password);
         $dataInsertada = User::create($data);
         return $this->successResponse($dataInsertada,200,'ok');
    }
    public function putActualizarUsuario(Request $request, $id)
    {
         $comprobarExisteUsuario=User::where('id',$id)->first();
         if(isset($comprobarExisteUsuario))
         {
            User::where('id',$id)->update($request->all());
            return $this->successResponse($request->all(),200,'ok');
         }
         return $this->errorResponse("error",404,"Usuario No Existe");

    }
    public function deleteEliminar($id)
    {
        $comprobarExisteUsuario=User::where('id',$id)->first();
        if(isset($comprobarExisteUsuario))
        {
           User::where('id',$id)->delete();
           return $this->successResponse($comprobarExisteUsuario,200,'ok');
        }
        return $this->errorResponse("error",404,"Usuario No Existe");
    }
}
