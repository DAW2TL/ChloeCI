 <?php if (isRolOK('admin')):?>
<div class="container">

<h1>Nuevo producto</h1>

<form action="<?=base_url()?>producto/cPost" method="post">
	<label for="idp">Nombre</label>
	<input id="idp" type="text" name="nombre"/>
	<input type="submit"/>
</form>
<?php else:?>
<?php redirect(base_url()); ?>
<?php endif;?>