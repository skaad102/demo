<?php
include('database/connection.php');

if(isset($_GET['id'])){
    $id = $_GET['id'];


    $delUserRol = $Con->prepare('DELETE FROM empleado_rol WHERE empleado_id = :id');
    $delUserRol->bindparam(':id', $id);


    $delUser = $Con->prepare('DELETE FROM empleado WHERE id = :id');
    $delUser->bindparam(':id', $id);


    if($delUserRol->execute() && $delUser->execute()){
        $_SESSION['message'] = 'Empleado Eliminado';
        $_SESSION['message_type'] = 'danger';
    
        header('Location: index.php');
    }

}

?>