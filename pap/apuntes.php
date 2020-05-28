

<?php if:?>
<?php else:?>
<?php endif:?>
<?=$header['persona']!=null?>
<?=$header['persona']->nombre?>

(admin) crud categoría [ categoria/c, categoria/r, categoria/u, categoria/d ]
CRUD típico para el bean categoría.
Accesible a través de un botón titulado “Categoría” visible sólo desde el home page de “admin”.
Asegurarse de que ninguna de estas HdU se puedan ejecutar desde un rol distinto a admin (ni siquiera escribiendo “a mano” las URI)
No permitir nombres de categoría duplicados (tanto en el caso “c” como en el caso “u”)
El caso “r” mostrará todas las categorías mostrando su nombre, la cantidad de productos registrados de esa categoría, y los típicos botones de acción para editar o borrar el país. 
La lista aparecerá ordenada en orden alfabético ascendente (por nombre de categoría)
El botón para “d” sólo aparecerá si el número de productos registrados es cero. 
Asegurarse de que no se puede borrar ninguna categoría cuyo número de usuarios sea distinto a cero, ni siquiera con aplicaciones como CURL.

(admin) crud producto [ producto/c, producto/r, producto/u, producto/d ]
CRUD típico para el bean producto.
Accesible a través de un botón titulado “Producto” visible sólo desde el home page de “admin”.
Asegurarse de que ninguna de estas HdU se puedan ejecutar desde un rol distinto a admin (ni siquiera escribiendo “a mano” las URI)
Mostrar un warning en el caso de que se intentara introducir un nombre de producto duplicado (tanto en el caso “c” como en el caso “u”). 
El warning aparecerá pegado al cuadro de texto del nombre del producto y se activará vía AJAX cada vez que al pulsar una tecla encuentre una coincidencia en la BBDD
La categoría del producto se escogerá mediante un select. No se permitirá un producto que no pertenezca a ninguna categoría. Es decir el caso “c” fallará si todavía no hay categorías definidas. 
Se mostrará un mensaje al administrador y se volverá al menú principal
El caso “r” mostrará todas los productos mostrando su nombre y la categoría a la que pertenece, y los típicos botones de acción para editar o borrar el país.

<?php
class Home extends CI_Controller {
    public function index() {
        $link = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        if (isRolOK('admin') && $link='localhost/pap/hdu/anonymous/init') {

            frame($this,'home/admin');
        }
        else if (isRolOK('auth')) {
            frame($this,'home/auth');
        }
        else {
            frame($this,'home/index');
        }
    }
}