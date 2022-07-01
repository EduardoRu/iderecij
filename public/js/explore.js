/*
  FUNCIÓN PARA GENERA LAS GRAFICAS QUE SERÁN 6 GRAFICAS EN TOTAL EN FROMA DE PASTEL A PARTIR DE LOS DATOS
  QUÉ MÁS TUVIERON UN IVG
*/

function genGrafica(datos) {

 google.charts.load('current', {'packages':['corechart']});
 google.charts.setOnLoadCallback(drawChart);
 function drawChart() {

   var data = new google.visualization.DataTable();
   data.addColumn('string', 'Topping');
   data.addColumn('number', 'Slices');
   data.addRows([
     ['Mushrooms', 3],
     ['Onions', 1],
     ['Olives', 1],
     ['Zucchini', 1],
     ['Pepperoni', 2]
   ]);

   var options = {'title':'How Much Pizza I Ate Last Night',
                  'width':400,
                  'height':300};

   var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
   chart.draw(data, options);
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
    console.log('Instituciones');
    document.getElementById('GRE').checked=false;
    document.getElementById('ALE').checked=false;

    document.getElementById('fby').innerHTML = "";
    document.getElementById('fby').innerHTML = "<h1>Filtrado por Instituciones</h1>"
  }else{
    document.getElementById('fby').innerHTML = "";
    console.log('No Instituciones')
  }
}

function verGRE(){
  if(document.getElementById('GRE').checked==true){
    console.log('Grupos');
    document.getElementById('INE').checked=false;
    document.getElementById('ALE').checked=false;

    document.getElementById('fby').innerHTML = "";
    document.getElementById('fby').innerHTML = "<h1>Filtrado por Grupos</h1>"

  }else{
    document.getElementById('fby').innerHTML = "";
    console.log('No Grupos')
  }
}

function verALE(){
  if(document.getElementById('ALE').checked==true){
    console.log('Alumnos');
    document.getElementById('INE').checked=false;
    document.getElementById('GRE').checked=false;

    document.getElementById('fby').innerHTML = "";
    document.getElementById('fby').innerHTML = "<h1>Filtrado por Alumnos</h1>"
  }else{
    document.getElementById('fby').innerHTML = "";
    console.log('No Alumnos')
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