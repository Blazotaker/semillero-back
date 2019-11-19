<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
    }

    tr:nth-child(even) {
    background-color: #dddddd;
    }
</style>
</head>
<body>
    <h1>Periodo académico: {{$periodo->periodo}}</h1>
    <h2>Fecha inicial:  {{$periodo->fecha_inicio}} -  Fecha final: {{$periodo->fecha_fin}} </h2>


    <h2>Actividades</h2>
        @foreach($actividades as $actividad)
            <ul>
                <li>{{$actividad->actividad}}</li>
                <li>{{$actividad->responsable}}</li>
            </ul>
        @endforeach


    <h2>Proyectos</h2>

        @foreach($proyectos as $proyecto)
            <ul>
                <li>{{$proyecto->proyecto}}</li>
            </ul>
         @endforeach


    <h2>Integrantes</h2>
    <table>
        <thead>
            <tr>
                <th>Documento</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Email</th>
                <th>Telefono</th>
            </tr>
        </thead>
        <tbody>
            @foreach($integrantes as $integrante)
            <tr>
                <td>{{$integrante->documento}}</td>
                <td>{{$integrante->nombre_usuario}}</td>
                <td>{{$integrante->apellido_usuario}}</td>
                <td>{{$integrante->email}}</td>
                <td>{{$integrante->telefono}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
