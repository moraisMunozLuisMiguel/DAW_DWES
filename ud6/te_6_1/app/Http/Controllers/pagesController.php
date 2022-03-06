<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Cesta;
use Illuminate\support\Facades\DB;

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
        $filtro = 0;
        $tablacestas = DB::table('cestas')->where('cantidad', '!=', '%' . $filtro . '%')->get();
        $total = Cesta::all()->count();
        $sumImporte = DB::table('cestas')->sum('importe');
        return view('cesta_vista', compact('tablacestas', 'total', 'sumImporte'));
    }

    public function guardar(Request $request)
    {
        $producto = new Producto;
        $producto->productoNombre = $request->input("nombre");
        $producto->precio = $request->input("precio");
        $producto->save();
        $tablaproductos = Producto::all();
        return view('producto_vista', compact('tablaproductos'));
    }

    public function anadir(Request $request)
    {
        $cesta = new Cesta;
        $cesta->productoNombre = $request->input("productoNombre");
        $cesta->cantidad = 1;
        $cesta->precio = $request->input("precio");
        $cesta->importe = 0;
        $cesta->save();
        $total = Cesta::all()->count();
        $sumImporte = DB::table('cestas')->sum('importe');
        $filtro = 0;
        $tablacestas = DB::table('cestas')->where('cantidad', '!=', '%' . $filtro . '%')->get();
        return view('cesta_vista', compact('tablacestas', 'total', 'sumImporte'));
    }

    public function modificar(Request $request)
    {
        $productoNombre = $request->input("productoNombre");
        $nuevaCantidad = $request->input("nuevaCantidad");
        DB::table('cestas')->where('productoNombre', $productoNombre)->update(['cantidad' => $nuevaCantidad]);
        if ($nuevaCantidad == 0) {
            DB::table('cestas')->where('productoNombre', $productoNombre)->delete();
        }
        $total = Cesta::all()->count();
        $sumImporte = DB::table('cestas')->sum('importe');
        $filtro = 0;
        $tablacestas = DB::table('cestas')->where('cantidad', '!=', '%' . $filtro . '%')->get();
        return view('cesta_vista', compact('tablacestas', 'total', 'sumImporte'));
    }
}
