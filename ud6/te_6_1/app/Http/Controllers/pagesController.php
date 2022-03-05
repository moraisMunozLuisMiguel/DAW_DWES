<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
//use App\Models\Cesta;
//use Illuminate\support\Facades\DB;

class pagesController extends Controller
{
    //
    public function inicio()
    {
        return view('inicio_vista');
    }

    public function producto()
    {
        $tablaproductos = Producto::all();
        return view('producto_vista', compact('tablaproductos'));
    }
    public function cesta()
    {
        return view('cesta_vista');
    }
}
