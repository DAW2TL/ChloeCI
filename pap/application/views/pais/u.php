<?php if (isRolOK('admin')):?>
<div class="container">

<h1>Editar pais</h1>

<form action="<?=base_url()?>pais/uPost" method="post">
	<input type="hidden" name="id" value="<?=$pais->id?>"?>

	<label for="nombreP">Nombre</label>
	<input id="nombreP" type="text" name="nombre" value="<?= $pais->nombre?>"/>
	<br/>
	
	<input type="submit"/>
</form>

<a href="<?=base_url()?>"><button>Cancelar</button></a>

</div>
<?php else:?>
<?php redirect(base_url()); ?>
<?php endif;?>