<?php if (isRolOK('admin')):?>
<div class="container">

<h1>Editar categoría</h1>

<form action="<?=base_url()?>categoria/uPost" method="post">
	<input type="hidden" name="id" value="<?=$categoria->id?>"?>

	<label for="nombreP">Nombre</label>
	<input id="nombreP" type="text" name="nombre" value="<?= $categoria->nombre?>"/>
	<br/>
	
	<input type="submit"/>
</form>

<a href="<?=base_url()?>"><button>Cancelar</button></a>

</div>
<?php else:?>
<?php redirect(base_url()); ?>
<?php endif;?>