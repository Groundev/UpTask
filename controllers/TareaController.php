<?php
namespace Controllers;

use Model\Proyecto;

class TareaController{
    public static function index(){
        
    }
    public static function crear(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            session_start();

            $proyecto = Proyecto::where('url', $_POST['proyectoId']);

            if(!$proyecto || $proyecto->propietarioId !== $_SESSION['id']){
                $respuesta = [
                    'tipo' => 'error',
                    'mensaje' => 'Error al Agregar la tarea'
                ];
                echo json_encode($respuesta);
            }else{
                $respuesta = [
                    'tipo' => 'exito',
                    'mensaje' => 'Tarea Agregada Correctamente'
                ];
                echo json_encode($respuesta);
            }
        }
        
    }
    public static function actualizar(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            
        }
        
    }
    public static function eliminar(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            
        }
        
    }
}