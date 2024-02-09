<?php

namespace App\Http\Controllers;

use App\Models\GeneralStat;
use Illuminate\Http\Request;

class GeneralStatsController extends Controller
{
    public static function newGeneralView()
    {
        $data = [
            "success" => false,
            "message" => null,
            "status" => 500,
        ];
        
        $stats = GeneralStat::firstOrCreate();

        $affectedRows = $stats->increment('visitas');

        $data["success"] = $affectedRows == 1 ? true : false;
        $data["message"] = $data["success"] == true ? "Vista registrada" : "Ocurrio un error al intentar registrar la vista";
        $data["status"] = $data["success"] == true ? 200 : 500;

        return response()->json($data)->setStatusCode($data["status"]);
    }

    public static function newInteraction(Request $request)
    {
        $stats = GeneralStat::first();
        $rowsAffected = 0;

        if($stats != null)
        {
            $rowsAffected = $stats->increment($request->interaction);
        }

        $message = $rowsAffected == 1 ? 'Se modificaron '.$rowsAffected.' columas de estadística.' : 'Ocurrio un error al modificar las estadisticas.';

        $data = [
            'success' => $rowsAffected == 1 ? true : false,
            'message' => $message,
        ];

        return response()->json($data)->setStatusCode($rowsAffected == 1 ? 200:500);        
    }

    public function restartStat(Request $request)
    {
        $column = $request->column;        
        
        $stats = GeneralStat::first();
        $data = [
            "message" => null,
            "success" => false
        ];

        if($column == null)
        {
            $data["message"] = "La peticion no contiene la informacion necesaria para realizar la operacion";
            return response()->json($data)->setStatusCode(418);  
        }

        if($stats == null)
        {
            $data["message"] = "No se encontro las estadisticas en la BBDD.";
            return response()->json($data)->setStatusCode(500);  
        }

        $stats->$column = 0;
        $data["success"] = $stats->update();
        $data["message"] = $data["success"] == true ? "Reinicio exitoso" : "Ocurrio un error al intentar reiniciar";
        return response()->json($data)->setStatusCode($data["success"] == true ? 200:500);    
    }
}
