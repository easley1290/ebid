<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
        <style>
        h1{
        text-align: center;
        text-transform: uppercase;
        }
        .contenido{
        font-size: 20px;
        }
        #primero{
        background-color: #ccc;
        }
        #segundo{
        color:#44a359;
        }
        #tercero{
        text-decoration:line-through;
        }
    </style>
    </head>
    <body>
        <h3>Escuela Boliviana de Danza Boliviana</h3>
        <hr>
        <table id="notas" class="table card-table table-responsive table-responsive-large" style="width:100%">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre materia</th>
                    <th>1er Parcial</th>
                    <th>2do Parcial</th>
                    <th>3er Parcial</th>
                    <th>4to Parcial</th>
                    <th>Segundo Turno</th>
                    <th colspan="5" style="display: none;"></th>
                    <th>Nota final</th>
                </tr>
            </thead>
            <tbody id="cuerpoTabla"></tbody>
        </table>
    </body>
</html>