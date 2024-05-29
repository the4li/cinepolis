<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pelicula;
use Illuminate\Http\Request;

class PeliculaController extends Controller
{
    public function index()
    {
        $peliculas = Pelicula::all();
        return $peliculas;
    }

    public function show($id){
        $pelicula = Pelicula::find($id);
      return $pelicula;
    }

    public function buscar(Request $request){
        $buscar = $request->input('busqueda');
        $peliculas = Pelicula::where('nombre', 'LIKE', '%' . $buscar . '%')->get();

      return $peliculas;
    }

    
}
