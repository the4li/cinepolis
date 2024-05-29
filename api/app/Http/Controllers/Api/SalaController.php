<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Sala;
use Illuminate\Http\Request;

class SalaController extends Controller
{

    public function asientosSeleccionados($idPelicula, $horario, $idioma)
    {
        $sala = Sala::where('idPelicula', $idPelicula)
        ->where('horario', $horario)
        ->where('idioma', $idioma)
        ->get();
        $asientosSeleccionados = $sala->asientosOcupados;
              return $asientosSeleccionados;
    }


    public function seleccionarAsiento(Request $request){
     
      }

    
}
