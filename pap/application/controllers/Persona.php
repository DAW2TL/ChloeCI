<?php

class Persona extends CI_Controller
{

    public function u() {
        $id = isset($_GET['id'])?$_GET['id']:null;
        
        $this->load->model('persona_model');
        $this->load->model('pais_model');
        $this->load->model('aficion_model');
        
        $data['persona'] = $this->persona_model->getPersonaById($id);
        $data['paises'] = $this->pais_model->getPaises();
        $data['aficiones'] = $this->aficion_model->getAficiones();
        
        frame($this,'persona/u',$data);
        
    }
    
    public function uPost() {
        $this->load->model('persona_model');
        
        $id = isset($_POST['id']) ? $_POST['id'] : null;
        $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
        $idPaisNace = isset($_POST['idPaisNace']) ? $_POST['idPaisNace'] : null;
        $idPaisReside = isset($_POST['idPaisReside']) ? $_POST['idPaisReside'] : null;
        $idsAficionGusta = isset($_POST['idsAficionGusta'])?$_POST['idsAficionGusta']:[];
        $idsAficionOdia = isset($_POST['idsAficionOdia'])?$_POST['idsAficionOdia']:[];
        
        try {
            $this->persona_model->actualizarPersona($id, $nombre,$idPaisNace,$idPaisReside,$idsAficionGusta,$idsAficionOdia);
            redirect(base_url() . 'persona/r');
        }
        catch (Exception $e) {
            session_start();
            $_SESSION['_msg']['texto']=$e->getMessage();
            $_SESSION['_msg']['uri']='persona/c';
            redirect(base_url() . 'msg');
        }
    }
    
    public function c()
    {
        $this->load->model('pais_model');
        $this->load->model('aficion_model');
        $data['paises'] = $this->pais_model->getPaises();
        frame($this,'Persona/c',$data);
    }

    public function cPost() {
        if (!isRolOK('admin')) {
            PRG("rol incorrecto","/ruta/boton");
        }
        $this->load->model('persona_model');

        $loginname = isset($_POST['loginname']) ? $_POST['loginname'] : null;
        $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
        $pwd = isset($_POST['pwd']) ? $_POST['pwd'] : null;
        $altura = isset($_POST['altura']) ? $_POST['altura'] : null;
        $idFnac = isset($_POST['idFnac']) ? $_POST['idFnac'] : null;
        $foto = isset($_POST['idFoto']) ? $_POST['idFoto'] : null;
        $idPaisNace = isset($_POST['idPaisNace']) ? $_POST['idPaisNace'] : null; 
//         $idPersona = isset($_POST['id']) ? $_POST['id'] : null; 
        if ($idPaisNace=='----') {$idPaisNace=='NULL';}
//         $idPaisReside = isset($_POST['idPaisReside']) ? $_POST['idPaisReside'] : null;
//         $idsAficionGusta = isset($_POST['idsAficionGusta'])?$_POST['idsAficionGusta']:[];
//         $idsAficionOdia = isset($_POST['idsAficionOdia'])?$_POST['idsAficionOdia']:[];
        try {
            $id = $this->persona_model->registrarPersona($loginname,$nombre,$pwd,$altura,$idFnac, $foto, $idPaisNace);
            
            if ($foto != null && $foto['tmp_name']!=null) {
                $extension = explode('.', $foto['name'])[1];
                $carpeta = "/assets/img/upload/";
                if (!copy($foto['tmp_name'], $carpeta . "persona-$id." . $extension)) {
                    throw new Exception('Error al copiar la foto '. $foto['name']. ' a '.$carpeta."persona-$id".$extension);
                }
            }
            
            PRG('Usuario creado correctamente.', 'login', 'success');
        }   catch (Exception $e) {
            PRG($e->getMessage(),  'persona/c');
        }

   
        
        try {
            $this->persona_model->registrarPersona($loginname, $nombre, $pwd, $altura, $idFnac, $foto, $idPaisNace);
            redirect(base_url() . 'persona/r');
        }
        catch (Exception $e) {
            session_start();
            $_SESSION['_msg']['texto']=$e->getMessage();
            $_SESSION['_msg']['uri']='persona/c';
            redirect(base_url() . 'msg');
        }
    }
    
    public function dPost() {
        $id = isset($_POST['id']) ? $_POST['id'] : null;
        $this->load->model('persona_model');
        $this->persona_model->borrarPersona($id);
        redirect(base_url().'persona/r');
    }

    public function r()
    {
        $this->load->model('persona_model');
        $datos['personas'] = $this->persona_model->getPersonas();
        frame($this,'persona/r', $datos);
    }
}
?>