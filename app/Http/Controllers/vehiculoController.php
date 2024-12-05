<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\vehiculo;
use Throwable;

class vehiculoController extends Controller
{
    //
    public function get(){
        try {
            $data=vehiculo::get();
            return response()->json($data, 200);
        } catch(\Throwable $th){
            return response()->json(['error'=>$th->getMessage()],500);
        }

    }
//crea un vehiculo
public function create (Request $request){
    try{
        $data['Tipo_vehiculo']=$request['tipo_vehiculo'];
        $data['categoria']=$request['categoria'];
        $res = vehiculo::create($data);
            return response()->json($res, 200);
    }catch(\Throwable $th){
        return response()->json(['error'=>$th->getMessage()],500);

    }
}
public function getByID($id){
    try{
        $data=vehiculo::find($id);
        return response()->json($data,200);

    }catch (\Throwable $th){
        return response()->json(['error'=> $th->getMessage()],500);
    }
}
public function update(Request $request,$id){
    try{
        $data['tipo_vehiculo']=$request['tipo_vehiculo'];
        $data['categoria']=$request['categoria'];
        vehiculo::find($id)->update($data);
        $res =vehiculo::find($id);
            return response()->json($res, 200);
    }catch(\Throwable $th){
        return response()->json(['error'=>$th->getMessage()],500);

    }
}
public function delete($id){
    try{
        $res=vehiculo::find($id)->delete();
        return response ()->json(["borrado"=> $res], 200);
    }
    catch(\Throwable $th){
        return response()->json(['error'=> $th->getMessage()],500);
    }
}

}