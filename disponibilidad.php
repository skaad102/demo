<?php
    include 'database/connection.php';

    if(!empty($_POST["email"])) {

        $selCorreoUser = $Con->prepare('SELECT COUNT(*) FROM empleado WHERE email  =  ?');
        $selCorreoUser->execute(array($_POST["email"]));

        $row = $selCorreoUser->fetch();
        $Con = null;
        if($row['COUNT(*)']>0){
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Holy guacamole!</strong> You should check in on some of those fields below.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }else{
            echo '<div class="alert alert-success" role="alert">
            <strong>Correo Disponible!</strong>.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
        }

    }

