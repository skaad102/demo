<?php
include('database/connection.php');

if(isset($_GET['id'])){
    $id = $_GET['id'];

    $delUser = $Con->prepare('DELETE FROM empleado WHERE id = :id');
    $delUser->bindparam(':id', $id);


    if($delUser->execute()){
        $_SESSION['message'] = 'Empleado Eliminado';
        $_SESSION['message_type'] = 'danger';
    
        header('Location: index.php');
    }



}

?>