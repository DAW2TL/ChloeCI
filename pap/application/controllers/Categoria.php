<?php

class Categoria extends CI_Controller
{
    
    public function c()
    {
        frame($this,'categoria/c');
    }
    
    public function cPost()
    {
        $this->load->model('categoria_model');
        $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
        try {
            $this->categoria_model->crearCategoria($nombre);
            redirect(base_url() . 'categoria/r');
        }
        catch (Exception $e) {
            session_start();
            $_SESSION['_msg']['texto']=$e->getMessage();
            $_SESSION['_msg']['uri']='categoria/c';
            redirect(base_url() . 'msg');
        }
    }
    
    public function r()
    {
        $this->load->model('categoria_model');
        $datos['categorias'] = $this->categoria_model->getCategorias();
        frame($this,'categoria/r', $datos);
    }
    
    public function u() {
        $id = isset($_GET['id'])?$_GET['id']:null;
        
        $this->load->model('categoria_model');
        //         $this->load->model('aficion_model');
        
        $data['categorias'] = $this->categoria_model->getCategoriaById($id);
        //         $data['aficiones'] = $this->aficion_model->getAficiones();
        
        frame($this,'categoria/u',$data);
        
    }
    
    public function uPost() {
        $this->load->model('categoria_model');
        
        $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
        
        try {
            $this->categoria_model->actualizarCategoria($nombre);
            redirect(base_url() . 'categoria/r');
        }
        catch (Exception $e) {
            session_start();
            $_SESSION['_msg']['texto']=$e->getMessage();
            $_SESSION['_msg']['uri']='categoria/c';
            redirect(base_url() . 'msg');
        }
    }
    
    public function dPost() {
        $id = isset($_POST['id']) ? $_POST['id'] : null;
        $this->load->model('categoria_model');
        $this->categoria_model->borrarCategoria($id);
        redirect(base_url().'categoria/r');
    }
    
}
?>