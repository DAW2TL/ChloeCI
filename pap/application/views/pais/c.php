 <?php if (isRolOK('admin')):?>
<div class="container">

<h1>Nuevo país</h1>

<form action="<?=base_url()?>pais/cPost" method="post">
	<input type="hidden" name="id" value="<?=$pais->id?>">
	<label for="idp">Nombre</label>
	<input id="idp" type="text" name="nombre"/>
	<input type="submit"/>
</form>
<?php else:?>
<?php redirect(base_url()); ?>
<?php endif;?>