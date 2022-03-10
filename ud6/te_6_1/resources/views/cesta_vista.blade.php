@extends('plantilla');
@section('seccion')
<div>
    <table class="table">
        <thread>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Importe</th>
            </tr>
        </thread>
        <tbody>
            @foreach($tablacestas as $item)
            <form action={{route("modificar_ruta")}} method="POST">
                @csrf {{--justo aquí--}}
                <tr>
                    <th>{{$item->productoNombre}}</th>
                    <th>{{$item->cantidad}}</th>
                    <th>{{$item->precio}}</th>
                    <th>{{$item->precio*$item->cantidad}}</th>
                    <th><input type="hidden" name="id" value={{$item->id}}></th>
                    <th><input type="hidden" name="productoNombre" value={{$item->productoNombre}}></th>
                    <th><input type="hidden" name="precio" value={{$item->precio}}></th>
                    <th><input type="number" name="nuevaCantidad"></th>
                    <th><button type="submit" name="modificar" class="btn btn-primary">Modificar</button></th>
                </tr>
            </form>

            @endforeach

        </tbody>
    </table>
    Registros: {{$total}}
    <p>Importe Total: {{$sumImporte}} €</p>
</div>

@endsection
