@extends('plantilla');
@section('seccion')
<div>
    <table class="table">
        <thread>
            <tr>
                <th>NOMBRE</th>
                <th>APELLIDOS</th>
                <th>NOTA</th>
            </tr>
        </thread>
        <tbody>
            @foreach($tablaalumnos as $item)
            <form action={{route("nota_ruta")}} method="POST">
                @csrf {{--justo aquí--}}
                <tr>
                    <th>{{$item->nombre}}</th>
                    <th>{{$item->apellidos}}</th>
                    <th>{{$item->nota}}</th>
                    <th><input type="hidden" name="id" value={{$item->id}}></th>
                    <th><input type="text" name="nota"></th>
                    <th><button type="submit" name="accion" value="enviar" class="btn btn-primary">Enviar</button></th>
                    <th><button type="submit" name="accion" value="oficial" class="btn btn-primary">Publicar</button></th>
                </tr>
            </form>

            @endforeach

        </tbody>
    </table>
    Contador de Registros: {{$total}}
</div>
<div class="container">
    <form action="{{route('guardar_ruta')}}" method="POST">
        @csrf {{-- justo aquí --}}
        <div class="form-group row">
            <label for="nombre" class="col-sm-2 col-form-label">Nombre<label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre del usuario">
                    </div>
        </div>
        <div class="form-group row">
            <label for="apellidos" class="col-sm-2 col-form-label">Apellidos<label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Apellidos del usuario">
                    </div>
        </div>
        <div class="form-group row">
            <label for="idProfesor" class="col-sm-2 col-form-label">idProfesor<label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="idProfesor" name="idProfesor" placeholder="idProfesor">
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
