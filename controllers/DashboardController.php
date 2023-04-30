<?php
namespace Controllers;

use Model\Proyecto;
use MVC\Router;


class DashboardController{
    public static function index (Router $router){
        session_start();
        isAuth();

        // Render a la vista
        $router->render('dashboard/index', [
            'titulo' => 'Proyectos'
            
        ]);
    }
    public static function crear_proyecto (Router $router){
        session_start();
        isAuth();
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $proyecto = new Proyecto($_POST);

            // Validacion de Alertas
            $alertas = $proyecto->validarProyeto();

            if(empty($alertas)){
                // Generar una URL Unica
                $proyecto->url = md5(uniqid());
                // Almacenar el creador del proyecto
                $proyecto->propietarioId = $_SESSION['id'];
                // Guardar el proyecto
                $proyecto->guardar();

                header('Location: /proyecto?id=' . $proyecto->url);
            }
        }

        // Render a la vista
        $router->render('dashboard/crear-proyecto', [
            'titulo' => 'Crear Proyecto',
            'alertas' => $alertas
            
        ]);
    }
    public static function perfil (Router $router){
        session_start();
        isAuth();

        // Render a la vista
        $router->render('dashboard/perfil', [
            'titulo' => 'Perfil'
            
        ]);
    }
}