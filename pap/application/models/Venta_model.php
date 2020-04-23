<?php

class Venta_model extends CI_Model
{
    public function borrarVenta($id) {
        R::trash(R::load('venta',$id));
    }
    
    public function getVentas()
    {
        return R::findAll('Venta');
    }
    
    public function crearVenta($fecha)
    {
        $venta = R::findOne('Venta','fecha=?',[$fecha]);
        $ok = ($venta==null && $fecha!=null);
        if ($ok) {
            $venta = R::dispense('venta');
            $venta->fecha = $fecha;
            $venta->alias('ventaencurso')->xownPersonaList = [];
            R::store($venta);
        }
        else {
            $e = ($fecha==null?new Exception("nulo"):new Exception("duplicado"));
            throw $e;
        }
    }
}
?>
