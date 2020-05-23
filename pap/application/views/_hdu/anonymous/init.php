<div class="container">

<h1>Init</h1>

<div class="table-responsive">  
<table border="1" class="table table-hover">

<?php foreach ($personas as $persona): ?>
		<tr>
			<td>
				<form  action="<?=base_url()?>persona/dPost" method="post">
				<input type="hidden" value="<?= $persona->id?>" name="id">
						<button onclick="submit();">
							<img src="https://image.flaticon.com/icons/png/512/18/18297.png" width="20" height="20" alt="">
						</button>
				</form>
			</td>
		</tr>
<?php endforeach;?>
</table>
</div>

</div>

