<?php 
namespace Model;

class Usuario extends ActiveRecord{
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'nombre', 'email', 'password', 'token', 'confirmado'];

    public $id;
    public $nombre;
    public $email;
    public $password;
    public $password2;
    public $password_actual;
    public $password_nuevo;
    public $token;
    public $confirmado;
    
    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->password2 = $args['password2'] ?? '';
        $this->password_actual = $args['password_actual'] ?? '';
        $this->password_nuevo = $args['password_nuevo'] ?? '';
        $this->token = $args['token'] ?? '';
        $this->confirmado = $args['confirmado'] ?? 0;
    }

    // Valida un email
    public function validarLogin(){
        if(!$this->email){
            self::$alertas['error'][] = 'El Email es Obligatorio';
        }
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            self::$alertas['error'][] = 'Email no valida';
        }
        if(!$this->password){
            self::$alertas['error'][] = 'La Contraseña es Obligatoria';
        }
        return self::$alertas;
    }
    public function validarCuentaNueva(){
        if(!$this->nombre){
            self::$alertas['error'][] = 'El Nombre del Usuario es Obligatorio';
        }
        if(!$this->email){
            self::$alertas['error'][] = 'El Email del Usuario es Obligatorio';
        }
        if(!$this->password){
            self::$alertas['error'][] = 'La Contraseña es Obligatoria';
        }
        if(strlen($this->password) < 6){
            self::$alertas['error'][] = 'La Contraseña debe contener al menos 6 caracteres';
        }
        if($this->password !== $this->password2){
            self::$alertas['error'][] = 'Las Contraseñas son Diferentes';
        }
        return self::$alertas;
    }

    // Valida un email
    public function validarEmail(){
        if(!$this->email){
            self::$alertas['error'][] = 'El Email es Obligatorio';
        }
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            self::$alertas['error'][] = 'Email no valida';
        }
        return self::$alertas;
    }
    // Valida un Contraseña
    public function validarContraseña(){
        if(!$this->password){
            self::$alertas['error'][] = 'La Contraseña es Obligatoria';
        }
        if(strlen($this->password) < 6){
            self::$alertas['error'][] = 'La Contraseña debe contener al menos 6 caracteres';
        }
        return self::$alertas;
    }

    public function validar_perfil (){
        if(!$this->nombre){
            self::$alertas['error'][] = 'El Nombre es Obligatorio';
        }
        if(!$this->email){
            self::$alertas['error'][] = 'El Email es Obligatorio';
        }
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            self::$alertas['error'][] = 'Formato de Email No Válido';
        }
        return self::$alertas;
    }
    public function nuevo_password() : array{
        if(!$this->password_actual){
            self::$alertas['error'][] = 'La Contraseña Actual no puede ir vacio';
        }
        if(strlen($this->password_nuevo) < 6){
            self::$alertas['error'][] = 'La Contraseña Nueva debe contener al menos 6 caracteres';
        }
        return self::$alertas;
    }
    // Comprobar la contraseña
    public function comprobar_password() : bool{
        return password_verify($this->password_actual, $this->password);
    }

    public function hashPassword() : void{
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }
    public function crearToken() : void{
        $this->token = md5( uniqid() );
    }
}