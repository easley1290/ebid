
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h3> <b>Registro de Formulario</b></h3>
    &nbsp;
    <p>Estimado(a) {{$details['name']}}:</p>
    <p>Le damos la más cordial bienvenida al Sistema de usuarios de la Escuela Boliviana de Danza, 
        le recordamos que las credenciales de acceso son: El correo registrado en el formulario 
        y la contraseña proporcionada en este e-mail:</p>
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