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