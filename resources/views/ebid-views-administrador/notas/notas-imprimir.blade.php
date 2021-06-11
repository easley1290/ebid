<html>
<head>
    <style>
        @page {
            margin: 0cm 0cm;
            font-family: Arial;
        }

        body {
            margin: 3cm 2cm 2cm;
        }

        header {
            position: fixed;
            top: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
            background-color: #2a0927;
            color: white;
            text-align: center;
            line-height: 30px;
        }

        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
            background-color: #2a0927;
            color: white;
            text-align: center;
            line-height: 35px;
        }
        table 
        {
            width: 100%;
        }
        th
        {
            background-color: #2a0927;
            color: white;
            text-align: center;
            width: 25%;
        }
        td
        {
            text-align: left;
        }
    }
    </style>
</head>
<body>
<header>
    <h2 style="text-align: center;">Escuela Boliviana de Danza Boliviana</h2>
</header>

<main>
    <h3 style="text-align: center;">Seguimiento de notas</h3>
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
                <td>{{$materiaEstudiante[0]->name}}</td>
                <td><strong>Codigo:</strong></td>
                <td>{{$materiaEstudiante[0]->per_num_documentacion}}</td>
            </tr>
            <tr>
                <td><strong>CI:</strong></td>
                <td>{{$materiaEstudiante[0]->per_num_documentacion}}</td>
                <td><strong>Gestion:</strong></td>
                <td>{{$materiaEstudiante[0]->mate_sem_id}}</td>
            </tr>
            <tr>
                <td><strong>Carrera:</strong></td>
                <td></td>
                <td></td>
                <td>{{$today}}</td>
            </tr>
            <tr></tr>
        </tbody>
    </table>
        
        
        
    <table>
        <thead>
            <tr>
                <th rowspan="2">Id</th>
                <th rowspan="2">Materia</th>
                <th colspan="2">Primer Parcial</th>
                <th colspan="2">Segundo Parcial</th>
                <th colspan="2">Tercer Parcial</th>
                <th colspan="2">Cuarto Parcial</th>
                <th rowspan="2">Segundo Turno</th>
                <th rowspan="2">Nota final</th>
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
            <tr>
                <?php
                    foreach ($materiaEstudiante as $arr) {
                ?>
                        <td>{{$arr->mat_id}}</td>
                        <td>{{$arr->mat_nombre}}</td>
                        <td>{{$arr->nota_final1}}</td>
                        <td></td>
                        <td>{{$arr->nota_final2}}</td>
                        <td></td>
                        <td>{{$arr->nota_final3}}</td>
                        <td></td>
                        <td>{{$arr->nota_final4}}</td>
                        <td></td>
                        <td>{{$arr->nota_dosT}}</td>
                        <td>{{$arr->nota_final}}</td>
                <?php
                    }
                ?>
                
            </tr>
        </tbody>
    </table>

</main>

<footer>
    <h5>*En todos los parciales se consicera 30% en teoria y 70% en la parte práctica.</h5>
</footer>
</body>
</html>
