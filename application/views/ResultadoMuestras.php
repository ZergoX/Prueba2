<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?= base_url() ?>assets/chartjs/Chart.min.js">    

    <title>Resultado Muestras</title>
</head>
<body class="body"> 
<?php
    $this->load->model('PARTICULAR_MODEL');

    if(count($this->PARTICULAR_MODEL->GetRut($this->session->rut))!=0){
     require('HeaderUsers.php');
    }else{

      require('HeaderUsersEmpresa.php');
    }
  ?>
    

  <div class="container-fluid"> 
    <canvas id="resultados" width="600" heigth="400"></canvas>
  </div>
    
</body>

<script>
    var densityCanvas = document.getElementById("resultados");

    Chart.defaults.global.defaultFontFamily = "Lato";
    Chart.defaults.global.defaultFontSize = 18;

    var densityData = {
    label: 'Density of Planets (kg/m3)',
    data: [5427, 5243, 5514, 3933, 1326, 687, 1271, 1638]
    };

    var barChart = new Chart(densityCanvas, {
    type: 'bar',
    data: {
    labels: ["Microtoxina"],
    datasets: [densityData]
  }
});
</script>
</html>