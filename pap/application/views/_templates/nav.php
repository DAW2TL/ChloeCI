

<nav class="container navbar navbar-inverse">
  <div class="navbar-header">
    <a class="navbar-brand" href="<?=base_url()?>">P.A.P.</a>
  </div>
  <div class="collapse navbar-collapse" id="myNavbar">
    <ul class="nav navbar-nav">

      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
           Registro y login<span class="caret"></span>
        </a>
        
		  <ul class="dropdown-menu">
    		  <li><a href="<?=base_url()?>hdu/anonymous/registrar">Registrar persona</a></li>
    		  <?php if ((!isRolOK('admin')) && (!isRolOK('auth'))):?><li><a href="<?=base_url()?>hdu/anonymous/login">Login</a></li><?php endif;?>
    		  <li><a href="<?=base_url()?>hdu/user/logout">Logout</a></li>
	     </ul>
      </li>

	<!-- 
    
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
           Persona<span class="caret"></span>
        </a>
        
		<ul class="dropdown-menu">
		  <li><a href="<?=base_url()?>persona/c">Crear</a></li>
		  <li><a href="<?=base_url()?>persona/r">Listar</a></li>
	     </ul>
      </li>

      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
           Afición<span class="caret"></span>
        </a>
        
		<ul class="dropdown-menu">
		  <li><a href="<?=base_url()?>aficion/c">Crear</a></li>
		  <li><a href="<?=base_url()?>aficion/r">Listar</a></li>
	     </ul>
      </li>
      -->

      <?php if (isRolOK('admin')):?>
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
           País<span class="caret"></span>
        </a>
        
		<ul class="dropdown-menu">
		  <li><a href="<?=base_url()?>pais/c">Crear</a></li>
		  <li><a href="<?=base_url()?>pais/r">Listar</a></li>
	     </ul>
      </li>
      
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
           Categoría<span class="caret"></span>
        </a>
        
		<ul class="dropdown-menu">
		  <li><a href="<?=base_url()?>categoria/c">Crear</a></li>
		  <li><a href="<?=base_url()?>categoria/r">Listar</a></li>
	     </ul>
      </li>
      
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
           Producto<span class="caret"></span>
        </a>
        
		<ul class="dropdown-menu">
		  <li><a href="<?=base_url()?>producto/c">Crear</a></li>
		  <li><a href="<?=base_url()?>producto/r">Listar</a></li>
	     </ul>
      </li>
      
      <li class="dropdown">
        <a href="<?=base_url()?>hdu/anonymous/init"><span>Init</span></a>
      </li>
      <?php endif;?>


    </ul>
  </div>
</nav>


