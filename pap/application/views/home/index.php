<div class="container">
	<h1>Aplicación P.A.P.</h1>

	<?php if ((!isRolOK('admin')) && (!isRolOK('auth'))):?>
	<a href="<?=base_url()?>hdu/anonymous/registrar"><button>Registrar</button></a> 
	<a href="<?=base_url()?>hdu/anonymous/login"><button>Login</button></a> 
	<?php endif;?>
	
	<?php if (isRolOK('admin')):?>
	<a href="<?=base_url()?>pais/c"><button type="button" class="btn btn-light">Crear País</button></a>
	<a href="<?=base_url()?>pais/r"><button type="button" class="btn btn-light">Listar País</button></a><br><br>
	
	<a href="<?=base_url()?>pais/c"><button type="button" class="btn btn-light">Crear Categoría</button></a>
	<a href="<?=base_url()?>pais/r"><button type="button" class="btn btn-light">Listar Categoría</button></a><br><br>
	
	<a href="<?=base_url()?>pais/c"><button type="button" class="btn btn-light">Crear Producto</button></a>
	<a href="<?=base_url()?>pais/r"><button type="button" class="btn btn-light">Listar Producto</button></a><br><br>
	
	<a href="<?=base_url()?>hdu/anonymous/registrar"><button type="button" class="btn btn-light">Registrar persona</button></a><br><br>
	
	<a href="<?=base_url()?>hdu/anonymous/init"><button type="button" class="btn btn-danger">Init</button></a><br><br>
	
	<a href="<?=base_url()?>hdu/user/logout"><button type="button" class="btn btn-info">Logout</button></a>
	<?php endif;?>
	
	<?php if ((isRolOK('auth')) && (!isRolOK('admin'))):?>
	
	<a href="<?=base_url()?>pais/r"><button type="button" class="btn btn-light">Listar País</button></a><br><br>
	
	<a href="<?=base_url()?>pais/r"><button type="button" class="btn btn-light">Listar Categoría</button></a><br><br>
	
	<a href="<?=base_url()?>pais/r"><button type="button" class="btn btn-light">Listar Producto</button></a><br><br>
	
	<a href="<?=base_url()?>hdu/anonymous/registrar" type="button" class="btn btn-light"><button>Registrar persona</button></a><br><br>
	
	<a href="<?=base_url()?>hdu/user/logout"><button type="button" class="btn btn-info">Logout</button></a>
	<?php endif;?>
</div>    		  