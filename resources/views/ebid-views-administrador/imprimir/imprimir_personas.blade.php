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
<?php $path = '/assets/img/logo.png'; 

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
                <td class="td_center"><strong><u>INFORME DEL PERSONAL ADMINISTRATIVO Y DOCENTE</u></strong></td>
                <td class="td_right"><strong>Hora:</strong> {{$hour}}</td>                
            </tr>
        </tbody>
    </table>
    <br><br>
    <table>
        <thead>
            <tr>
                <th colspan="6">Administrativos</th>
            </tr>
            <tr>
                <th style="width: 30%">Nombre</th>
                <th style="width: 15%">Tipo documento</th>
                <th style="width: 10%">Numero de Documento</th>
                <th style="width: 10%">Telefono</th>
                <th style="width: 20%">Correo</th>
                <th style="width: 15%">Cod. Inst.</th>
            </tr>
        </thead>
        <tbody>
            
            <?php
                if ($personas_adm_num>0) {
                    foreach ($personas_adm as $persona_adm) {
            ?>
                <tr>
                    <td>{{$persona_adm->name}}</td>
                    <td class="td_center">{{$persona_adm->subd_nombre}}</td>
                    <td class="td_center">{{$persona_adm->per_num_documentacion}}</td>
                    <td class="td_center">{{$persona_adm->per_telefono}}</td>
                    <td class="td_center">{{$persona_adm->email}}</td>
                    <td class="td_center">{{$persona_adm->per_codigo_institucional}}</td>
                </tr>
                <?php
                    }
                }
                else {
                    ?>
                    <tr>
                        <td class="td_center" colspan="6">NO SE ENCONTRÓ PERSONAL "ADMINSTRATIVO" ACTIVO</td>
                    </tr>
                    <?php
                }
            ?>
            <tr>
                <td colspan="5" class="td_right"><strong>N° Administrativos:</strong> &nbsp;</td>
                <td><strong>{{$personas_adm_num}}</strong></td>
            </tr>
        </tbody>
    </table>
    <br>
    <table>
        <thead>
            <tr>
                <th colspan="6">Docentes</th>
            </tr>
            <tr>
                <th style="width: 30%">Nombre</th>
                <th style="width: 15%">Tipo documento</th>
                <th style="width: 10%">Numero de Documento</th>
                <th style="width: 10%">Telefono</th>
                <th style="width: 20%">Correo</th>
                <th style="width: 15%">Cod. Inst.</th>
            </tr>
        </thead>
        <tbody>
            
            <?php
                if ($personas_doc_num>0) {
                    foreach ($personas_doc as $persona_doc) {
            ?>
                <tr>
                    <td>{{$persona_doc->name}}</td>
                    <td class="td_center">{{$persona_doc->subd_nombre}}</td>
                    <td class="td_center">{{$persona_doc->per_num_documentacion}}</td>
                    <td class="td_center">{{$persona_doc->per_telefono}}</td>
                    <td class="td_center">{{$persona_doc->email}}</td>
                    <td class="td_center">{{$persona_doc->per_codigo_institucional}}</td>
                </tr>
                <?php
                    }
                }
                else {
                    ?>
                    <tr>
                        <td class="td_center" colspan="6">NO SE ENCONTRÓ PERSONAL "DOCENTE" ACTIVO</td>
                    </tr>
                    <?php
                }
            ?>

            <tr>
                <td colspan="5" class="td_right"><strong>N° Docentes:</strong> &nbsp;</td>
                <td><strong>{{$personas_doc_num}}</strong></td>
            </tr>
        </tbody>
    </table>


</main>

<footer>
    <p class="page"></p>
</footer>
</body>
</html>
