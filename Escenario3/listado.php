<?php
include 'funciones.php';

csrf();
if (isset($_POST['submit']) && !hash_equals($_SESSION['csrf'], $_POST['csrf'])) {
  die();
}

$error = false;
$config = include 'config.php';

try {
  $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
  $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);



  $consultaSQL = "SELECT * FROM listadomaterias";

  

  $sentencia = $conexion->prepare($consultaSQL);
  $sentencia->execute();

  $horarios = $sentencia->fetchAll();

} catch(PDOException $error) {
  $error= $error->getMessage();
} 


?>

<?php include "templates/header.php"; ?>


<?php
if ($error) {
  ?>
  <div class="container mt-2">
    <div class="row">
      <div class="col-md-12">
        <div class="alert alert-danger" role="alert">
          <?= $error ?>
        </div>
      </div>
    </div>
  </div>
  <?php
}
?>



<div class="container">
  <div class="row">
    <div class="col-md-12">
	<br/>
	<br/>
	<br/>
      <h2 class="mt-3">Pemsum academico </h2>
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Semestre</th>
			
            
          </tr>
        </thead>
        <tbody>
          <?php
          if ($horarios && $sentencia->rowCount() > 0) {
            foreach ($horarios as $fila) {
              ?>
              <tr>
                <td><?php echo escapar($fila["id"]); ?></td>
                <td><?php echo escapar($fila["nombre"]); ?></td>
               <td><?php echo escapar($fila["semestre"]); ?></td>
			   
			    
              </tr>
              <?php
            }
          }
          ?>
        <tbody>
      </table>
    </div>
  </div>
</div>


<?php include "templates/footer.php"; ?>