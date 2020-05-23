<div class="container">

<h1>Registro de nuevo usuario</h1>

<form action="<?=base_url()?>persona/cPost" method="post">
	<label for="id-ln">Loginname</label>
	<input id="id-ln" type="text" name="loginname" required="required"/>
	<br/>
	
	<label for="idp">Nombre</label>
	<input id="idp" type="text" name="nombre" required="required"/>
	<br/>
	
	<label for="id-pwd">Contraseña</label>
	<input id="id-pwd" type="password" name="pwd" required="required"/>
	<br/>
	
	<label for="id-alt">Altura</label>
	<input id="id-alt" type="number" name="altura" step="1" min="0" max="400" required="required" value="175"/>
	<br/>
	
	<label for="id-fn">Fecha de Nacimiento</label>
	<input id="id-fn" type="date" name="fnac" required="required" value="2000-02-29"/>
	<br/>
	
	<label for="id-ft">Foto</label>
	<input id="id-ft" type="file" name="foto" required="required"/>
	<br/>

	País nacimiento
	<select name="idPaisNace">
		<option value="----">----</option>
		<?php foreach ($paises as $pais):?>
		<option value="<?=$pais->id?>"><?=$pais->nombre?></option>
		<?php endforeach;?>
	</select>

	<br/>
	<input type="submit"/>
</form>

</div>