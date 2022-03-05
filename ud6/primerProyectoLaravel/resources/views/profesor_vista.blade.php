@extends('plantilla');
@section('seccion')
<table class="table">
    <thread>
        <tr>
            <th>Profesor</th>
            <th>Experiencia</th>
        </tr>
    </thread>
    <tbody>
        @foreach($tablaprofesors as $item)
        @csrf {{--justo aquí--}}
        <tr>
            <th>{{$item->nombre}}</th>
            <th>{{$item->experiencia}}</th>
        </tr>


        @endforeach

    </tbody>
</table>
Experiencia total: {{$sumaexp}}

@endsection
