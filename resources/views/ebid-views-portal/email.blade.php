<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
</head>
<body>
    <h3><b>Solicitud de informacion (enviado a traves del formulario del portal web)</b></h3>
    &nbsp;

    <DIV style="display:block;width:600px;height:130px;padding:10px 42px;border:solid 1px black;background-color:red">
        <p style="font-size:120%;"><b>NOTA: NO HAGA CLICK EN NINGUN ENLACE EXTERNO, pueden contener virus o programas maliciosos que pueden afectar al sistema de la institucion</b></p>
        <p style="font-size:120%;"><b>O peor aun ROBAR LA INFORMACION DE NUESTROS QUERIDOS ESTUDIANTES O PERSONAL ADMINISTRATIVO.</b></p>
    </DIV>

    <p>Estimados(as):</p><br>
    
    <p>El presente correo enviado en fecha <b>{{$details['fecha']}}</b> a horas <b>{{$details['hora']}}</b></p>
    <p>Fue enviado por <b>{{ strtoupper($details['nombre']) }}</b> con numero de celular <b>{{ $details['celular'] }}</b> y correo electronico <b>{{ $details['correo'] }}</b></p>
    <p>Con el motivo de <b>{{ strtoupper($details['asunto']) }}</b> registrando tambien el siguiente mensaje:</p>
    <p style="font-size:160%;"><b>{{$details['mensaje']}}</b></p>
    <p>Si corresponde, se recomienda responder la consulta a la brevedad posible.</p><br>
    
    <p>Saludos cordiales</p>
</body>
</html>