
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h3> <b>Cambio de Contraseña</b></h3>
    &nbsp;
    <p>Estimado(a):</p>
    <p>En el presente correo le enviamos el cambio de contraseña que solicito en fecha <b>{{$details['fecha']}}</b> a horas <b>{{$details['hora']}}</b></p>
        <DIV style="display: flex; align-items: center; width: 200px; height: 80px; padding: 10px 40px; border: solid 1px black;">
            <p style="font-size:160%;"><b>{{$details['password']}}</b></p>
        </DIV>
        
    <p>Cabe mencionar que la presente contraseña puede ser cambiada cuando desee. Cuando ingrese al sistema se dirige a la pestaña "Cambiar Contraseña"
        que se encuentra en la barra superior.
    </p>
    <p>El siguiente link lo redirigira al portal:</p>
    <a href="http://ebid.edu.bo/public" target="_blank">http://ebid.edu.bo/public</a>
    &nbsp;
    <p>Saludos</p>
    <p>Administración</p> 
</body>
</html>