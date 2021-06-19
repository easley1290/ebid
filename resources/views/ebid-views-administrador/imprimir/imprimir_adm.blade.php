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
            height: 1cm;
            background-color: #2a0927;
            color: white;
            text-align: right;
            padding-right: 20px;
            line-height: 5px;
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
<header>
    <h2 style="text-align: center;">ESCUELA BOLIVIANA INTERCULTURAL DE DANZA</h2>
</header>

<main>
    <h3 style="text-align: center; text-decoration: underline;"><strong>REPORTE PERSONAL</strong></h3>
    
        
         
    <table>
        <thead>
            <tr>
                <th colspan="6">Administrativo</th>
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
            ?>
        </tbody>
    </table>

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
            ?>
        </tbody>
    </table>

    <table>
        <thead>
            <tr>
                <th colspan="6">Estudiantes</th>
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
                foreach ($personas_est as $persona_est) {
            ?>
                <tr>
                    <td>{{$persona_est->name}}</td>
                    <td class="td_center">{{$persona_est->subd_nombre}}</td>
                    <td class="td_center">{{$persona_est->per_num_documentacion}}</td>
                    <td class="td_center">{{$persona_est->per_telefono}}</td>
                    <td class="td_center">{{$persona_est->email}}</td>
                    <td class="td_center">{{$persona_est->per_codigo_institucional}}</td>
                </tr>
            <?php
                }
            ?>
        </tbody>
    </table>

    <table>
        <thead>
            <tr>
                <th colspan="6">Usuarios</th>
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
                foreach ($personas_usu as $persona_usu) {
            ?>
                <tr>
                    <td>{{$persona_est->name}}</td>
                    <td class="td_center">{{$persona_usu->subd_nombre}}</td>
                    <td class="td_center">{{$persona_usu->per_num_documentacion}}</td>
                    <td class="td_center">{{$persona_usu->per_telefono}}</td>
                    <td class="td_center">{{$persona_usu->email}}</td>
                    <td class="td_center">{{$persona_usu->per_codigo_institucional}}</td>
                </tr>
            <?php
                }
            ?>
        </tbody>
    </table>

</main>

<footer>
    <h5>{{$today}}</h5>
</footer>
</body>
</html>
