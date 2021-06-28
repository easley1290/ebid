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
            background-color: #691F53;
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
            background-color: #691F53;
            color: white;
            text-align: center;
            line-height: 5px;
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
            background-color: #691F53;
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
<?php 
$path = '/assets/img/logo.png'; 
$semestre='';
$semestre=0;
if (count($materiaEstudiante)>0) {
    $carrera= (int)substr($materiaEstudiante[0]->mate_mat_id, -3);
    switch ($materiaEstudiante[0]->mate_sem_id) {
        case '1':
            $semestre='Primer Año';
            break;
        case '2':
            $semestre='Segundo Año';
            break;
        case '3':
            $semestre='Tercer Año';
            break;
        case '4':
            $semestre='Cuarto Año';
            break;
        
        default:
            $semestre='No definido';
            break;
    }

    
}
$carrera_nombre= '';
if ($carrera <=399) 
{
    $carrera_nombre = 'Básicas';
}
else
{
    $carrera_nombre = 'Especialidad';
}
?>
<header>
    <div class="container">
        <div class="row">
            <div style="display: inline">
                <img src="http://ebid.edu.bo/assets/img/logo.png" height="60px">
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
                <td class="td_center"><strong><u>SEGUIMIENTO DE NOTAS</u></strong></td>
                <td class="td_right"><strong>Hora:</strong> {{$hour}}</td>                
            </tr>
        </tbody>
    </table>

    <table>
        <thead>
            <tr>
                <th style="background-color: #ffffff;"></th>
                <th style="background-color: #ffffff;"></th>
                <th style="background-color: #ffffff;"></th>
                <th style="background-color: #ffffff;"></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td> <strong>Nombre:</strong> </td>
                <td>{{$persona->name}}</td>
                <td><strong>Código:</strong></td>
                <td>{{$persona->per_codigo_institucional}}</td>
            </tr>
            <tr>
                <td><strong>CI:</strong></td>
                <td>{{$persona->per_num_documentacion}}</td>
                <td><strong>Gestión:</strong></td>
                <td>{{$semestre}}</td>
            </tr>
            <tr>
                <td><strong>Carrera:</strong></td>
                <td>{{$carrera_nombre}}</td>
                <td></td>
                <td></td>
            </tr>
            <tr></tr>
        </tbody>
    </table>
        
        
        
    <table>
        <thead>
            <tr>
                <th rowspan="2" style="width: 10%;">Id</th>
                <th rowspan="2" style="width: 30%;">Materia</th>
                <th colspan="2" style="width: 10%;">Primer Parcial</th>
                <th colspan="2" style="width: 10%;">Segundo Parcial</th>
                <th colspan="2" style="width: 10%;">Tercer Parcial</th>
                <th colspan="2" style="width: 10%;">Cuarto Parcial</th>
                <th rowspan="2" style="width: 10%;">Segundo Turno</th>
                <th rowspan="2" style="width: 10%;">Nota final</th>
            </tr>
            <tr>
                <th >T</th>
                <th >P</th>
                <th >T</th>
                <th >P</th>
                <th >T</th>
                <th >P</th>
                <th >T</th>
                <th >P</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if (count($materiaEstudiante)>0) {
                    foreach ($materiaEstudiante as $arr) {
                        //SEGMENTAR NOTAS
                        $nota1_aux = "0|0|0";
                        $nota2_aux = "0|0|0";
                        $nota3_aux = "0|0|0";
                        $nota4_aux = "0|0|0";

                        $nota1_array = explode("|", $arr->nota_final1);
                        $nota2_array = explode("|", $arr->nota_final2);
                        $nota3_array = explode("|", $arr->nota_final3);
                        $nota4_array = explode("|", $arr->nota_final4);
            ?>
                <tr>
                    <td class="td_center">{{$arr->mat_id}}</td>
                    <td class="td_center">{{$arr->mat_nombre}}</td>
                    <td class="td_center">{{$nota1_array[0]}}</td>
                    <td class="td_center">{{$nota1_array[1]}}</td>
                    <td class="td_center">{{$nota2_array[0]}}</td>
                    <td class="td_center">{{$nota2_array[1]}}</td>
                    <td class="td_center">{{$nota3_array[0]}}</td>
                    <td class="td_center">{{$nota3_array[1]}}</td>
                    <td class="td_center">{{$nota4_array[0]}}</td>
                    <td class="td_center">{{$nota4_array[1]}}</td>
                    <td class="td_center">{{$arr->nota_dosT}}</td>
                    <td class="td_center">{{$arr->nota_final}}</td>
                </tr>
            <?php
                    }
                }
                else {
                    ?>
                    <tr>
                        <td class="td_center" colspan="12">No existen registros de notas de las materias del año que seleccionado</td>
                    </tr>
                    <?php
                }
            ?>
        </tbody>
    </table>

    


</main>

<footer>
    <h5>*En todos los parciales se consicera 30% en teoria y 70% en la parte práctica.</h5>
</footer>
</body>
</html>
