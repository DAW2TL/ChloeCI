<?php

class Categoria_model extends CI_Model
{
    public function borrarCategoria($id) {
        R::trash(R::load('Categoria',$id));
    }
    
    public function getCategorias()
    {
        return R::findAll('Categoria');
    }
    
    public function crearCategoria($nombre)
    {
        $categoria = R::findOne('Categoria','nombre=?',[$nombre]);
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
}
?>
