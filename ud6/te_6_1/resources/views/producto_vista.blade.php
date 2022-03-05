@extends('plantilla');
@section('seccion')
<div>
    <table class="table">
        <thread>
            <tr>
                <th>Producto</th>
                <th>Precio</th>
            </tr>
        </thread>
        <tbody>
            @foreach($tablaproductos as $item)

            <tr>
                <th>{{$item->productoNombre}}</th>
                <th>{{$item->precio}}</th>

            </tr>

            @endforeach

        </tbody>
    </table>

</div>


@endsection
