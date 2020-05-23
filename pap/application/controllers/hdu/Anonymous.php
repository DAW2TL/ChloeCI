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
    
    public function init() {
        
        if (isRolOK('admin')) {
            R::nuke();
            $data['msg'] = "BD Recreada";            
            frame($this, '_hdu/anonymous/init', $data);
            
            $this->registrarInit();
        }
        else {
            $data['msg'] = "No eres el usuario administrador";
            frame($this, '_hdu/anonymous/login', $data);
        }
        

        
//         $idper=isset($_POST['idper'])?$_POST['idper']:null;
//         $this->load->model('persona_model');
//         $this->persona_model->borrarPersona($idper);      
//         $idpai=isset($_POST['idpai'])?$_POST['idpai']:null;
//         $pais = R::load('pais',$idpai);
//         R::trash($pais);
//         $idafi=isset($_POST['idafi'])?$_POST['idafi']:null;
//         $aficion = R::load('aficion',$idafi);
//         R::trash($aficion);
//         $idven=isset($_POST['idven'])?$_POST['idven']:null;
//         $venta = R::load('venta',$idven);
//         R::trash($venta);
//         $idldv=isset($_POST['idldv'])?$_POST['idldv']:null;
//         $lineadeventa = R::load('lineadeventa',$idldv);
//         R::trash($lineadeventa);
//         $idpro=isset($_POST['idpro'])?$_POST['idpro']:null;
//         $producto = R::load('producto',$idpro);
//         R::trash($producto);
//         $idcat=isset($_POST['idcat'])?$_POST['idcat']:null;
//         $categoria = R::load('categoria',$idcat);
//         R::trash($categoria);
//    $this->registrarInit();
//         redirect(base_url()."aceite/r"); 
    } 
}

?>