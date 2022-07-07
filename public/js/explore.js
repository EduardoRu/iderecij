/*
  FUNCIÓN PARA GENERA LAS GRAFICAS QUE SERÁN 6 GRAFICAS EN TOTAL EN FROMA DE PASTEL A PARTIR DE LOS DATOS
  QUÉ MÁS TUVIERON UN IVG
*/

function asigValue(d1,d2,d3) {
    document.getElementById('GIN').value = d3;
    document.getElementById('GGR').value = d2;
    document.getElementById('GAL').value = d1;

    console.log(document.getElementById('GIN').value)
}

function genGraficaDatos(datos, x, tit) {
  google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Topping');
      data.addColumn('number', 'Slices');
      data.addRows([
        ["Salud mental", parseInt(datos[x]['SM'])],
        ["Sistema familiar", parseInt(datos[x]['SF'])],
        ["Presion de pares", parseInt(datos[x]['PP'])],
        ["Disponibiliad de sustancias", parseInt(datos[x]['DSEC'])],
        ["Persepción de riesgo", parseInt(datos[x]['PR'])],
        ["Desemepño escolar", parseInt(datos[x]['DE'])],
        ["Violencia", parseInt(datos[x]['VI'])],
        ["Riesgo de inicio o incremento de consumo", parseInt(datos[x]['RIIC'])],
        ["Consumo de sustancias", parseInt(datos[x]['CS'])],
        ["Participación en acciones preventivas", parseInt(datos[x]['PAP'])],
      ]);
      var options = {'title':tit,
                      'width':350,
                      'height':250};
      var chart = new google.visualization.PieChart(document.getElementById('cart_'+x));
      chart.draw(data, options);
    }
}

function genGrafica(datos) {
  var tit;

 for (let x = 0; x < datos.length; x++) {

  if (datos[x]['idClaveAlumno'] && datos[x]['idEncuesta'] && datos[x]['idgrupo']) {
    tit = "Alumno: " + datos[x]['nomAlumno'];
    document.getElementById('fb').innerHTML += ' \
    <div class="col-md-4"> \
      <div> \
        <div id="cart_'+x+'"></div> \
      </div> \
      <div class="d-grid gap-2"><button type="submit" onclick="asigValue('+datos[x]['idClaveAlumno']+','+datos[x]['idgrupo']+','+datos[x]['idEncuesta']+')" class="btn" style="background-color: #ed6f00; color:white"> INFORMAICÓN </button></div>\
    </div>';
  }else if(datos[x]['idEncuesta'] && datos[x]['idgrupo']){
    tit = "Grupo: " + datos[x]['grado'] + "°" + datos[x]['grupo'];
    document.getElementById('fb').innerHTML += ' \
    <div class="col-md-4"> \
    <form action="{{route("consultas.showGeneral")}}" method="GET">\
      <div> \
        <div id="cart_'+x+'"></div> \
      </div> \
      <div class="d-grid gap-2"><button type="submit" onclick="asigValue('+null+','+datos[x]['idgrupo']+','+datos[x]['idEncuesta']+')" class="btn" style="background-color: #ed6f00; color:white"> INFORMAICÓN </button></div>\
    </form> \
    </div>';
  }else if(datos[x]['idEncuesta']){
    tit = "Escuela: " + datos[x]['nomEscuela'];
    document.getElementById('fb').innerHTML += ' \
    <div class="col-md-4"> \
    <form action="{{route("consultas.showGeneral")}}" method="GET">\
      <div> \
        <div id="cart_'+x+'"></div> \
      </div> \
      <div class="d-grid gap-2"><button type="submit" onclick="asigValue('+null+','+null+','+datos[x]['idEncuesta']+')" class="btn" style="background-color: #ed6f00; color:white"> INFORMAICÓN </button></div>\
    </form> \
    </div>';
  }
  genGraficaDatos(datos,x,tit);
 }
}

/*
  VALIDACIÓN DE FORMULARIO  
*/

function valValues() {
  var INE = document.getElementById('INES');
  var value = INE.options[INE.selectedIndex].value;
  
  if(value=='---'){
    alert('Favor de seleccionar al menos una institución');
    return false
  }
  
}

/*
  SELECCIONAR UN METODO DE BUSQUEDA 
*/

function verINE(){
  if(document.getElementById('INE').checked==true){
    document.getElementById('GRE').checked=false;
    document.getElementById('ALE').checked=false;
    document.getElementById('fb').innerHTML = '';
    genGrafica(GIN)
  }else{
    document.getElementById('fb').innerHTML = '';
  }
}

function verGRE(){
  if(document.getElementById('GRE').checked==true){
    document.getElementById('INE').checked=false;
    document.getElementById('ALE').checked=false;
    document.getElementById('fb').innerHTML = '';
    genGrafica(GGR)
  }else{
    document.getElementById('fb').innerHTML = '';
  }
}

function verALE(){
  if(document.getElementById('ALE').checked==true){
    document.getElementById('INE').checked=false;
    document.getElementById('GRE').checked=false;
    document.getElementById('fb').innerHTML = '';
    genGrafica(GAL)
  }else{
    document.getElementById('fb').innerHTML = '';
  }
}

/*
  OBTENER ALGÚN RESULTADO INE/GRE/ALE
*/

function getINES(){
  var INE = document.getElementById('INES');
  var GRE = document.getElementById('GRES');

  var value = INE.options[INE.selectedIndex].value;
  
  document.getElementById('GRES').innerHTML = '<option> --- </option>';
  document.getElementById('ALES').innerHTML = '<option> --- </option>';

  grupos.forEach(element => {
    if(value == element['idencuesta']){
      if((GRE.length)>=1){
        document.getElementById('GRES').innerHTML += '\
        <option value="'+element['idgrupos']+'">'+element['grado']+'-'+element['grupo']+'</option>'
      }
    }
  });
}

function getGRES(){
  var GRE = document.getElementById('GRES');
  var value = GRE.options[GRE.selectedIndex].value;

  document.getElementById('ALES').innerHTML = '<option> --- </option>';

  claveAlumnos.forEach(element => {
    if(value == element['idgrupo']){
      if(element['nombre_alumno'] != null && element['sexo'] != null){
        document.getElementById('ALES').innerHTML += '\
        <option value="'+element['idclave_alumno']+'">'+element['nombre_alumno']+'</option>';
      }
    }
  })
}