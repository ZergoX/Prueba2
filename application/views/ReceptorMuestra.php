<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
   <?php require();?> 
    
    <div class="contariner-fluid">
     <div class="row center">
         <h1>Recepción de muestras</h1>
     </div>
     <form action="">
     <div class="row">
        <div class="col-md-6">
          <input type="number" class="form" name="codigo" id="" placeholder="Codigo Cliente">
          <input type="number" name="rut" id="" placeholder="Rut cliente">
          <input type="text" name="nombreCliente" id="" placeholder="nombre">
        </div>
        <div class="col-md-6">
          <label for="fecha">Fecha de recepción</label>
          <input type="date" name="fecha" id="" >
          <input type="number" name="cantMuestra" id="" placeholder="Cantidad de Muestras">
        </div>
     </div>
      <div class="row">
        
        <select name="" id="">
        <option>
        </select>

        <input type="button" class="btn btn-primary" value="agregar">

        
        <textarea name="" id="" cols="30" rows="10"></textarea>
        
        <input type="submit" class="btn btn-primary" value="guardar">
        <input type="button" class="btn btn-primary" value="salir">

      </div>
     </form>
    </div>

</body>
<?php require("Footer.php");?>
</html>