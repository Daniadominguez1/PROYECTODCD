<?php
include_once("../Servidor/conexion.php");

if (!empty($_POST)) {
    $alert = "";
    
    if (empty($_POST['categoria']) || empty($_POST['id'])) {
        $alert = '<div class="alert alert-danger" role="alert">Todos los campos son requeridos</div>';
    } else {
        $nombre = mysqli_real_escape_string($conexion, $_POST['categoria']);
        $idcat = intval($_POST['id']);
        $sql_update = mysqli_query($conexion, "UPDATE categorias SET categoria='$nombre' WHERE idcat='$idcat'");
        if ($sql_update) {
            header("Location: ../Cliente/categorias.php?update=success");
            exit();
        } else {
            // Mostrar error con más detalles
            $alert = '<div class="alert alert-danger" role="alert">Error al actualizar la categoría: ' . mysqli_error($conexion) . '</div>';
        }
    }
}

// Verificar si se pasa un ID en la URL
if (empty($_REQUEST['id'])) {
    header("Location: ../Cliente/categorias.php");
    exit();
}

$idcat = intval($_REQUEST['id']);

// Preparar y ejecutar la consulta para obtener la categoría
$stmt = $conexion->prepare("SELECT * FROM categorias WHERE idcat = ?");
$stmt->bind_param("i", $idcat);
$stmt->execute();
$result = $stmt->get_result();
$result_sql = $result->num_rows;

// Si no se encuentra la categoría, redirigir
if ($result_sql == 0) {
    header("Location: ../Cliente/categorias.php");
    exit();
} else {
    // Obtener los datos de la categoría
    $data = $result->fetch_assoc();
    $nombre = $data['categoria'];
}

?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6 m-auto">
            <form action="" method="post">
                <!-- Mostrar alerta si existe -->
                <?php echo isset($alert) ? $alert : ''; ?>
                
                <!-- Campo oculto para el ID -->
                <input type="hidden" name="id" value="<?php echo $idcat; ?>">
                
                <!-- Campo para el nombre de la categoría -->
                <div class="form-group">
                    <label for="categoria">Nombre</label>
                    <input type="text" placeholder="Ingrese nombre" class="form-control" name="categoria" id="categoria" value="<?php echo htmlspecialchars($nombre); ?>" required>
                </div>
                
                <!-- Botones -->
                <button type="button" class="btn btn-secondary" onclick="window.location.href='categorias.php'">Cancelar</button>
                <button type="submit" class="btn btn-outline-info"><i class="fas fa-user-edit"></i> Editar Categoría</button>
            </form>
        </div>
    </div>
</div>

<?php include_once "../Cliente/include/pie.php"; ?>
