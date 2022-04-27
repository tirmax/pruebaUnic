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


    if (isset($_POST['nombre'])) {
  $consultaSQL = "SELECT * FROM materia WHERE nombre LIKE '%" . $_POST['nombre'] . "%'";
} else {
  $consultaSQL = "SELECT * FROM materia";
}
  

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
      <a href="crear.php"  class="btn btn-primary mt-4">Crear materia</a>
	   <a href="listado.php"  class="btn btn-primary mt-4">Materias Del Programa </a>
      <hr>
	  
	   <form method="post" class="form-inline">
        <div class="form-group mr-3">
          <input type="text" id="nombre" name="nombre" placeholder="Buscar por materia" class="form-control">
        </div>
        <input name="csrf" type="hidden" value="<?php echo escapar($_SESSION['csrf']); ?>">
        <button type="submit" name="submit" class="btn btn-primary">Ver resultados</button>
      </form>
    </div>
  </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h2 class="mt-3">Lista de Materias</h2>
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Creditos</th>
			<th>Acciones</th>
            
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
               <td><?php echo escapar($fila["creditos"]); ?></td>
			   
			    <td>
                  <a href="<?= 'borrar.php?id=' . escapar($fila["id"]) ?>">🗑️Borrar</a>
                  <a href="<?= 'editar.php?id=' . escapar($fila["id"]) ?>">✏️Editar</a>
                </td>
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


