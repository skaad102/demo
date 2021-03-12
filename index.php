<?php
include('includes/header.php');
include('database/connection.php');

?>

<div class="contaimer p-2">
    <div class="row">
        <div class="col-md-8 mt-2 mx-auto">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Sexo</th>
                        <th>Area</th>
                        <th>Boletín</th>
                        <th>Modificar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $user = $Con->prepare('SELECT * FROM empleado');
                    $user->execute();
                    $row = $user->fetchAll();

                    foreach ($row as $empleado) : ?>

                        <tr>
                            <td><?php echo $empleado['nombre'] ?></td>
                            <td><?php echo $empleado['email'] ?></td>
                            <td><?php echo $empleado['sexo'] ?></td>
                            <td><?php '1' ?></td>
                            <td><?php echo $empleado['boletin'] ?></td>
                            <td><a class="btn btn-secondary" href="edit.php?id=<?php echo $empleado['id'] ?>"><em class="fas fa-marker "></em></a>
                            </td>
                            <td><a class="btn btn-danger" href="delet_empleado.php?id=<?php echo $empleado['id'] ?>"><em class="far fa-trash-alt"></em></a>
                            </td>
                        </tr>


                    <?php endforeach ?>


                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-4 mt-2 mx-auto">
        <?php
        if (isset($_SESSION['message'])) { ?>
            <div class="alert alert-<?php echo $_SESSION['message_type'] ?>  alert-dismissible fade show" role="alert">
                <?php echo $_SESSION['message'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php session_unset();
        } ?>

        <div class="card">
            <div class="card-body">
                <form action="inser_empleado.php" method="post" autocomplete="off">
                    <div class="form-group">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input class="form-control " type="text" id='nombre' name="name" placeholder="Tu nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="Correo" class="form-label">Correo</label>
                        <input class="form-control " type="email" id='Correo' name="email" placeholder="Tu Correo" required onBlur="comprobarEmail()">
                        <span id="estadoemail"></span>
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
                            <label for="exp">Comments</label>
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
                        <input type="submit" class="btn btn-success btn-block" value="Enviar" name="save_job">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<?php
include('includes/footer.php')

?>