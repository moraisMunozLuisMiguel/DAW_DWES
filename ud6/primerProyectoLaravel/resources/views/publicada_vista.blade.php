@extends('plantilla');
@section('seccion')
<div>
    <table class="table">
        <thread>
            <tr>
                <th>NOMBRE ALUMNO</th>
                <th>NOMBRE PROFESOR</th>
                <th>NOTA</th>
            </tr>
        </thread>
        <tbody>
            @foreach($tablapublicada as $item)

            @csrf {{--justo aquí--}}
            <tr>
                <th>{{$item->nombre}}</th>
                <th>{{$item->ProfeNombre}}</th>
                <th>{{$item->nota}}</th>
            </tr>


            @endforeach

        </tbody>
    </table>

</div>


@endsection
