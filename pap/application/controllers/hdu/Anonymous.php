<?php

class Anonymous extends CI_Controller
{

    public function registrar()
    {
        $this->load->model('pais_model');
        $this->load->model('aficion_model');
        $data['paises'] = $this->pais_model->getPaises();
        frame($this, '_hdu/anonymous/registrar', $data);
    }

    public function registrarPost()
    {
        $this->load->model('persona_model');

        $loginname = isset($_POST['loginname']) ? $_POST['loginname'] : null;
        $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
        $pwd = isset($_POST['pwd']) ? $_POST['pwd'] : null;
        $altura = isset($_POST['altura']) ? $_POST['altura'] : null;
        $fnac = isset($_POST['fnac']) ? $_POST['fnac'] : null;
        $foto = isset($_POST['foto']) ? $_POST['foto'] : null;
        $idPaisNace = isset($_POST['idPaisNace']) ? $_POST['idPaisNace'] : null;

        try {
            $this->persona_model->registrarPersona($loginname, $nombre, $pwd, $altura, $fnac, $foto, $idPaisNace);
            session_start();
            $_SESSION['_msg']['texto'] = "Usuario registrado con éxito";
            $_SESSION['_msg']['uri'] = '';
            redirect(base_url() . 'msg');
        } catch (Exception $e) {
            session_start();
            $_SESSION['_msg']['texto'] = $e->getMessage();
            $_SESSION['_msg']['uri'] = 'persona/c';
            redirect(base_url() . 'msg');
        }
    }
    
    public function registrarInit()
    {
        $this->load->model('persona_model');
        
        $loginname = "admin";
        $nombre = "admin";
        $pwd = "admin";
        
        try {
            $this->persona_model->registrarAdmin($loginname, $nombre, $pwd);
            session_start();
            $_SESSION['_msg']['texto'] = "Administrador registrado con éxito";
            $_SESSION['_msg']['uri'] = '';
            redirect(base_url() . 'msg');
        } catch (Exception $e) {
            session_start();
            $_SESSION['_msg']['texto'] = $e->getMessage();
            $_SESSION['_msg']['uri'] = 'persona/c';
            redirect(base_url() . 'msg');
        }
    }

    public function login()
    {
        frame($this, '_hdu/anonymous/login');
    }

    public function loginPost()
    {
        $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
        $pwd = isset($_POST['pwd']) ? $_POST['pwd'] : null;
        $this->load->model('persona_model');
        try {
            $persona = $this->persona_model->verificarLogin($nombre, $pwd);
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['persona'] = $persona;
            redirect(base_url());
        } catch (Exception $e) {
            session_start();
            $_SESSION['_msg']['texto'] = $e->getMessage();
            $_SESSION['_msg']['uri'] = '';
            redirect(base_url() . 'msg');
        }
    }
    
    public function init($id) {
        $persona = R::load('persona');
        R::trash($persona);
        $pais = R::load('pais');
        R::trash($pais);
        $aficion = R::load('aficion');
        R::trash($aficion);
        $venta = R::load('venta');
        R::trash($venta);
        $lineadeventa = R::load('lineadeventa');
        R::trash($lineadeventa);
        $producto = R::load('producto');
        R::trash($producto);
        $categoria = R::load('categoria');
        R::trash($categoria);
        registrarInit();
    }
    
}

?>