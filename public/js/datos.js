if(datos.length != 0){
  /* CREACIÓN DE UNA LISTA LIMPIA CON LOS DATOS ENVIADOS DE LA BASE DE DATOS*/
var newDatos = [];
for (let i=0;i<(Object.keys(datos).length);i++) {
  newDatos.push(datos[i])
}
/*RECONOCER EL VALOR MÁS GRANDE IVG PARA ORGANIZAR LA LISTA*/
var ivg = parseInt(newDatos[0]['IVG'])
var newDatosDos = [];
for (let i=0;i<newDatos.length;i++) {
  if(ivg < parseInt(newDatos[i]['IVG'])){
    ivg = parseInt(newDatos[i]['IVG']);
    newDatosDos.unshift(newDatos[i]);
  }else{
    newDatosDos.push(newDatos[i]);
  }
}

/* CONOCER LA CATEGORÍA CON MÁS PUNTOS DEL PRIMER ELMENTO */
function knowCate(datos) {
  var cates = [
    {
      'Salud mental':parseInt(datos['SM']), 
      'Sistema familiar':parseInt(datos['SF']), 
      'Presión de pares':parseInt(datos['PP']), 
      'Disp. Sustancias y expc. Sobre el consumo':parseInt(datos['DSEC']),
      'Persepción de riesgo':parseInt(datos['PR']),
      'Desemepño escolar':parseInt(datos['DE']),
      'Violencia':parseInt(datos['VI']),
      'Riesgo de inicio o incremento del consumo':parseInt(datos['RIIC']),
      'Consumo de sustancias':parseInt(datos['CS']),
      'Participación en acciones preventivas':parseInt(datos['PAP'])
    }
  ];
  var catesNom = Object.keys(cates[0]);
  var catesVal = Object.values(cates[0]);
  var cateM = [];

  var catesValEvalue = catesVal[0];

  for (let x = 1; x < catesNom.length; x++) {
    
    if(catesValEvalue < catesVal[x]){
      catesValEvalue = catesVal[x];
      cateM = [catesNom[x], catesVal[x]]
    }

  }
  if(cateM[0] == null && cateM[1] == null){
    cateM = [catesNom[0], catesVal[0]]
  }
  document.getElementById('mr').innerHTML = cateM[0] + ': ' + cateM[1];
}

knowCate(newDatosDos[0])

/* FUNCIONES PARA GENERAR LAS TABLAS DE ACUERDO A CÓMO SEAN LLAMADOS LOS RESULTADOS */

function genGraficas(datos) {

  /* GRAFICA DE DATOS GENERALES */
  var tit
  if(datos['Nombre'] && datos['Sexo']){
    tit = "Nombre del alumno: " + datos['Nombre'];
  }else{
    tit = "Grado y grupo: " + datos['grado'] + "°" + datos['grupo'];
  }

  google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ["Categoría", "Puntos", { role: "style" } ],
        ["Salud mental", parseInt(datos['SM']), "#2e68cb;"],
        ["Sistema familiar", parseInt(datos['SF']), "#3e6e94"],
        ["Presion de pares", parseInt(datos['PP']), "#fc9b00"],
        ["Disponibiliad de sustancias", parseInt(datos['DSEC']), "#129c15"],
        ["Persepción de riesgo", parseInt(datos['PR']), "#9f03a2"],
        ["Desemepño escolar", parseInt(datos['DE']), "#0099c5"],
        ["Violencia", parseInt(datos['VI']), "#d9497a"],
        ["Riesgo de inicio o incremento de consumo", parseInt(datos['RIIC']), "#66a901"],
        ["Consumo de sustancias", parseInt(datos['CS']), "#b82e2c"],
        ["Participación en acciones preventivas", parseInt(datos['PAP']), "#3e6e94"],
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);
      var options = {
        title: tit,
        width: 600,
        height: 300,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
      chart.draw(view, options);
    }

    /* GENERACIÓN DE GRAFICAS PARA OTRAS DROGAS */
    // PRIMERO SE GENERA UNA GRAFICA CON LA PRESEPCIÓN DE RIESGO
    
    google.charts.setOnLoadCallback(drawChartPR);
    function drawChartPR() {
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Topping');
      data.addColumn('number', 'Slices');
      data.addRows([
        ["Tabaco", parseInt(datos['PRA'])],
        ["Alcohol", parseInt(datos['PRT'])],
        ["Otras drogas", parseInt(datos['PRO'])],
      ]);
   
      var options = {'title': "Persepción de riesgo",
                     'width':300,
                     'height':300};
   
      var chart2 = new google.visualization.PieChart(document.getElementById('chart_div_PR'));
      chart2.draw(data, options);
    }

    // SEGUNDO SE GENERA OTRA GRAFICA CON EL CONSUMO DE SUSTNACIAS

    google.charts.setOnLoadCallback(drawChartCS);
    function drawChartCS() {
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Topping');
      data.addColumn('number', 'Slices');
      data.addRows([
        ["Tabaco", parseInt(datos['CST'])],
        ["Alcohol", parseInt(datos['CSA'])],
        ["Otras drogas", parseInt(datos['CSO'])],
      ]);
   
      var options = {'title': "Consumo de sustancias",
                     'width':300,
                     'height':300};
   
      var chart3 = new google.visualization.PieChart(document.getElementById('chart_div_CS'));
      chart3.draw(data, options);
    }

}


/* COLOCAR LOS RESPECTIVOS CAMPOS DE LA TABLA PARA MOSTRAR LOS RESULTADOS */

// EL PRIMER CASO HACE REFERENCIA A UNA TABLA PERSONALIZADA CON GRUPOS Y ALUMNOS
// MIENTRAS QUÉ EL SEGUNDO CASO HACE REFERENCÍA A UNA BUSQUEDA POR INSTITUCIÓN

if(newDatosDos[0]['Nombre'] && newDatosDos[0]['Sexo']){

    genGraficas(newDatosDos[0])

    document.getElementById('titulosCA').innerHTML += '\
      <th>Nombre</th> \
      <th>Salud mental</th> \
      <th>Sistema familiar</th> \
      <th>Presión de pares</th> \
      <th>Disponibiliad de sustancias y espectativas sobre el consumo</th> \
      <th>Persepción de riesgo</th> \
      <th>Desempeño escolar</th> \
      <th>Violencia</th> \
      <th>Riesgo de inicio o incremento de consumo</th> \
      <th>Consumo de sustancias</th> \
      <th>Participación en acciones preventivas</th> \
      <th>Escuela</th>\
      <th>Grado</th> \
      <th>Grupo</th> \
      <th>Sexo</th> \
      <th>Edad</th> \
     ';

    for (let x = 0; x < newDatosDos.length; x++) {
      document.getElementById('resultadoCA').innerHTML += ' \
        <tr>\
        <td>'+newDatosDos[x]['Nombre']+'</td> \
        <td>'+newDatosDos[x]['SM']+'</td> \
        <td>'+newDatosDos[x]['SF']+'</td> \
        <td>'+newDatosDos[x]['PP']+'</td> \
        <td>'+newDatosDos[x]['DSEC']+'</td> \
        <td>'+newDatosDos[x]['PR']+'</td> \
        <td>'+newDatosDos[x]['DE']+'</td> \
        <td>'+newDatosDos[x]['VI']+'</td> \
        <td>'+newDatosDos[x]['RIIC']+'</td> \
        <td>'+newDatosDos[x]['CS']+'</td> \
        <td>'+newDatosDos[x]['PAP']+'</td> \
        <td>'+newDatosDos[x]['nomEscuela']+'</td> \
        <td>'+newDatosDos[x]['grado']+'</td> \
        <td>'+newDatosDos[x]['grupo']+'</td> \
        <td>'+newDatosDos[x]['Sexo']+'<td>\
        <td>'+newDatosDos[x]['edad']+'<td>\
        <tr>'
    }

}else{

  genGraficas(newDatosDos[0])

  document.getElementById('titulosCA').innerHTML += '\
      <th>Grado</th> \
      <th>Grupo</th> \
      <th>Salud mental</th> \
      <th>Sistema familiar</th> \
      <th>Presión de pares</th> \
      <th>Disponibiliad de sustancias y espectativas sobre el consumo</th> \
      <th>Persepción de riesgo</th> \
      <th>Desempeño escolar</th> \
      <th>Violencia</th> \
      <th>Riesgo de inicio o incremento de consumo</th> \
      <th>Consumo de sustancias</th> \
      <th>Participación en acciones preventivas</th> \
      <th>Escuela</th>';

  for (let x = 0; x < newDatosDos.length; x++) {
      document.getElementById('resultadoCA').innerHTML += ' \
        <tr>\
        <td>'+newDatosDos[x]['grado']+'</td> \
        <td>'+newDatosDos[x]['grupo']+'</td> \
        <td>'+newDatosDos[x]['SM']+'</td> \
        <td>'+newDatosDos[x]['SF']+'</td> \
        <td>'+newDatosDos[x]['PP']+'</td> \
        <td>'+newDatosDos[x]['DSEC']+'</td> \
        <td>'+newDatosDos[x]['PR']+'</td> \
        <td>'+newDatosDos[x]['DE']+'</td> \
        <td>'+newDatosDos[x]['VI']+'</td> \
        <td>'+newDatosDos[x]['RIIC']+'</td> \
        <td>'+newDatosDos[x]['CS']+'</td> \
        <td>'+newDatosDos[x]['PAP']+'</td> \
        <td>'+newDatosDos[x]['nomEscuela']+'</td> \
        <tr>'
    }
  }
}else{
  document.getElementById('todo').innerHTML = '<div style="text-align: center"><h3>Todavía no hay datos que mostrar</h3></div>'
}