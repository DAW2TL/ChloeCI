<?php

class LineaDeVenta_model extends CI_Model
{
    public function borrarLineaDeVenta($id) {
        R::trash(R::load('LineaDeVenta',$id));
    }
    
    public function getLineasDeVenta()
    {
        return R::findAll('LineaDeVenta');
    }
    
    public function crearLineaDeVenta($cantidad)
    {
        $ldv = R::findOne('LineaDeVenta','cantidad=?',[$cantidad]);
        $ok = ($ldv==null && $cantidad!=null);
        if ($ok) {
            $ldv = R::dispense('venta');
            $ldv->cantidad = $cantidad;
            R::store($ldv);
        }
        else {
            $e = ($cantidad==null?new Exception("nulo"):new Exception("duplicado"));
            throw $e;
        }
    }
}
?>
