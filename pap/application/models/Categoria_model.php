<?php

class Categoria_model extends CI_Model
{
    public function borrarCategoria($id) {
        R::trash(R::load('categoria',$id));
    }
    
    public function getCategorias()
    {
        return R::findAll('categoria');
    }
    
    public function getCategoriaById($id)
    {
        return R::load('categoria', $id);
    }
    
    public function crearCategoria($nombre)
    {
        $categoria = R::findOne('categoria','nombre=?',[$nombre]);
        $ok = ($categoria==null && $nombre!=null);
        if ($ok) {
            $categoria = R::dispense('categoria');
            $categoria->nombre = $nombre;
            R::store($categoria);
        }
        else {
            $e = ($nombre==null?new Exception("nulo"):new Exception("duplicado"));
            throw $e;
        }
    }
    
    public function actualizarCategoria($id, $nombre)
    {
        $categoria = R::findOne('categoria','nombre=?',[$nombre]);
        $ok = ($nombre!=null && $categoria==null);
        if ($ok) {
            $categoria = R::load('categoria', $id);
            $categoria->nombre = $nombre;

            R::store($categoria);
        } else {
            $e = ($nombre == null ? new Exception("nulo") : new Exception("duplicado"));
            throw $e;
        }
    }
}
?>


