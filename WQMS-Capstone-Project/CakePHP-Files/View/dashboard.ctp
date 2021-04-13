<!DOCTYPE html>
<html>
<head>
	<title>Water Quality Monitoring System</title>

      <!--Library files installed for the webpage to Load-->

      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" type="text/css" href="app/webroot/css/basic.css">
      <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js"></script>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

      <!-- Chart JS library files for graphical data visualization-->
      <script src="app/webroot/js/Chart.min.js"></script>
      <script src="app/webroot/js/Utils.js"></script>

</head>
<style type="text/css">

#container-fluid {
    width: 100%;
    height: 100%;
    margin: 0;
    padding: 0;
}

</style>

<body>
<h2>Dashboard</h2>

<!--Container created to show the tabular data-->
<div class="container-fluid">
  <div class="row" style="height:600px">
    <p> <a href="login">Logout</a>
    <div class="col-sm-3 col-md-5" style="background-color:lavender;">
      <h3>Data<h3>
        <!--Dropdown options for Temperature, pH and Turbidity Selection-->
        <label for="measurement">Select:</label>
          <select name="measurement" id="measurement">
            <option >Options..</option>
            <option value="temp">Temperature</option>
            <option value="posH">pH</option>
            <option value="turb">Turbidity</option>
          </select>
          <button type="button" id="measureButton">Measure</button>
          <!--End of Dropdown options for Temperature, pH and Turbidity Selection-->
          <!--Table Data for Temperature values to be displayed-->
          <table border='1' id="tempTable">
            <thead>
              <tr>
                  <th>ID</th>
                  <th>Celcius</th>
                  <th>Fahrenheit</th>
                  <th>Time</th>
              </tr>
            </thead>
            <tbody id="tempData">
            </tbody>
          </table>
          <!--End of Table Data for Temperature values to be displayed-->

          <!--Table Data for Turbidity values to be displayed-->
          <table border='1' id="turbTable">
            <thead>
              <tr>
                  <th>ID</th>
                  <th>Value</th>
                  <th>Time</th>
              </tr>
            </thead>
            <tbody id="turbData">
            </tbody>
          </table>
          <!--End of Table Data for Turbidity values to be displayed-->

          <!--Table Data for pH values to be displayed-->
          <table border='1' id="phTable">
            <thead>
              <tr>
                  <th>ID</th>
                  <th>Value</th>
                  <th>Time</th>
              </tr>
            </thead>
            <tbody id="phData">
            </tbody>
          </table>
          <!--End of Table Data for pH values to be displayed-->
    </div>
    <!--Graphical chart visualization container-->
    <div class="col-sm-9 col-md-7" style="background-color:white;">This section is allocated for graphical representation
    <div style="width:90%;">
      <canvas id="tempChart"></canvas>
      <canvas id="turbChart"></canvas>
      <canvas id="phChart"></canvas>
    </div>
    <br>
    <br>
    </div>    
  </div>
</div>

</div>

<script>

/*Global Variables declared for value storage*/
var dropValue;
var ajaxValue;
var toggle = "True";
var totalLength, ret, graphTime=0, graphtempValue=0, graphturbValue=0,graphphValue=0;
var date, dateString;
var data, chart, ret;

/*Tables initially hidden, only after the dropdown selection the values are tabulated*/
$('#tempTable').hide();
$('#turbTable').hide();
$('#phTable').hide();

$('#tempChart').hide();
$('#turbChart').hide();
$('#phChart').hide();

/*Dropdown selection and button click to activate the flag values*/
$("#measurement").change(function () {
   dropValue = $(this).val();
  if (dropValue == "temp"){
    //updateTable();
    $('#tempTable').show();
    $('#turbTable').hide();
    $('#phTable').hide();

    $('#tempChart').show();
    $('#turbChart').hide();
    $('#phChart').hide();

    console.log("Selected temperature");
  }else if(dropValue == "posH"){
    //updateTable();
    $('#tempChart').hide();
    $('#turbChart').hide();
    $('#phChart').show();

    $('#tempTable').hide();
    $('#turbTable').hide();
    $('#phTable').show();
    console.log("Selected pH");
  }else if(dropValue == "turb"){
    //updateTable();

    $('#tempChart').hide();
    $('#turbChart').show();
    $('#phChart').hide();

    $('#tempTable').hide();
    $('#turbTable').show();
    $('#phTable').hide();
    console.log("Selected turbidity");
  }
});

/*Measure button cliked to post the dropdown selction to the database*/
$(document).ready(function(){
  $("#measureButton").click(function(){
    measure_flag(dropValue);
    console.log("Button Clicked");
    toggle = "True";
    setInterval(function(){ updateTable(); }, 3000);
  });
});

/*AJAX function created to post the dropdown value to the database*/
function measure_flag(value){
  ajaxValue = value;
  console.log("parameter:"+ajaxValue);
  $.ajax({  
      type: 'POST',
      url: 'users/measure',
      cache: false,
      data: {
       'dataValue': ajaxValue     
     },
     dataType: 'json',
     success: function(data) {
      console.log(data.updateFlag);
      updateTable();
     },      
     error: function (textStatus, errorThrown ) {
      //console.log(textStatus);
     }
  });
}

/*AJAX response function to update the table data after successfull sensor value update*/
function updateTable(){

  $.ajax({
      url: 'users/updatetable',
      type: 'POST',
      data: {
       'dataValue': ajaxValue
      },
      success: function (response) {
        ret = JSON.parse(response);
        console.log(ret.insertDetails);
        console.log(ret.tableDetails);
        console.log(ret.flagDetails);

        if(ret.insertDetails == "Temperature Values Inserted"){
          if(toggle == "True"){
            for (var i = 0; i < ret.tableDetails.length; i++) {

              graphtempValue = ret.tableDetails[i]['temperatures'].Celcius;
              dateString = ret.tableDetails[i]['temperatures'].Time.toString();
              var tr = $('<tr/>');
              tr.append("<td>" + ret.tableDetails[i]['temperatures'].id + "</td>");
              tr.append("<td>" + ret.tableDetails[i]['temperatures'].Celcius + "</td>");
              tr.append("<td>" + ret.tableDetails[i]['temperatures'].Fahrenheit + "</td>");
              tr.append("<td>" + ret.tableDetails[i]['temperatures'].Time + "</td>");
              $('#tempData').append(tr);
              
              updatetempChart();
              toggle = "False";
              console.log("GraphValue:"+graphtempValue);
            }
          }
        }else if(ret.insertDetails == "Turbidity Value Inserted"){
          if(toggle == "True"){
            for (var i = 0; i < ret.tableDetails.length; i++) {
              graphturbValue = ret.tableDetails[i]['turbidities'].Value;
              dateString = ret.tableDetails[i]['turbidities'].Time.toString();
              var tr = $('<tr/>');
              tr.append("<td>" + ret.tableDetails[i]['turbidities'].id + "</td>");
              tr.append("<td>" + ret.tableDetails[i]['turbidities'].Value + "</td>");
              tr.append("<td>" + ret.tableDetails[i]['turbidities'].Time + "</td>");
              $('#turbData').append(tr);
              toggle = "False";
              updateturbChart();
            }
          }
        }else if(ret.insertDetails == "PH Value Inserted"){
          if(toggle == "True"){
            for (var i = 0; i < ret.tableDetails.length; i++) {
              graphphValue = ret.tableDetails[i]['qualities'].Value;
              dateString = ret.tableDetails[i]['qualities'].Time.toString();
              var tr = $('<tr/>');
              tr.append("<td>" + ret.tableDetails[i]['qualities'].id + "</td>");
              tr.append("<td>" + ret.tableDetails[i]['qualities'].Value + "</td>");
              tr.append("<td>" + ret.tableDetails[i]['qualities'].Time + "</td>");
              $('#phData').append(tr);
              toggle = "False";
              console.log("phvalue:"+ret.tableDetails[i]['qualities'].id);
              updatepHChart();
            }
          }
        }
      }    
  });
}

</script>

<!--
*************************************************************************
*Title:             Chart JS Source Code
*Author:            Unknown/Open Source License
*Date Accessed:     March 13, 2021
*Code Version:      2.x
*Availability:      https://www.chartjs.org/docs/latest/charts/line.html
*************************************************************************
-->

<script>

/*Javascript functions to plot the temperature graph from the tabulated values*/
var tempctx = document.getElementById('tempChart').getContext('2d');
var tempchart = new Chart(tempctx, {
    // The type of chart we want to create
    type: 'line',

    // The data for our dataset
    data: {
        labels: dateString,
        datasets: [{
            label: 'Temperature Data',
            //backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 0, 0)',
            data: graphtempValue
        }]
    },

    // Configuration options go here
    options: {}
});
    
//function to update the chart with the latest measured values
function updatetempChart(){
    tempchart.data.datasets[0].data.push(graphtempValue);
    tempchart.data.labels.push(dateString);
    console.log(dateString);
    tempchart.update();

};
</script>

<!--
*************************************************************************
*Title:             Chart JS Source Code
*Author:            Unknown/Open Source License
*Date Accessed:     March 13, 2021
*Code Version:      2.x
*Availability:      https://www.chartjs.org/docs/latest/charts/line.html
*************************************************************************
-->

<script>
/*Javascript functions to plot the turbidity graph from the tabulated values*/
var turbctx = document.getElementById('turbChart').getContext('2d');
var turbchart = new Chart(turbctx, {
    // The type of chart we want to create
    type: 'line',

    // The data for our dataset
    data: {
        labels: dateString,
        datasets: [{
            label: 'Turbidity Data',
            //backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(0, 255, 0)',
            data: graphturbValue
        }]
    },

    // Configuration options go here
    options: {}
});

//function to update the chart with the latest measured values
function updateturbChart(){
  
    turbchart.data.datasets[0].data.push(graphturbValue);
    turbchart.data.labels.push(dateString);
    console.log(dateString);
    turbchart.update();

};


</script>

<!--
*************************************************************************
*Title:             Chart JS Source Code
*Author:            Unknown/Open Source License
*Date Accessed:     March 13, 2021
*Code Version:      2.x
*Availability:      https://www.chartjs.org/docs/latest/charts/line.html
*************************************************************************
-->

<script>
/*Javascript functions to plot the pH graph from the tabulated values*/
var phctx = document.getElementById('phChart').getContext('2d');
var phchart = new Chart(phctx, {
    // The type of chart we want to create
    type: 'line',

    // The data for our dataset
    data: {
        labels: dateString,
        datasets: [{
            label: 'pH Data',
            //backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(0, 0, 255)',
            data: graphphValue
        }]
    },

    // Configuration options go here
    options: {}
});

//function to update the chart with the latest measured values
function updatepHChart(){
  
    phchart.data.datasets[0].data.push(graphphValue);
    phchart.data.labels.push(dateString);
    console.log(dateString);
    phchart.update();

};


</script>


</body>
</html>