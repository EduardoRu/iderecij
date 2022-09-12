<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        *{
            font-family: sans-serif;
        }
        .page-break {
            page-break-after: always;
        }
        table, tr, td {
            margin: 0 auto; /* or margin: 0 auto 0 auto */
            width: 100%;
            border: 1px solid;
            border-collapse: collapse;
        }
        th{
            width: 50%
        }
        #count{
            color: white;
        }
        table->tr->#numAlumno{
            width: 20%
        }
        </style>
    <title>Document</title>
</head>
<body>
    <div id="count">
        {{$x=1;}}
        {{$grupoc = $claves[0]->grupo}}
        {{$grupog = $claves[0]->grado}}
    </div>
    <div style="text-align: center">
        <h2>
            Claves para los grupos de la institución: {{$claves[0]->nombre_institucion}}
        </h2>
        <h2>
            {{$claves[0]->grado}} - {{$claves[0]->grupo}}
        </h2>
    </div>
   <div id="test">
    <table>
        <tr>
            <th>#</th>
            <th>Clave</th>
            <th>Grado</th>
            <th>Grupo</th>
        </tr>
        @foreach ($claves as $c)
        @if ($c->grupo != $grupoc || $c->grado != $grupog)
            <div class="page-break"></div>
            <h1 style="text-align: center">{{$grupog = $c->grado}} - {{$grupoc = $c->grupo}}</h1>
            <div id="count">
                {{$x=1;}}
            </div>
            <tr>
                <td id="numAlumno">{{$x++;}}</td>
                <td>{{$c->clave}}</td>
                <td>{{$c->grado}}</td>
                <td>{{$c->grupo}}</td>
            </tr>
        @else
        <tr>
            <td id="numAlumno">{{$x++;}}</td>
            <td>{{$c->clave}}</td>
            <td>{{$c->grado}}</td>
            <td>{{$c->grupo}}</td>
        </tr>
        @endif
        @endforeach
    </table>
   </div>
</body>
</html>