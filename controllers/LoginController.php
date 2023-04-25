<?php
namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class LoginController{
    public static function login (Router $router){
    

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

        }
        
        // Render a la vista
        $router->render('auth/login', [
            'titulo' => 'Iniciar Sesión'
        ]);
    }
    public static function logout (){
        echo 'desde logout';
    }
    public static function crear (Router $router){
        $alertas = [];
        $usuario = new Usuario;

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarCuentaNueva();

            if(empty($alertas)){
                $existeUsuario = Usuario::where('email', $usuario->email);

                if($existeUsuario){
                    Usuario::setAlerta('error', 'EL usuario ya está registrado');
                    $alertas = Usuario::getAlertas();
                }else{
                    // Hashear contraseña
                    $usuario->hashPassword();

                    // ELiminar la segunda contraseña
                    unset($usuario->password2);
                    
                    // Crear Token 
                    $usuario->crearToken();


                    // Enviar Email
                    $email = new Email($usuario->nombre, $usuario->email, $usuario->token);
                    $email->enviarConfirmacion();
                    
                    $resultado = $usuario->guardar();


                    if($resultado){
                        header('Location: /mensaje');
                    }

                    
                }
            }
        }
    
        $router->render('auth/crear', [
            'titulo' => 'Crear Sesión',
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }
    public static function olvide (Router $router){
        

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

        }
        $router->render('auth/olvide', [
            'titulo' => 'Cambiar Contraseña'
        ]);
    }
    public static function reestablecer (Router $router){
        

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

        }
        $router->render('auth/reestablecer', [
            'titulo' => 'Introduce Nueva Contraseña'
        ]);
    }
    public static function mensaje (Router $router){
        $router->render('auth/mensaje', [
            'titulo' => 'Mensaje Confirmación'
        ]);
    }
    public static function confirmar (Router $router){
        $token = s($_GET['token']);
        

        if(!$token) header('Location: /');

        // Encontrar al usuario con este token
        $usuario = Usuario::where('token', $token);

        if(empty($usuario)){
            // No se encontro el usuario en la base de datos
            Usuario::setAlerta('error', 'Token no valido');
        }else{
            // Confitmar la cuenta
            $usuario->confirmado = 1;
            $usuario->token = null;
            unset($usuario->password2);
            // Guardar en la Base de datos
            $usuario->guardar();
            Usuario::setAlerta('exito', 'Cuenta Comprobada Correctamente');

        }

        $alertas = Usuario::getAlertas();

        $router->render('auth/confirmar', [
            'titulo' => 'Confirma Tu Cuenta',
            'alertas' => $alertas
        ]);
    }

}
