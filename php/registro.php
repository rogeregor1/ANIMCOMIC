<?php
 /*== incluyendo conexion a db ==*/
    require_once "php/main.php";

    /*== Almacenando datos en variables ==*/
    $nombre=limpiar_cadena($_POST['nombre']);
    $apellido=limpiar_cadena($_POST['apellido']);
    $usuario=limpiar_cadena($_POST['usuario']);
    $clave_1=limpiar_cadena($_POST['password1']);
    $clave_2=limpiar_cadena($_POST['password2']);
    $email=limpiar_cadena($_POST['correo2']);

    /*== Verificando campos obligatorios ==*/
    if($nombre=="" || $apellido=="" || $usuario=="" || $clave_1=="" || $clave_2=="" || $email==""){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No has llenado todos los campos que son obligatorios
            </div>
        ';
        exit();
    }

    /*== Verificando integridad de los datos ==*/
    if(verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}",$nombre)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El NOMBRE no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    if(verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}",$apellido)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El APELLIDO no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    if(verificar_datos("[a-zA-Z0-9$@.-]{4,200}",$usuario)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El USUARIO no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    if(verificar_datos("[a-zA-Z0-9$@._-]{7,255}",$clave_1) || verificar_datos("[a-zA-Z0-9$@._-]{7,255}",$clave_2)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                Las CLAVES no coinciden con el formato solicitado
            </div>
        ';
        exit();
    }

     if(verificar_datos("[a-zA-Z0-9$@.]{8,200}",$email)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El CORREO no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    /*== Verificando email ==*/
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                $pdo=conexion();
                $check_email=$pdo->query("SELECT usuario_email FROM usuario WHERE usuario_email='$email'");
                if($check_email->rowCount()>0){
                    echo '
                        <div class="notification is-danger is-light">
                            <strong>¡Ocurrio un error inesperado!</strong><br>
                            El correo electrónico ingresado ya se encuentra registrado, por favor elija otro
                        </div>
                    ';
                    exit();
                }
                $check_email=null;
            }else{
                echo '
                    <div class="notification is-danger is-light">
                        <strong>¡Ocurrio un error inesperado!</strong><br>
                        Ha ingresado un correo electrónico no valido
                    </div>
                ';
                exit();
            } 



    /*== Verificando usuario ==*/
    if($usuario!=""){
    $check=conexion();
    $check_usuario=$check->query("SELECT usuario_usuario FROM usuario WHERE usuario_usuario='$usuario'");
    if($check_usuario->rowCount()>0){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El USUARIO ingresado ya se encuentra registrado, por favor elija otro
            </div>
        ';
        exit();
        }
        $check_usuario=null;
        } else{
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                Ha ingresado un USUARIO no valido.
            </div>
        ';
        exit();
    }

    /*== Verificando claves ==*/
    if($clave_1!=$clave_2){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                Las CLAVES que ha ingresado no coinciden
            </div>
        ';
        exit();
    }else{
        $clave=password_hash($clave_1,PASSWORD_BCRYPT,["cost"=>10]);
    }


    /*== Guardando datos ==*/
    /*
    $pdo=conexion();
    $consulta = "INSERT INTO usuario VALUES (default, :nombre, :apellido, :usuario, :clave, :email)";
    $sql = $pdo->prepare($consulta);
    $sql->bindParam(':nombre', $nombre, PDO::PARAM_STR);
    $sql->bindParam(':apellido', $apellido, PDO::PARAM_STR);
    $sql->bindParam(':usuario', $usuario, PDO::PARAM_STR);
    $sql->bindParam(':clave', $clave, PDO::PARAM_STR);
    $sql->bindParam(':email', $email, PDO::PARAM_STR);
    $respuesta = $sql->execute(); 
    if ($respuesta === TRUE) {
        echo "Insertado correctmente";
        header('Location: index.php');
    }else{
        echo "error";
        exit();
    }

*/




    $guardar=conexion();
    $guardar_usuario=$guardar->prepare("INSERT INTO usuario(usuario_nombre, usuario_apellido, usuario_usuario, usuario_clave, usuario_email) VALUES(:nombre, :apellido, :usuario, :clave, :email)");

    $marcadores=[
        ":nombre"=>$nombre,
        ":apellido"=>$apellido,
        ":usuario"=>$usuario,
        ":clave"=>$clave,
        ":email"=>$email
    ];

    $guardar_usuario->execute($marcadores);
    
    if($guardar_usuario->rowCount()==1){
        echo '
            <div class="notification is-info is-light">
                <strong>¡USUARIO REGISTRADO!</strong><br>
                El usuario se registro con exito.
            </div>
            ';
            exit();
    }else {
        $guardar_usuario=null;
        header('Location: index.php');
    }
    ?>