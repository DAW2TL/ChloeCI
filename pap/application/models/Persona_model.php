<?php

class Persona_model extends CI_Model
{

    public function getPersonaById($id)
    {
        return R::load('persona', $id);
    }

    public function getPersonas()
    {
        return R::findAll('persona');
    }
    
    public function borrarPersona($id) {
        $persona = R::load('persona',$id);
        R::trash($persona);
    }

    public function registrarPersona($loginname, $nombre, $password, $altura, $fnac, $foto, $idPaisNace) {
        $ok = (loginname != null && R::findOne('persona','loginname=?',[loginname])==null);

        if ($ok) {
            $persona = R::dispense('persona');
            
            $paisNace = R::load('pais', $idPaisNace);
            // $ventaEnCurso = R::load('venta', $idVentaEnCurso);
            
            $persona->loginname = $loginname;
            $persona->nombre = $nombre;
            $persona->password = password_hash($password,PASSWORD_DEFAULT);
            $persona->altura = $altura;
            $persona->fnac = $fnac;
            $persona->foto = $foto;
            $persona->nace = $paisNace;
            
            $venta = R::dispense('venta');
            $venta->ventaencurso = $persona;
            
            R::store($persona);
            
            $persona->ventaencurso = $venta;
            
        } else {
            $e = (R::findOne('persona','loginname=?',[$loginname])!=null? new Exception("Duplicado") : new Exception("valores nulos"));
            throw $e;
        }
    }
    
    public function registrarAdmin($loginname, $nombre, $password) {
        $ok = (loginname != null && $nombre != null &&
            R::findOne('persona','loginname=?',[loginname])==null);
        
        if ($ok) {
            $persona = R::dispense('persona');
            
            $persona->loginname = $loginname;
            $persona->nombre = $nombre;
            $persona->password = password_hash($password,PASSWORD_DEFAULT);
            
            R::store($persona);
            
        } else {
            $e = (R::findOne('persona','loginname=?',[$loginname])!=null? new Exception("Duplicado") : new Exception("valores nulos"));
            throw $e;
        }
    }
    
    public function actualizarPersona($id, $loginname, $nombre, $password, $altura, $fnac, $foto, $idPaisNace)
    {
        $ok = ($loginname != null && $idPaisNace);
        if ($ok) {
            $persona = R::load('persona', $id);
            $persona->loginname = $loginname;
            $persona->nombre = $nombre;
            $persona->password = $password;
            $persona->altura = $altura;
            $persona->fnac = $fnac;
            $persona->foto = $foto;
            $persona->nace = $idPaisNace;
//             $persona->ventaencurso_id = $idVentaEnCurso;                  

//             $comunes = [];
//             foreach ($persona->ownGustaList as $gusta) {
//                 if (! in_array($gusta->aficion_id, $idsAficionGusta)) {
//                     R::store($persona);
//                     R::trash($gusta);
//                 } else {
//                     $comunes[] = $gusta->aficion_id;
//                 }
//             }

//             foreach (array_diff($idsAficionGusta, $comunes) as $idGusta) {
//                 $aficion = R::load('aficion', $idGusta);
//                 $gusta = R::dispense('gusta');
//                 $gusta->persona = $persona;
//                 $gusta->aficion = $aficion;              
//                 R::store($gusta);
//             }
            R::store($persona);
        } else {
            $e = ($loginname == null ? new Exception("nulo") : new Exception("duplicado"));
            throw $e;
        }
    }

    public function verificarLogin($loginname,$password) {
        $usuario = R::findOne('persona','loginname=?',[$loginname]);
        if ($usuario == null) {
            throw new Exception("Usuario o contraseña no correctas");
        }
        if (!password_verify($password,$usuario->password)) {
            throw new Exception("Usuario o contraseña no correctas");
        }
        return $usuario;
    }
}

//     public function crearPersona($loginname, $nombre, $password, $altura, $idFnac, $idPaisNace, $idFoto, $idVentaEnCurso)
//     {
//         $ok = ($loginname != null);
//         if ($ok) {
//             $persona = R::dispense('persona');

//             $paisNacimiento = R::load('pais', $idPaisNace);
//             $ventaEnCurso = R::load('venta', $idVentaEnCurso);

//             $persona->loginname = $loginname;
//             $persona->nombre = $nombre;
//             $persona->password = password_hash($password,PASSWORD_DEFAULT);
//             $persona->altura = $altura;
//             $persona->fnac = $idFnac;
//             $persona->nace = $paisNacimiento;
//             $persona->foto = $idFoto;
//             $persona->ventaencurso = $ventaEnCurso;

//             R::store($persona);

// //             foreach ($idsAficionGusta as $idAficionGusta) {
// //                 $aficion = R::load('aficion', $idAficionGusta);
// //                 $gusta = R::dispense('gusta');
// //                 $gusta->persona = $persona;
// //                 $gusta->aficion = $aficion;
// //                 R::store($gusta);
// //             }
// //             foreach ($idsAficionOdia as $idAficionOdia) {
// //                 $aficion = R::load('aficion', $idAficionOdia);
// //                 $odia = R::dispense('odia');
// //                 $odia->persona = $persona;
// //                 $odia->aficion = $aficion;
// //                 R::store($odia);
// //             }
//         } else {
//             $e = ($loginname == null ? new Exception("nulo") : new Exception("duplicado"));
//             throw $e;
//         }
//     }

?>
