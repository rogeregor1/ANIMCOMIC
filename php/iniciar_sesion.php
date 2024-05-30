<?php
/*== incluyendo conexion a db ==*/
    require_once "main.php";
    
	/*== Almacenando datos en variables==*/
    $email=limpiar_cadena($_POST['correo']);
    $clave=limpiar_cadena($_POST['password']);

    /*== Verificando campos obligatorios ==*/
    if($email=="" || $clave==""){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No has llenado todos los campos que son obligatorios
            </div>
        ';
        exit();
    }


    /*== Verificando integridad de los datos ==*/
    if(verificar_datos("[a-zA-Z0-9$@.]{8,200}",$email)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El USUARIO no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    
    if(verificar_datos("[a-zA-Z0-9$@._-]{8,255}",$clave)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                Las CLAVE no coinciden con el formato solicitado
            </div>
        ';
        exit();
    }


    
    $pdo = conexion();
    $query=$pdo->query("SELECT * FROM usuario WHERE usuario_email='$email'");
    if($query->rowCount()==1){

    	$check_user=$query->fetch();
    
    	if($check_user['usuario_email']==$email && password_verify($clave, $check_user['usuario_clave'])){

            
            $_SESSION['id']=$check_user['usuario_id'];
    		$_SESSION['nombre']=$check_user['usuario_nombre'];
    		$_SESSION['apellido']=$check_user['usuario_apellido'];
            $_SESSION['rol']=$check_user['rol_id'];
            
            switch($_SESSION['rol']){
                case 1:
                    if(headers_sent()){
                        echo "<script> window.location.href='index.php?vista=home'; </script>";
                    }else{
                        header("Location: index.php?vista=home");
                    }
                break;
    
                case 2:
                    if(headers_sent()){
                        echo "<script> window.location.href='index.php?vista=colaborador'; </script>";
                    }else{
                        header("Location: index.php?vista=colaborador");
                    }
                break;

                case 3:
                    if(headers_sent()){
                        echo "<script> window.location.href='index.php?vista=cliente'; </script>";
                    }else{
                        header("Location: index.php?vista=cliente");
                    }
                break;

            }

    	}else{
    		echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Ocurrio un error inesperado!</strong><br>
	                Usuario o clave incorrectos
	            </div>
	        ';
            exit();
    	}
    }else{
    	echo '
            <div class="notification is-danger is-light">
                <strong>¡Usuario no existente!</strong><br>
                Por favor, registrese
            </div>
        ';
        exit();
    }
