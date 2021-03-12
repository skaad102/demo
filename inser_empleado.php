<?php
include('database/connection.php');
include('includes/alerta.php');


if (isset($_POST['save_job'])) {
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
    $role = htmlentities($_POST['role']);



    $inserUser = $Con->prepare('INSERT INTO empleado VALUES (DEFAULT, :nombre, :email, :sexo, :fk_area_id , :boletin, :descripcion)');
    $inserUser->bindparam(':nombre', $name);
    $inserUser->bindparam(':email', $email);
    $inserUser->bindparam(':sexo', $sexo);
    $inserUser->bindparam(':fk_area_id', $area);
    $inserUser->bindparam(':boletin', $boletin);
    $inserUser->bindparam(':descripcion', $coments);



    if ($inserUser->execute()) {

        $idUser = $Con->lastInsertId();

        echo $idUser;
        echo $role;

        $inserEmplRol = $Con->prepare('INSERT INTO empleado_rol values (:id, :rol)');
        $inserEmplRol->bindparam(':id', $idUser);

        $inserEmplRol->bindparam(':rol', $role);;

        if ($inserEmplRol->execute()) {

            // echo alerta('Registro Exitoso', 'index.php');
            $_SESSION['message'] = 'empleado guardado';
            $_SESSION['message_type'] = 'success';

            header('Location: index.php');
        }
    } else {
        echo 'erro';
    }
}
