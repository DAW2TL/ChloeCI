<?php

class Producto_model extends CI_Model
{
    public function borrarProducto($id) {
        R::trash(R::load('Producto',$id));
    }
    
    public function getProductos()
    {
        return R::findAll('Producto');
    }
    
    public function crearProducto($nombre, $stock, $precio, $foto)
    {
        $producto = R::findOne('Producto','nombre=?',[$nombre]);
        $ok = ($producto==null && $nombre!=null);
        if ($ok) {
            $producto = R::dispense('producto');
            $producto->nombre = $nombre;
            $producto->stock = $stock;
            $producto->precio = $precio;
            $producto->foto = $foto;
            R::store($producto);
        }
        else {
            $e = ($nombre==null?new Exception("nulo"):new Exception("duplicado"));
            throw $e;
        }
    }
}
?>
