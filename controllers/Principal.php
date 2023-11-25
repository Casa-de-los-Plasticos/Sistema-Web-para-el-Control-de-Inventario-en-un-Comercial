<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';
class Principal extends Controller
{
    public function __construct()
    {
        parent::__construct();
        session_start();
    }
    public function index()
    {
        $data['title'] = 'Iniciar Sesion';
        $this->views->getView('principal', 'login', $data);
    }
    //validar formulario de login
    public function validar()
    {
        if (isset($_POST['correo']) && isset($_POST['clave'])) {
            if (empty($_POST['correo'])) {
                $res = array('msg' => 'EL CORREO ES REQUERIDO', 'type' => 'warning');
            }else if(empty($_POST['clave'])){
                $res = array('msg' => 'LA CONTRASEÑA ES REQUERIDO', 'type' => 'warning');
            }else{
                $correo = strClean($_POST['correo']);
                $clave = strClean($_POST['clave']);
                $data = $this->model->getDatos($correo);
                if (empty($data)) {
                    $res = array('msg' => 'EL CORREO NO EXISTE', 'type' => 'warning');
                }else{
                    if ($data['estado'] == 1) {
                        if (password_verify($clave, $data['clave'])) {
                        $_SESSION['id_usuario'] = $data['id'];
                        $_SESSION['nombre_usuario'] = $data['nombre'];
                        $_SESSION['correo_usuario'] = $data['correo'];
                        $_SESSION['perfil_usuario'] = $data['perfil'];
                        $_SESSION['rol'] = $data['rol'];
                        $_SESSION['rol'] = $data['rol'];
                        $evento = 'Inicio de Sesión';
                        $ip = $_SERVER['REMOTE_ADDR'];
                        $detalle = $_SERVER['HTTP_USER_AGENT'];
                        $acceso = $this->model->registrarAcceso($evento, $ip, $detalle);
                        if ($acceso > 0) {
                            $res = array('msg' => 'DATOS CORRECTOS...', 'type' => 'success');
                        } else {
                            $res = array('msg' => 'ERROR AL CAPTURAR LOS DATOS DEL INICIO...', 'type' => 'error');
                        }                        
                        
                    }else{
                        $res = array('msg' => 'CONTRASEÑA INCORRECTA...', 'type' => 'warning');
                    }
                    } else {
                        $res = array('msg' => 'USUARIO INACTIVO...', 'type' => 'warning');
                    }
                    
                }
            }            
        }else {
            $res = array('msg' => 'ERROR DESCONOCIDO...', 'type' => 'error');
        }
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function forgot()
    {
        $data['title'] = 'Olvidaste tu Contraseña';
        $this->views->getView('usuarios', 'forgot', $data);
    }

    public function reset($token)
    {
        $data['title'] = 'Restablecer Contraseña';
        $data['seguridad'] = $this->model->verificarToken($token);
        if ($data['seguridad']['token'] != $token || empty($token) || $data['seguridad']['token'] == null) {
            header('Location: ' . BASE_URL);
            exit;
        }
        $this->views->getView('usuarios', 'reset', $data);
    }

    public function enviarCorreo($correo)
    {
        $verificar = $this->model->verificarCorreo($correo);
        if (!empty($verificar)) {
            $mail = new PHPMailer(true);
            $fecha = date('YmdHis');
            $token = md5($fecha);
            try {
                //Server settings
                //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                $mail->SMTPDebug = 0;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = HOST_SMTP;                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = USER_SMTP;                     //SMTP username
                $mail->Password   = CLAVE_SMTP;                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port       = PUERTO_SMTP;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom('espinozamirandajose1@gmail.com', 'José Smit');
                $mail->addAddress($correo);

                //Content
                $mail->isHTML(true);
                $mail->CharSet = 'UTF-8';                                  //Set email format to HTML
                $mail->Subject = 'Restablecer Contraseña - ' . TITLE;
                $mail->Body    = 'Has pedido restablecer tu contraseña, si no has sido omite este mensaje <br />
            Para cambiar <a href="'.BASE_URL.'principal/reset/'.$token.'">CLICK AQUI</a>';

                $mail->send();

                $verificarToken = $this->model->registrarToken($token, $correo);
                if ($verificarToken == 1) {
                    $res = array('msg' => 'CORREO ENVIADO CON UN TOKEN DE SEGURIDAD...', 'type' => 'success');
                } else {
                    $res = array('msg' => 'ERROR AL REGISTRAR EL TOKEN...', 'type' => 'error');
                }
                
            } catch (Exception $e) {
                $res = array('msg' => 'ERROR AL ENVIAR EL CORREO: ' . $mail->ErrorInfo, 'type' => 'error');
            }
        }else{
            $res = array('msg' => 'EL CORREO NO ESTÁ REGISTRADO...', 'type' => 'warning');
        }
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function cambiarClave()
    {
        $json = file_get_contents('php://input');
        $datos = json_decode($json, true);
        $nueva = strClean($datos['nueva']);
        $confirmar = strClean($datos['confirmar']);
        $token = strClean($datos['token']);
        if (empty($nueva) || empty($confirmar)) {
            $res = array('msg' => 'TODO LOS CAMPOS CON * SON OBLIGATORIOS...', 'type' => 'warning');
        }else{
            if ($nueva != $confirmar) {
                $res = array('msg' => 'LAS CONTRASEÑAS NO COINCIDEN...', 'type' => 'warning');
            } else {
                $hash = password_hash($nueva, PASSWORD_DEFAULT);
                $data = $this->model->modificarClave($hash, $token);
                if ($data == 1) {
                    $res = array('msg' => 'CONTRASEÑA MODIFICADA...', 'type' => 'success');
                } else {
                    $res = array('msg' => 'ERROR AL MODIFICAR...', 'type' => 'error');
                }
                
            }
            
        }

        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function errors()
    {
        if (empty($_SESSION['id_usuario'])) {
            header('Location: ' . BASE_URL);
            exit;
        }
        $data['title'] = 'Página no Encontrada';
        $this->views->getView('admin', 'error', $data);
    }
}
