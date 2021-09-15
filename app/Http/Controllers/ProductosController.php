<?php

namespace App\Http\Controllers;

use App\Models\productos;
use Illuminate\Http\Request;

class ProductosController extends ApiResponseController
{
    public function getListarProductos()
    {
        $data= productos::get();
        return $this->successResponse($data);
    }
    public function getListarProductosMinimos()
    {
        $data= productos::where('inventario','>=','6')->get();
        return $this->successResponse($data);
    }
    public function getInformacionProducto($id)
    {
        $data = productos::where('id',$id)->firstOrFail();
        return $this->successResponse($data);
    }
    public function postCrearProductos(Request $request)
    {

        $dataInsertada = productos::create($request->all());
        return $this->successResponse($dataInsertada,200,'ok');
    }
    public function putActualizarProductos(Request $request, $id){

        $comprobarExisteUsuario=productos::where('id',$id)->first();
        if(isset($comprobarExisteUsuario))
        {
            productos::where('id',$id)->update($request->all());
           return $this->successResponse($request->all(),200,'ok');
        }
        return $this->errorResponse("error",404,"Producto no existe");
    }
    public function deleteEliminarProductos($id){
        $comprobarExisteUsuario=productos::where('id',$id)->first();
        if(isset($comprobarExisteUsuario))
        {
            productos::where('id',$id)->delete();
           return $this->successResponse($comprobarExisteUsuario,200,'ok');
        }
        return $this->errorResponse("error",404,"Usuario No Existe");
    }
}
