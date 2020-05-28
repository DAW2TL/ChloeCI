<?php

class Producto_model extends CI_Model
{
public function borrarProducto($id) {
    R::trash(R::load('producto',$id));
}

public function getProductos()
{
    return R::findAll('producto');
}

public function getProductoById($id)
{
    return R::load('producto', $id);
}

public function crearProducto($nombre, $stock, $precio, $foto)
{
    $producto = R::findOne('producto','nombre=?',[$nombre]);
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

public function actualizarProducto($id, $nombre, $stock, $precio, $foto)
{
    $producto = R::findOne('producto','nombre=?',[$nombre]);
    $ok = ($nombre!=null && $producto==null);
    if ($ok) {
        $producto = R::load('producto', $id);
        $producto->nombre = $nombre;
        $producto->stock = $stock;
        $producto->precio = $precio;
        $producto->foto = $foto;
        
        R::store($producto);
    } else {
        $e = ($nombre == null ? new Exception("nulo") : new Exception("duplicado"));
        throw $e;
    }
}
}
?>
