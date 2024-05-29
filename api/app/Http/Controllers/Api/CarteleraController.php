<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cartelera;
use App\Models\Pelicula;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class CarteleraController extends Controller
{

    public function index()
    {
        $cartelera = DB::table('Peliculas')
            ->join('Cartelera', 'Peliculas.id', '=', 'Cartelera.idPelicula')
            ->select('Peliculas.id','Peliculas.nombre', 'Peliculas.imagen', DB::raw('GROUP_CONCAT(Cartelera.horario) as horarios'), DB::raw('GROUP_CONCAT(Cartelera.idioma) as idiomas'))
            ->groupBy('Peliculas.id')
            ->groupBy('Peliculas.nombre')
            ->groupBy('Peliculas.imagen')
            ->get();

            

              return $cartelera;
    }

    public function asientosSeleccionados($idPelicula, $horario, $idioma)
    {
      $cartelera = Cartelera::
      where('idPelicula', $idPelicula)
      ->where('horario', $horario)
      ->where('idioma', $idioma)
      ->first();
      $asientosSeleccionados = json_decode($cartelera->asientosOcupados);
      return $asientosSeleccionados;
  
    }

    public function seleccionarAsiento($idPelicula, $horario, $idioma, Request $request)
{
  $nuevosAsientosOcupados = $request->input('asientosOcupados');
  $cartelera = Cartelera::
    where('idPelicula', $idPelicula)
    ->where('horario', $horario)
    ->where('idioma', $idioma)
    ->first();


    if ($cartelera) {
      $asientosOcupados = json_decode($cartelera->asientosOcupados);
  
      if (empty($asientosOcupados)) {
          // Si el arreglo está vacío, insertar el nuevo arreglo directamente
          $cartelera->asientosOcupados = json_encode($nuevosAsientosOcupados);
      } else {
          // Si el arreglo no está vacío, combinarlo con el nuevo arreglo
          $dataArray = array_merge($asientosOcupados, $nuevosAsientosOcupados);
          $cartelera->asientosOcupados = json_encode($dataArray);
      }
  
      $cartelera->save();
  
      return response()->json(['message' => 'Arreglo guardado correctamente']);
  } else {
      return response()->json(['message' => 'No se encontró la entrada en la tabla Cartelera'], 404);
  }
}

  
}
