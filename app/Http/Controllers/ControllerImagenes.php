<?php

namespace App\Http\Controllers;

use App\Models\productos;
use App\Models\User;
use Illuminate\Http\Request;

class ControllerImagenes extends ApiResponseController
{
    public function postSubirimagen(Request $request)
    {

            $request->validate([
                'imagen' => 'mimes:png,jpg,jpeg,bmp'
            ]);

            $nombreImagen = $request->tipo. "/".time() . "." . $request->imagen->extension();
            if($request->tipo=="productos")
            {
                productos::where('id',$request->id)->update(["imagen"=>$nombreImagen]);
                $request->imagen->move(public_path('productos'),$nombreImagen);
            }else
            {
                User::where('id',$request->id)->update(["imagen"=>$nombreImagen]);
                $request->imagen->move(public_path('usuarios'),$nombreImagen);
            }

            return $this->successResponse("ok");

    }
}
