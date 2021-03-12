<?php
include('database/connection.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $selUser = $Con->prepare('SELECT * FROM empleado WHERE id = ?');
    $selUser->execute(array($id));

    $row = $selUser->fetch();

    $email = $row['email'];
}

if (isset($_POST['update'])) {
    $id = $_GET['id'];
    $name = htmlentities($_POST['name']);
    $email = htmlentities($_POST['email']);
    $sexo = htmlentities($_POST['sexo']);
    $area = htmlentities($_POST['area']);
    $coments = $_POST['coments'];
    if (isset($_POST['boletin'])) {
        $boletin = 1;
    } else {
        $boletin = 0;
    }

    $fk_area_id = 1;

    echo $name;
    echo $email;
    echo $sexo;
    echo $area; 
    echo $coments;


    $ActualizarEmpleado = $Con->prepare('UPDATE empleado SET nombre = :nombre, email = :email ,sexo = :sexo, fk_area_id = :fk_area_id , boletin = :boletin, descripcion =:descripcion WHERE id =:id');

    $ActualizarEmpleado->bindparam(':nombre', $name);
    $ActualizarEmpleado->bindparam(':email', $email);
    $ActualizarEmpleado->bindparam(':sexo', $sexo);
    $ActualizarEmpleado->bindparam(':fk_area_id', $fk_area_id);
    $ActualizarEmpleado->bindparam(':boletin', $boletin);
    $ActualizarEmpleado->bindparam(':descripcion', $coments);
    $ActualizarEmpleado->bindparam(':id', $id);

    if ($ActualizarEmpleado->execute()) {
        $_SESSION['message'] = 'Empleado Actualizadp';
        $_SESSION['message_type'] = 'warning';

        header('Location: index.php');
    }
}


?>

<?php include('includes/header.php');
?>

<div class="container">
    <div class="row">
        <div class="col-md-4 mx-auto mt-2">
            <div class="card">
                <div class="card-tittel">
                    <h2>Editar</h2>
                </div>
                <div class="card-body">
                    <form action="edit.php?id=<?php echo $id ?>" method="post">
                        <div class="form-group">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input class="form-control"  type="text" id='nombre' name="name" placeholder="Tu nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="Correo" class="form-label">Correo</label>
                            <input class="form-control" type="email" id='Correo' name="email" placeholder="Tu Correo" >
                        </div>
                        <div class="form-group">
                            <label> Sexo</label>
                            <div class="form-check">
                                <label for="Sexo" class="form-label">Masculino</label>
                                <input type="radio" class="form-check-input" id="Masculino" name="sexo" value="M" required>
                            </div>
                            <div class="form-check">
                                <label for="Sexo" class="form-label">Femenino</label>
                                <input type="radio" class="form-check-input" id="Masculino" name="sexo" value="F" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="selectArea">Area</label>
                            <select id="selectArea" class="form-select" required aria-label="select example" name='area'>
                                <option value="">Abre el menú</option>
                                <option value="1">Administración</option>
                                <option value="2">Ventas</option>
                                <option value="3">Produccion</option>
                                <option value="4">Calidad</option>
                            </select>
                        </div>

                        <div class="form-group mt-2 mb-2">
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Cuentanos tu Experiencia" name="coments" id="exp" style="height: 100px"></textarea>
                                <label for="exp">Comentario</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name='boletin' id="boletin">
                                <label class="form-check-label" for="boletin">Deseo recibir Boletin informatico</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="">Area</label>
                            <div class="form-check">
                                <label for="Pd" class="form-label">Profecional de Proyecto-Desarrollador</label>
                                <input type="radio" class="form-check-input" id="Pd" name="role" value="1">
                            </div>
                            <div class="form-check">
                                <label for="" class="form-label">Gerente Estrategico</label>
                                <input type="radio" class="form-check-input" id="Pd" name="role" value="2">
                            </div>
                            <div class="form-check">
                                <label for="" class="form-label">Auxiliar administrativo</label>
                                <input type="radio" class="form-check-input" id="Pd" name="role" value="3">
                            </div>
                        </div>
                        <div class="form-group mt-2">
                            <button class="btn btn-success btn-block" name="update">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<?php include('includes/footer.php') ?>