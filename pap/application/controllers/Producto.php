<?php

class Producto extends CI_Controller
{
    
    public function c()
    {
        frame($this,'producto/c');
    }
    
    public function cPost()
    {
        $this->load->model('producto_model');
        $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
        try {
            $this->producto_model->crearProducto($nombre);
            redirect(base_url() . 'producto/r');
        }
        catch (Exception $e) {
            session_start();
            $_SESSION['_msg']['texto']=$e->getMessage();
            $_SESSION['_msg']['uri']='producto/c';
            redirect(base_url() . 'msg');
        }
    }
    
    public function r()
    {
        $this->load->model('producto_model');
        $datos['productos'] = $this->producto_model->getProductos();
        frame($this,'producto/r', $datos);
    }
    
    public function u() {
        $id = isset($_GET['id'])?$_GET['id']:null;
        
        $this->load->model('producto_model');
        //         $this->load->model('aficion_model');
        
        $data['productos'] = $this->producto_model->getProductoById($id);
        //         $data['aficiones'] = $this->aficion_model->getAficiones();
        
        frame($this,'producto/u',$data);
        
    }
    
    public function uPost() {
        $this->load->model('producto_model');
        
        $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
        
        try {
            $this->producto_model->actualizarProducto($nombre);
            redirect(base_url() . 'producto/r');
        }
        catch (Exception $e) {
            session_start();
            $_SESSION['_msg']['texto']=$e->getMessage();
            $_SESSION['_msg']['uri']='producto/c';
            redirect(base_url() . 'msg');
        }
    }
    
    public function dPost() {
        $id = isset($_POST['id']) ? $_POST['id'] : null;
        $this->load->model('producto_model');
        $this->producto_model->borrarProducto($id);
        redirect(base_url().'producto/r');
    }
    
}
?>