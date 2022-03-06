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
            <form action={{route("anadir_ruta")}} method="POST">
                @csrf {{--justo aquí--}}
                <tr>
                    <th>{{$item->productoNombre}}</th>
                    <th>{{$item->precio}}</th>
                    <input type="hidden" name="productoNombre" value={{$item->productoNombre}}></th>
                    <input type="hidden" name="precio" value={{$item->precio}}></th>
                    <th><button type="submit" name="anadir" class="btn btn-primary">Añadir</button></th>
                </tr>
            </form>
            @endforeach

        </tbody>
    </table>

</div>
<div class="container">
    <form action="{{route('guardar_ruta')}}" method="POST">
        @csrf {{-- justo aquí --}}
        <div class="form-group row">
            <label for="nombre" class="col-sm-2 col-form-label">Nombre<label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre">
                    </div>
        </div>
        <div class="form-group row">
            <label for="precio" class="col-sm-2 col-form-label">Precio<label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="precio" name="precio" placeholder="Precio">
                    </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Enviar</button>
            </div>
        </div>
    </form>
</div>


@endsection
