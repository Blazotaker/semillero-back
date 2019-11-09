<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

        Hola <i>{{ $union['coordinador']->nombre_usuario }} {{ $union['coordinador']->apellido_usuario }}  </i>,
        <p>Una persona ha solicitado ingresar al semillero {{$union['coordinador']->semillero}}</p>

        <p><u>La información de la persona es la siguiente:</u></p>

        <div>
            <p><b>Documento:</b>&nbsp;{{ $union['data']->documento }}</p>
            <p><b>Nombre:</b>&nbsp;{{  $union['data']->nombre_usuario }} {{ $union['data']->apellido_usuario }} </p>
            <p><b>Email:</b>&nbsp;{{ $union['data']->email }}</p>
            <p><b>Telefono:</b>&nbsp;{{ $union['data']->telefono }}</p>
            <p><b>Perfil:</b>&nbsp;{{ $union['data']->tipo_usuario }}</p>

        </div>

        Por favor realizar el proceso de inscripción si usted considera necesario realizarlo,
        atentamente
        <br/>
        <i>Semilleros Poli</i>

        <p>Este mensaje ha sido generado de manera automática no por favor responda a este correo, ya que no es revisado
            personal humano
        </p>

</body>
</html>

