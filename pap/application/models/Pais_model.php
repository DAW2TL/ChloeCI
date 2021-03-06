<?php

class Pais_model extends CI_Model
{
    public function borrarPais($id) {
        R::trash(R::load('pais',$id));
    }

    public function getPaises()
    {
        return R::findAll('pais','order by nombre asc');
    }
    
    public function getPaisById($id)
    {
        return R::load('pais', $id);
    }

    public function crearPais($nombre)
    {
        $pais = R::findOne('pais','nombre=?',[$nombre]);
        $ok = ($pais==null && $nombre!=null);
        if ($ok) {
            $pais = R::dispense('pais');
            $pais->nombre = $nombre;
            $pais->alias('nace')->xownPersonaList = [];
            R::store($pais);
        }
        else {
           $e = ($nombre==null?new Exception("nulo"):new Exception("duplicado"));
           throw $e;
        }
    }
    
    public function actualizarPais($id, $nombre)
    {
        $ok = ($nombre!=null);
        if ($ok) {
            $pais = R::load('pais', $id);
            $pais->nombre = $nombre;
            
            R::store($pais);
        } else {
            $e = ($nombre == null ? new Exception("nulo") : new Exception("duplicado"));
            throw $e;
        }
    }
}
?>
