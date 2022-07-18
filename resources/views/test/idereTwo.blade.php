@extends('layouts.appUser')
@section('title', 'Encuesta • IDERE')
@section('contenido')

<script src="{{asset('js/calr.js')}}"></script>

<div style="text-align: center; padding-top:2%; padding-bottom:2%">
    <h1>Test IDERE</h1>
</div>

<div class="container" style="padding-bottom: 3%">
    <div class="card">
        <div class="card-header">
            <P class="border-1">
                Estamos haciendo un estudio sobre diversos aspectos de la vida de los niños y jóvenes mexicanos. Este cuestionario es confidencial.
                Agreadecemos su colaboración para presentarlo. Tu opinión será de gran utilidad para brindar mejores servicios a la población objetivo
                de Centro de Integración Juvenil.
                <br>
                <hr>
                Favor de responder todas las preguntas, selecciona la respuesta más similar a tu situación. Recuerda <b>NO</b> hay respuestas buenas ni malas
            </P>
        </div>
        <div class="card-body">
            <div>
                <form action="{{route('test.store')}}" method="POST" onsubmit="cal()">
                    @csrf
                    @method('post')
                    
                    <input name="invisible" type="hidden" value="secret">
                    <input type="text" hidden id="res" name="res">
                    <!--C-SM-->
                    <input type="text" hidden value="{{$clave->idclave_alumno}}" name="idclave" id="idclave">
                    <div class="row">
                        <div class="col-9">
                            1.- Estás preocupado la mayor parte del tiempo
                        </div>
                        <div class="col-1">
                            <label for="SM1"> Sí </label>
                            <input type="radio" name="SM1" id="SM1" value="1" required>
                            
                        </div>
                        <div class="col-1">
                            <label for="SM2"> No </label>
                            <input type="radio" name="SM1" id="SM2" value="0" required>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-9">
                            2.- Frecuentemente te sientes solo
                        </div>
                        <div class="col-1">
                            <label for="SM3"> Sí </label>
                            <input type="radio" name="SM2" id="SM3" value="1" required>
                        </div>
                        <div class="col-1">
                            <label for="SM4"> No </label>
                            <input type="radio" name="SM2" id="SM4" value="0" required>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-9">
                            3.- Te sientes nervioso la mayor parte del tiempo
                        </div>
                        <div class="col-1">
                            <label for="SM5"> Sí </label>
                            <input type="radio" name="SM3" id="SM5" value="1" required>
                        </div>
                        <div class="col-1">
                            <label for="SM6"> No </label>
                            <input type="radio" name="SM3" id="SM6" value="0" required>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-9">
                            4.- Con frecuencia te sientes triste
                        </div>
                        <div class="col-1">
                            <label for="SM7"> Sí </label>
                            <input type="radio" name="SM4" id="SM7" value="1" required>
                        </div>
                        <div class="col-1">
                            <label for="SM8"> No </label>
                            <input type="radio" name="SM4" id="SM8" value="0" required>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-9">
                            5.- Frecuentemente, sientes ganas de llorar
                        </div>
                        <div class="col-1">
                            <label for="SM9"> Sí </label>
                            <input type="radio" name="SM5" id="SM9" value="1" required>
                        </div>
                        <div class="col-1">
                            <label for="SM10"> No </label>
                            <input type="radio" name="SM5" id="SM10" value="0" required>
                        </div>
                            <input type="number" hidden value="0" id="SM" name="SM">
                    </div>
                    <!--E-C-SM-->
                    <hr>
            
                    <!--C-SF-->
                    <div class="row">
                        <div class="col-9">
                            6.- La mayoría de las veces saben tus padres o tutores dónde estás y qué haces
                        </div>
                        <div class="col-1">
                            <label for="SF1"> Sí </label>
                            <input type="radio" name="SF1" id="SF1" value="0" required>
                        </div>
                        <div class="col-1">
                            <label for="SF2"> No </label>
                            <input type="radio" name="SF1" id="SF2" value="1" required>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-9">
                            7.- A tus padres o tutores, les gusta hablar y estar contigo
                        </div>
                        <div class="col-1">
                            <label for="SF3"> Sí </label>
                            <input type="radio" name="SF2" id="SF3" value="0" required>
                        </div>
                        <div class="col-1">
                            <label for="SF4"> No </label>
                            <input type="radio" name="SF2" id="SF4" value="1" required>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-9">
                            8.- Saben tus padres o tutores cómo piensas o cómo te sientes realmente
                        </div>
                        <div class="col-1">
                            <label for="SF5"> Sí </label>
                            <input type="radio" name="SF3" id="SF5" value="0" required>
                        </div>
                        <div class="col-1">
                            <label for="SF6"> No </label>
                            <input type="radio" name="SF3" id="SF6" value="1" required>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-9">
                            9.- Tus amigos son del agrado de tus apdres o tutores
                        </div>
                        <div class="col-1">
                            <label for="SF7"> Sí </label>
                            <input type="radio" name="SF4" id="SF7" value="0" required>
                        </div>
                        <div class="col-1">
                            <label for="SF8"> No </label>
                            <input type="radio" name="SF4" id="SF8" value="1" required>
                        </div>
                        <input type="number" hidden value="0" id="SF" name="SF">
                    </div>
                    <!--E-C-SF-->
                    <hr>
                    <!--C-PP-->
                    <div class="row">
                        <div class="col-9">
                            10.- Es necesario fumar para que tus amigos te acepten
                        </div>
                        <div class="col-1">
                            <label for="PP1"> Sí </label>
                            <input type="radio" name="PP1" id="PP1" value="1" required>
                        </div>
                        <div class="col-1">
                            <label for="PP2"> No </label>
                            <input type="radio" name="PP1" id="PP2" value="0" required>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-9">
                            11.- Es necesario beber alcohol para que tus amigos te acepten
                        </div>
                        <div class="col-1">
                            <label for="PP3"> Sí </label>
                            <input type="radio" name="PP2" id="PP3" value="1" required>
                        </div>
                        <div class="col-1">
                            <label for="PP4"> No </label>
                            <input type="radio" name="PP2" id="PP4" value="0" required>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-9">
                            12.- Es necesario usar drogas para que tus amigos te acepten
                        </div>
                        <div class="col-1">
                            <label for="PP5"> Sí </label>
                            <input type="radio" name="PP3" id="PP5" value="1" required>
                        </div>
                        <div class="col-1">
                            <label for="PP6"> No </label>
                            <input type="radio" name="PP3" id="PP6" value="0" required>
                        </div>
                        <input type="number" hidden value="0" id="PP" name="PP">
                    </div>
                    <!--E-C-PP-->
                    <hr>
                    <!--C-DSEC-->
                    <div class="row">
                        <div class="col-9">
                            13.- Alguno de tus mejores amigos fuma
                        </div>
                        <div class="col-1">
                            <label for="DSEC1"> Sí </label>
                            <input type="radio" name="DSEC1" id="DSEC1" value="1" required>
                        </div>
                        <div class="col-1">
                            <label for="DSEC2"> No </label>
                            <input type="radio" name="DSEC1" id="DSEC2" value="0" required>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-9">
                            14.- Alguno de tus mejores amigos bebe alcohol con frecuencia
                        </div>
                        <div class="col-1">
                            <label for="DSEC3"> Sí </label>
                            <input type="radio" name="DSEC2" id="DSEC3" value="1" required>
                        </div>
                        <div class="col-1">
                            <label for="DSEC4"> No </label>
                            <input type="radio" name="DSEC2" id="DSEC4" value="0" required>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-9">
                            15.- Alguno de tus mejores amigos usa drogas
                        </div>
                        <div class="col-1">
                            <label for="DSEC5"> Sí </label>
                            <input type="radio" name="DSEC3" id="DSEC5" value="1" required>
                        </div>
                        <div class="col-1">
                            <label for="DSEC6"> No </label>
                            <input type="radio" name="DSEC3" id="DSEC6" value="0" required>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-9">
                            16.- Fumar calma los nervios
                        </div>
                        <div class="col-1">
                            <label for="DSEC7"> Sí </label>
                            <input type="radio" name="DSEC4" id="DSEC7" value="1" required>
                        </div>
                        <div class="col-1">
                            <label for="DSEC8"> No </label>
                            <input type="radio" name="DSEC4" id="DSEC8" value="0" required>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-9">
                            17.- El alcohol ayuda a olvidar los problemas
                        </div>
                        <div class="col-1">
                            <label for="DSEC9"> Sí </label>
                            <input type="radio" name="DSEC5" id="DSEC9" value="1" required>
                        </div>
                        <div class="col-1">
                            <label for="DSEC10"> No </label>
                            <input type="radio" name="DSEC5" id="DSEC10" value="0" required>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-9">
                            18.- Las drogas ayudan a olvidar problemas
                        </div>
                        <div class="col-1">
                            <label for="DSEC11"> Sí </label>
                            <input type="radio" name="DSEC6" id="DSEC11" value="1" required>
                        </div>
                        <div class="col-1">
                            <label for="DSEC12"> No </label>
                            <input type="radio" name="DSEC6" id="DSEC12" value="0" required>
                        </div>
                        <input type="number" hidden value="0" id="DSEC" name="DSEC">
                    </div>
                    <!--E-C-DSEC-->
                    <hr>
                    <!--C-PR-->
                    <div class="row">
                        <div class="col-9">
                            19.- El consumo de drogas es un problema
                        </div>
                        <div class="col-1">
                            <label for="PRO1"> Sí </label>
                            <input type="radio" name="PR1" id="PRO1" value="0" required>
                        </div>
                        <div class="col-1">
                            <label for="PRO2"> No </label>
                            <input type="radio" name="PR1" id="PRO2" value="1" required>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-9">
                            20.- Usar drogas hace daño
                        </div>
                        <div class="col-1">
                            <label for="PRO3"> Sí </label>
                            <input type="radio" name="PR2" id="PRO3" value="0" required>
                        </div>
                        <div class="col-1">
                            <label for="PRO4"> No </label>
                            <input type="radio" name="PR2" id="PRO4" value="1" required>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-9">
                            21.- Drogarse es peligroso
                        </div>
                        <div class="col-1">
                            <label for="PRO5"> Sí </label>
                            <input type="radio" name="PR3" id="PRO5" value="0" required>
                        </div>
                        <div class="col-1">
                            <label for="PRO6"> No </label>
                            <input type="radio" name="PR3" id="PRO6" value="1" required>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-9">
                            22.- Usar drogas puede causar la muerte
                        </div>
                        <div class="col-1">
                            <label for="PRO7"> Sí </label>
                            <input type="radio" name="PR4" id="PRO7" value="0" required>
                        </div>
                        <div class="col-1">
                            <label for="PRO8"> No </label>
                            <input type="radio" name="PR4" id="PRO8" value="1" required>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-9">
                            23.- Las drogas dañan el cuerpo
                        </div>
                        <div class="col-1">
                            <label for="PRO9"> Sí </label>
                            <input type="radio" name="PR5" id="PRO9" value="0" required>
                        </div>
                        <div class="col-1">
                            <label for="PRO10"> No </label>
                            <input type="radio" name="PR5" id="PRO10" value="1" required>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-9">
                            24.- Las drogas provocan enfermedad
                        </div>
                        <div class="col-1">
                            <label for="PRO11"> Sí </label>
                            <input type="radio" name="PR6" id="PRO11" value="0" required>
                        </div>
                        <div class="col-1">
                            <label for="PRO12"> No </label>
                            <input type="radio" name="PR6" id="PRO12" value="1" required>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-9">
                            25.- Las drogas afectan el cerebro
                        </div>
                        <div class="col-1">
                            <label for="PRO13"> Sí </label>
                            <input type="radio" name="PR7" id="PRO13" value="0" required>
                        </div>
                        <div class="col-1">
                            <label for="PRO14"> No </label>
                            <input type="radio" name="PR7" id="PRO14" value="1" required>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-9">
                            26.- Usar drogas te puede hacer adicto
                        </div>
                        <div class="col-1">
                            <label for="PRO15"> Sí </label>
                            <input type="radio" name="PR8" id="PRO15" value="0" required>
                        </div>
                        <div class="col-1">
                            <label for="PRO16"> No </label>
                            <input type="radio" name="PR8" id="PRO16" value="1" required>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-9">
                            27.- Usar drogas ocasiona problemas
                        </div>
                        <div class="col-1">
                            <label for="PRO17"> Sí </label>
                            <input type="radio" name="PR9" id="PRO17" value="0" required>
                        </div>
                        <div class="col-1">
                            <label for="PRO18"> No </label>
                            <input type="radio" name="PR9" id="PRO18" value="1" required>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-9">
                            28.- Es necesario usar drogas para sentirse bien
                        </div>
                        <div class="col-1">
                            <label for="PRO19"> Sí </label>
                            <input type="radio" name="PR10" id="PRO19" value="1" required>
                        </div>
                        <div class="col-1">
                            <label for="PRO20"> No </label>
                            <input type="radio" name="PR10" id="PRO20" value="0" required>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-9">
                            29.- Es necesario usar drogas para divertirse
                        </div>
                        <div class="col-1">
                            <label for="PRO21"> Sí </label>
                            <input type="radio" name="PR11" id="PRO21" value="1" required>
                        </div>
                        <div class="col-1">
                            <label for="PRO22"> No </label>
                            <input type="radio" name="PR11" id="PRO22" value="0" required>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-9">
                            30.- Puedes decir "No" cuando te ofrecen tabaco, alcohol o drogas
                        </div>
                        <div class="col-1">
                            <label for="PRO23"> Sí </label>
                            <input type="radio" name="PR12" id="PRO23" value="1" required>
                        </div>
                        <div class="col-1">
                            <label for="PRO24"> No </label>
                            <input type="radio" name="PR12" id="PRO24" value="0" required>
                        </div>
                        <input type="number" hidden value="0" id="PRO" name="PRO">
                    </div>
                    <hr>
                    <!--PRO-->
                    <div class="row">
                        <div class="col-9">
                            31.- Fumar es peligroso
                        </div>
                        <div class="col-1">
                            <label for="PRT1"> Sí </label>
                            <input type="radio" name="PR13" id="PRT1" value="0" required>
                        </div>
                        <div class="col-1">
                            <label for="PRT2"> No </label>
                            <input type="radio" name="PR13" id="PRT2" value="1" required>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-9">
                            32.- Fumar causa cáncer
                        </div>
                        <div class="col-1">
                            <label for="PRT3"> Sí </label>
                            <input type="radio" name="PR14" id="PRT3" value="0" required>
                        </div>
                        <div class="col-1">
                            <label for="PRT4"> No </label>
                            <input type="radio" name="PR14" id="PRT4" value="1" required>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-9">
                            33.- Fumar hace daño
                        </div>
                        <div class="col-1">
                            <label for="PRT5"> Sí </label>
                            <input type="radio" name="PR15" id="PRT5" value="0" required>
                        </div>
                        <div class="col-1">
                            <label for="PRT6"> No </label>
                            <input type="radio" name="PR15" id="PRT6" value="1" required>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-9">
                            34.- Aunque no fumes, el humo del cigarro te puede hacer daño
                        </div>
                        <div class="col-1">
                            <label for="PRT7"> Sí </label>
                            <input type="radio" name="PR16" id="PRT7" value="0" required>
                        </div>
                        <div class="col-1">
                            <label for="PRT8"> No </label>
                            <input type="radio" name="PR16" id="PRT8" value="1" required>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-9">
                            35.- Es delito vender cigarros a menores de edad
                        </div>
                        <div class="col-1">
                            <label for="PRT9"> Sí </label>
                            <input type="radio" name="PR17" id="PRT9" value="0" required>
                        </div>
                        <div class="col-1">
                            <label for="PRT10"> No </label>
                            <input type="radio" name="PR17" id="PRT10" value="1" required>
                        </div>
                        <input type="number" hidden value="0" id="PRT" name="PRT">
                    </div>
                    <hr>
                    <!--PRT-->
                    <div class="row">
                        <div class="col-9">
                            36.- Beber alcohol provoca accidentes
                        </div>
                        <div class="col-1">
                            <label for="PRA1"> Sí </label>
                            <input type="radio" name="PR18" id="PRA1" value="0" required>
                        </div>
                        <div class="col-1">
                            <label for="PRA2"> No </label>
                            <input type="radio" name="PR18" id="PRA2" value="1" required>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-9">
                            37.- Tomar alcohol es peligroso
                        </div>
                        <div class="col-1">
                            <label for="PRA3"> Sí </label>
                            <input type="radio" name="PR19" id="PRA3" value="0" required>
                        </div>
                        <div class="col-1">
                            <label for="PRA4"> No </label>
                            <input type="radio" name="PR19" id="PRA4" value="1" required>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-9">
                            38.- Beber alcohol hace daño
                        </div>
                        <div class="col-1">
                            <label for="PRA5"> Sí </label>
                            <input type="radio" name="PR20" id="PRA5" value="0" required>
                        </div>
                        <div class="col-1">
                            <label for="PRA6"> No </label>
                            <input type="radio" name="PR20" id="PRA6" value="1" required>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-9">
                            39.- Beber alcohol te puede hacer adicto
                        </div>
                        <div class="col-1">
                            <label for="PRA7"> Sí </label>
                            <input type="radio" name="PR21" id="PRA7" value="0" required>
                        </div>
                        <div class="col-1">
                            <label for="PRA8"> No </label>
                            <input type="radio" name="PR21" id="PRA8" value="1" required>
                        </div>
                        <input type="number" hidden value="0" id="PRA" name="PRA">
                    </div>
                    <!--E-C-PR-->
                    <hr>
                    <!--C-DE-->
                    <div class="row">
                        <div class="col-9">
                            40.- Te gusta ir a la escuela
                        </div>
                        <div class="col-1">
                            <label for="DE1"> Sí </label>
                            <input type="radio" name="DE1" id="DE1" value="0" required>
                        </div>
                        <div class="col-1">
                            <label for="DE2"> No </label>
                            <input type="radio" name="DE1" id="DE2" value="1" required>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-9">
                            41.- Con frecuencia faltas o llegas tarde a la escuela
                        </div>
                        <div class="col-1">
                            <label for="DE3"> Sí </label>
                            <input type="radio" name="DE2" id="DE3" value="1" required>
                        </div>
                        <div class="col-1">
                            <label for="DE4"> No </label>
                            <input type="radio" name="DE2" id="DE4" value="0" required>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-9">
                            42.- Tienes dificultades para seguir instrucciones
                        </div>
                        <div class="col-1">
                            <label for="DE5"> Sí </label>
                            <input type="radio" name="DE3" id="DE5" value="1" required>
                        </div>
                        <div class="col-1">
                            <label for="DE6"> No </label>
                            <input type="radio" name="DE3" id="DE6" value="0" required>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-9">
                            43.- Has reporbado alguna materia o año escolar
                        </div>
                        <div class="col-1">
                            <label for="DE7"> Sí </label>
                            <input type="radio" name="DE4" id="DE7" value="1" required>
                        </div>
                        <div class="col-1">
                            <label for="DE8"> No </label>
                            <input type="radio" name="DE4" id="DE8" value="0" required>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-9">
                            44.- Te aburres en clases
                        </div>
                        <div class="col-1">
                            <label for="DE9"> Sí </label>
                            <input type="radio" name="DE5" id="DE9" value="1" required>
                        </div>
                        <div class="col-1">
                            <label for="DE10"> No </label>
                            <input type="radio" name="DE5" id="DE10" value="0" required>
                        </div>
                        <input type="number" hidden value="0" id="DE" name="DE">
                    </div>
                    <!--E-C-DE-->
                    <hr>
                    <!--C-VI-->
                    <div class="row">
                        <div class="col-9">
                            45.- Alguna de las personas con quien vives (padres, hermanos, abuelos, tíos) te golpea, insulta, humilla o amenaza
                        </div>
                        <div class="col-1">
                            <label for="VI1"> Sí </label>
                            <input type="radio" name="VI1" id="VI1" value="1" required>
                        </div>
                        <div class="col-1">
                            <label for="VI2"> No </label>
                            <input type="radio" name="VI1" id="VI2" value="0" required>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-9">
                            46.- Has golpeado, humillado o insultado a alguno de tus familiares
                        </div>
                        <div class="col-1">
                            <label for="VI3"> Sí </label>
                            <input type="radio" name="VI2" id="VI3" value="1" required>
                        </div>
                        <div class="col-1">
                            <label for="VI4"> No </label>
                            <input type="radio" name="VI2" id="VI4" value="0" required>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-9">
                            47.- Tus padres o tutores se golpean, gritan o insultan entre sí
                        </div>
                        <div class="col-1">
                            <label for="VI5"> Sí </label>
                            <input type="radio" name="VI3" id="VI5" value="1" required>
                        </div>
                        <div class="col-1">
                            <label for="VI6"> No </label>
                            <input type="radio" name="VI3" id="VI6" value="0" required>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-9">
                            48.- Tus amigos o compañeros te golpean, insultan, humillan o amenzan
                        </div>
                        <div class="col-1">
                            <label for="VI7"> Sí </label>
                            <input type="radio" name="VI4" id="VI7" value="1" required>
                        </div>
                        <div class="col-1">
                            <label for="VI8"> No </label>
                            <input type="radio" name="VI4" id="VI8" value="0" required>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-9">
                            49.- Golpeas, insultas, humillas o amenzas a tus compañeros o amigos
                        </div>
                        <div class="col-1">
                            <label for="VI9"> Sí </label>
                            <input type="radio" name="VI5" id="VI9" value="1" required>
                        </div>
                        <div class="col-1">
                            <label for="VI10"> No </label>
                            <input type="radio" name="VI5" id="VI10" value="0" required>
                        </div>
                        <input type="number" hidden value="0" id="VI" name="VI">
                    </div>
                    <!--E-C-VI-->
                    <hr>
                    <!--C-RIIC-->
                    <div class="row">
                        <div class="col-9">
                            50.- Has tenido dificultades en la escuela por consumir tabaco, alcohol o drogas
                        </div>
                        <div class="col-1">
                            <label for="RIIC1"> Sí </label>
                            <input type="radio" name="RIIC1" id="RIIC1" value="1" required>
                        </div>
                        <div class="col-1">
                            <label for="RIIC2"> No </label>
                            <input type="radio" name="RIIC1" id="RIIC2" value="0" required>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-9">
                            51.- Te gusta competir "A ver quién toma más"
                        </div>
                        <div class="col-1">
                            <label for="RIIC3"> Sí </label>
                            <input type="radio" name="RIIC2" id="RIIC3" value="1" required>
                        </div>
                        <div class="col-1">
                            <label for="RIIC4"> No </label>
                            <input type="radio" name="RIIC2" id="RIIC4" value="0" required>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-9">
                            52.- Te has hecho daño o le has hecho daño a otra persona accidentalmente, estando bajo los efectos del alcohol
                        </div>
                        <div class="col-1">
                            <label for="RIIC5"> Sí </label>
                            <input type="radio" name="RIIC3" id="RIIC5" value="1" required>
                        </div>
                        <div class="col-1">
                            <label for="RIIC6"> No </label>
                            <input type="radio" name="RIIC3" id="RIIC6" value="0" required>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-9">
                            53.- En ocaciones te vas de las fiestas porque no hay bebidas alcohólicas o drogas
                        </div>
                        <div class="col-1">
                            <label for="RIIC7"> Sí </label>
                            <input type="radio" name="RIIC4" id="RIIC7" value="1" required>
                        </div>
                        <div class="col-1">
                            <label for="RIIC8"> No </label>
                            <input type="radio" name="RIIC4" id="RIIC8" value="0" required>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-9">
                            54.- Has hecho algo que normalmente no harías por estar bebido o drogado
                        </div>
                        <div class="col-1">
                            <label for="RIIC9"> Sí </label>
                            <input type="radio" name="RIIC5" id="RIIC9" value="1" required>
                        </div>
                        <div class="col-1">
                            <label for="RIIC10"> No </label>
                            <input type="radio" name="RIIC5" id="RIIC10" value="0" required>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-9">
                            55.- Has tenido problemas con familiare o amigos debido a que consumes bebidas alcohólicas o drogas
                        </div>
                        <div class="col-1">
                            <label for="RIIC11"> Sí </label>
                            <input type="radio" name="RIIC6" id="RIIC11" value="1" required>
                        </div>
                        <div class="col-1">
                            <label for="RIIC12"> No </label>
                            <input type="radio" name="RIIC6" id="RIIC12" value="0" required>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-9">
                            56.- Te da curiosidad probar el tabaco, el alcohol o las drogas
                        </div>
                        <div class="col-1">
                            <label for="RIIC13"> Sí </label>
                            <input type="radio" name="RIIC7" id="RIIC13" value="1" required>
                        </div>
                        <div class="col-1">
                            <label for="RIIC14"> No </label>
                            <input type="radio" name="RIIC7" id="RIIC14" value="0" required>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-9">
                            57.- Alguien te ha dado, ofrecido o vendido cigarrillos o bebidas alcohólicas
                        </div>
                        <div class="col-1">
                            <label for="RIIC15"> Sí </label>
                            <input type="radio" name="RIIC8" id="RIIC15" value="1" required>
                        </div>
                        <div class="col-1">
                            <label for="RIIC16"> No </label>
                            <input type="radio" name="RIIC8" id="RIIC16" value="0" required>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-9">
                            58.- Alguien te ha dado, ofrecido o vendido drogas
                        </div>
                        <div class="col-1">
                            <label for="RIIC17"> Sí </label>
                            <input type="radio" name="RIIC9" id="RIIC17" value="1" required>
                        </div>
                        <div class="col-1">
                            <label for="RIIC18"> No </label>
                            <input type="radio" name="RIIC9" id="RIIC18" value="0" required>
                        </div>
                        <input type="number" hidden value="0" id="RIIC" name="RIIC">
                    </div>
                    <!--E-C-RIIC-->
                    <hr>
                    <!--C-CS-->
                    <div class="row">
                        <div class="col-9">
                            59.- Has fumado alguna vez en tu vida
                        </div>
                        <div class="col-1">
                            <label for="CSA1"> Sí </label>
                            <input type="radio" name="CS1" id="CSA1" value="1" required>
                        </div>
                        <div class="col-1">
                            <label for="CSA2"> No </label>
                            <input type="radio" name="CS1" id="CSA2" value="0" required>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-9">
                            60.- Has fumado en el último año
                        </div>
                        <div class="col-1">
                            <label for="CSA3"> Sí </label>
                            <input type="radio" name="CS2" id="CSA3" value="1" required>
                        </div>
                        <div class="col-1">
                            <label for="CSA4"> No </label>
                            <input type="radio" name="CS2" id="CSA4" value="0" required>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-9">
                            61.- Has fumado en el último mes
                        </div>
                        <div class="col-1">
                            <label for="CSA5"> Sí </label>
                            <input type="radio" name="CS3" id="CSA5" value="1" required>
                        </div>
                        <div class="col-1">
                            <label for="CSA6"> No </label>
                            <input type="radio" name="CS3" id="CSA6" value="0" required>
                        </div>
                        <input type="number" hidden value="0" id="CSA" name="CSA">
                    </div>
                    <hr>
                    <!--CSA-->
                    <div class="row">
                        <div class="col-9">
                            62.- Has bebido alcohol alguna vez en tu vida
                        </div>
                        <div class="col-1">
                            <label for="CST1"> Sí </label>
                            <input type="radio" name="CS4" id="CST1" value="1" required>
                        </div>
                        <div class="col-1">
                            <label for="CST2"> No </label>
                            <input type="radio" name="CS4" id="CST2" value="0" required>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-9">
                            63.- Has bebido alcohol el último año
                        </div>
                        <div class="col-1">
                            <label for="CST3"> Sí </label>
                            <input type="radio" name="CS5" id="CST3" value="1" required>
                        </div>
                        <div class="col-1">
                            <label for="CST4"> No </label>
                            <input type="radio" name="CS5" id="CST4" value="0" required>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-9">
                            64.- Has bebido alcohol el último mes
                        </div>
                        <div class="col-1">
                            <label for="CST5"> Sí </label>
                            <input type="radio" name="CS6" id="CST5" value="1" required>
                        </div>
                        <div class="col-1">
                            <label for="CST6"> No </label>
                            <input type="radio" name="CS6" id="CST6" value="0" required>
                        </div>
                        <input type="number" hidden value="0" id="CST" name="CST">
                    </div>
                    <hr>
                    <!--CST-->
                    <div class="row">
                        <div class="col-9">
                            65.- Has usado drogas alguna vez en tu vida
                        </div>
                        <div class="col-1">
                            <label for="CSO1"> Sí </label>
                            <input type="radio" name="CS7" id="CSO1" value="1" required>
                        </div>
                        <div class="col-1">
                            <label for="CSO2"> No </label>
                            <input type="radio" name="CS7" id="CSO2" value="0" required>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-9">
                            66.- Has usado drogas el último año
                        </div>
                        <div class="col-1">
                            <label for="CSO3"> Sí </label>
                            <input type="radio" name="CS8" id="CSO3" value="1" required>
                        </div>
                        <div class="col-1">
                            <label for="CSO4"> No </label>
                            <input type="radio" name="CS8" id="CSO4" value="0" required>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-9">
                            67.- Has usado drogas el último mes
                        </div>
                        <div class="col-1">
                            <label for="CSO5"> Sí </label>
                            <input type="radio" name="CS9" id="CSO5" value="1" required>
                        </div>
                        <div class="col-1">
                            <label for="CSO6"> No </label>
                            <input type="radio" name="CS9" id="CSO6" value="0" required>
                        </div>
                        <input type="number" hidden value="0" id="CSO" name="CSO">
                    </div>
                    <!--E-C-CS-->
                    <hr>
                    <!--C-PAP-->
                    <div class="row">
                        <div class="col-9">
                            68.- El uso de drogas se puede prevenir
                        </div>
                        <div class="col-1">
                            <label for="PAP1"> Sí </label>
                            <input type="radio" name="PAP1" id="PAP1" value="0" required>
                        </div>
                        <div class="col-1">
                            <label for="PAP2"> No </label>
                            <input type="radio" name="PAP1" id="PAP2" value="1" required>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-9">
                            69.- Las familias pueden prevenir el consumo de drogas
                        </div>
                        <div class="col-1">
                            <label for="PAP3"> Sí </label>
                            <input type="radio" name="PAP2" id="PAP3" value="0" required>
                        </div>
                        <div class="col-1">
                            <label for="PAP4"> No </label>
                            <input type="radio" name="PAP2" id="PAP4" value="1" required>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-9">
                            70.- Los papás deben informar a sus hijos sobre los riesgos y daños que causan las drogas
                        </div>
                        <div class="col-1">
                            <label for="PAP5"> Sí </label>
                            <input type="radio" name="PAP3" id="PAP5" value="0" required>
                        </div>
                        <div class="col-1">
                            <label for="PAP6"> No </label>
                            <input type="radio" name="PAP3" id="PAP6" value="1" required>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-9">
                            71.- Las escuelas pueden prevenir el consumo de drogas
                        </div>
                        <div class="col-1">
                            <label for="PAP7"> Sí </label>
                            <input type="radio" name="PAP4" id="PAP7" value="0" required>
                        </div>
                        <div class="col-1">
                            <label for="PAP8"> No </label>
                            <input type="radio" name="PAP4" id="PAP8" value="1" required>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-9">
                            72.- Las escuelas deben infromar sobre los riesgos y daños que causan las drogas
                        </div>
                        <div class="col-1">
                            <label for="PAP9"> Sí </label>
                            <input type="radio" name="PAP5" id="PAP9" value="0" required>
                        </div>
                        <div class="col-1">
                            <label for="PAP10"> No </label>
                            <input type="radio" name="PAP5" id="PAP10" value="1" required>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-9">
                            73.- Cuidarte es protegerte contra las drogas
                        </div>
                        <div class="col-1">
                            <label for="PAP11"> Sí </label>
                            <input type="radio" name="PAP6" id="PAP11" value="0" required>
                        </div>
                        <div class="col-1">
                            <label for="PAP12"> No </label>
                            <input type="radio" name="PAP6" id="PAP12" value="1" required>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-9">
                            74.- Debes protegerte contra las drogas
                        </div>
                        <div class="col-1">
                            <label for="PAP13"> Sí </label>
                            <input type="radio" name="PAP7" id="PAP13" value="0" required>
                        </div>
                        <div class="col-1">
                            <label for="PAP14"> No </label>
                            <input type="radio" name="PAP7" id="PAP14" value="1" required>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-9">
                            75.- Estás preparado para protegerte contra las drogas
                        </div>
                        <div class="col-1">
                            <label for="PAP15"> Sí </label>
                            <input type="radio" name="PAP8" id="PAP15" value="0" required>
                        </div>
                        <div class="col-1">
                            <label for="PAP16"> No </label>
                            <input type="radio" name="PAP8" id="PAP16" value="1" required>
                        </div>
                        <input type="number" hidden value="0" id="PAP" name="PAP">
                    </div>
                    <!--E-C-PAP-->
                    <hr>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-lg" style="background-color: #ed6f00; color:white">
                            Agregar registro
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</div>




@endsection