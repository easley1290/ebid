<html>
<head>
    <style>
        @page {
            margin: 0cm 0cm;
            font-family: sans-serif;
        }

        body {
            margin: 3cm 2cm 2cm;
        }

        header {
            position:fixed;
            top: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
            padding-left: 2cm;
            background-color: #4d1448;
            color: white;
            text-align: left;
            line-height: 80px;
            display: inline;
        }

        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 1cm;
            background-color: #4d1448;
            color: white;
            text-align: center;
            line-height: 10px;
        }
        footer .page:after {
            content: counter(page);
            height: 15px;
            font: bold;
        }
        table 
        {
            width: 100%;
        }
        th
        {
            background-color: #61215c;
            color: white;
            text-align: center;
            padding-top: 15px;
            padding-bottom: 15px;

        }
        td
        {
            text-align: left;
            height: 30px;
            font-size: 15px;
        }
        .td_center
        {
            text-align: center !important;
        }
        .td_right
        {
            text-align: right;
        }

    }
    </style>
</head>
<body>
<?php $path = '/assets/img/logo.png'; 

?>
<header>
    <div class="container">
        <div class="row">
            <div style="display: inline">
                <img src="http://ebid.edu.bo/public/assets/img/logo.png" height="60px">
            </div>
            
        </div>
    </div>
    
</header>

<main>
    <table>
        <tbody>
            <tr>
                <td style="width: 25%;"> </td>
                <td style=" width: 50%;" class="td_center"><strong><u>ESCUELA BOLIVIANA INTERCULTURAL DE DANZA</u></strong></td>
                <td style="width: 25%;" class="td_right"><strong>Fecha:</strong> {{$today}}</td>
            </tr>
            <tr>
                <td></td>
                <td class="td_center"><strong><u>INFORME DE ESTUDIANTES INSCRITOS Y REGISTRADOS</u></strong></td>
                <td class="td_right"><strong>Hora:</strong> {{$hour}}</td>                
            </tr>
        </tbody>
    </table>
    <br><br>
    <table>
        <thead>
            <tr>
                <th colspan="6">Estudiantes Inscritos</th>
            </tr>
            <tr>
                <th style="width: 25%">Nombre</th>
                <th style="width: 10%">Telefono</th>
                <th style="width: 20%">Correo</th>
                <th style="width: 10%">Cod. Inst.</th>
                <th style="width: 20%">Correo Inst.</th>
                <th style="width: 15%">Tipo</th>
            </tr>
        </thead>
        <tbody>
            
            <?php
                foreach ($personas_est as $persona_est) {
            ?>
                <tr>
                    <td>{{$persona_est->name}}</td>
                    <td class="td_center">{{$persona_est->per_telefono}}</td>
                    <td class="td_center">{{$persona_est->email}}</td>
                    <td class="td_center">{{$persona_est->per_codigo_institucional}}</td>
                    <td class="td_center">{{$persona_est->per_correo_institucional}}</td>
                    <td class="td_center">{{$persona_est->rol_descripcion}}</td>
                </tr>
            <?php
                }
            ?>
            <tr>
                <td colspan="5" class="td_right"><strong>N° Estudiantes:</strong> &nbsp;</td>
                <td><strong>{{$personas_est_num}}</strong></td>
            </tr>
        </tbody>
    </table>
    <br>
    <table>
        <thead>
            <tr>
                <th colspan="6">Usuarios Registrados</th>
            </tr>
            <tr>
                <th style="width: 25%">Nombre</th>
                <th style="width: 10%">Telefono</th>
                <th style="width: 20%">Correo</th>
                <th style="width: 10%">Cod. Inst.</th>
                <th style="width: 20%">Correo Inst.</th>
                <th style="width: 15%">Tipo</th>
            </tr>
        </thead>
        <tbody>
            
            <?php
                foreach ($personas_usu as $persona_usu) {
            ?>
                <tr>
                    <td>{{$persona_usu->name}}</td>
                    <td class="td_center">{{$persona_usu->per_telefono}}</td>
                    <td class="td_center">{{$persona_usu->email}}</td>
                    <td class="td_center">{{$persona_usu->per_codigo_institucional}}</td>
                    <td class="td_center">{{$persona_usu->per_correo_institucional}}</td>
                    <td class="td_center">{{$persona_usu->rol_descripcion}}</td>
                </tr>
            <?php
                }
            ?>
            <tr>
                <td colspan="5" class="td_right"><strong>N° Usuarios:</strong> &nbsp;</td>
                <td><strong>{{$personas_usu_num}}</strong></td>
            </tr>
        </tbody>
    </table>
</main>

<footer>
    <p class="page"></p>
</footer>
</body>
</html>
