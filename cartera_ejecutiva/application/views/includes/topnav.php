


<?php if($this->uri->segment(2) == 'login'){?>
<center><img class="logoSep" src="<?php echo base_url();?>assets/images/SEP_Vertical.jpg?x=<?php echo time();?>" /></center>
<?php }else{ ?>





<nav class="navbar navbar-inverse sub-navbar navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#subenlaces">
        <span class="sr-only">Interruptor de Navegación</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/">SEP</a>
    </div>
    <div class="collapse navbar-collapse" id="subenlaces">
      <ul class="nav navbar-nav navbar-right">

                            <ul class="nav navbar-nav">

                            <?php if ($this->ion_auth->in_group('capturista') || $this->ion_auth->in_group('admin')){ ?>
                                <li class="<?php echo ($this->uri->segment(1) == 'captura') ? 'active' : '';?>" ><a href="<?php echo base_url();?>index.php/captura">Captura</a></li>

                            <?php } ?>

                                <li class="<?php echo ($this->uri->segment(1) == 'consulta') ? 'active' : '';?>"><a href="<?php echo base_url();?>index.php/consulta">Consulta</a></li>
                            <?php if ($this->ion_auth->in_group('capturista') || $this->ion_auth->in_group('admin')){ ?>


                                <li class="<?php echo ($this->uri->segment(1) == 'catalogos') ? 'active' : '';?>"><a href="<?php echo base_url();?>index.php/catalogos">Catálogos</a></li>

                                

                            <?php } ?>

                            <?php if ($this->ion_auth->in_group('responsables') || $this->ion_auth->in_group('admin')){ ?>
                                <li class="<?php echo ($this->uri->segment(1) == 'responsables') ? 'active' : '';?>"><a href="<?php echo base_url();?>index.php/responsables">Responsables</a></li>
                            <?php } ?>


                            <?php if ($this->ion_auth->is_admin()){ ?>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-hover="dropdown">Usuarios <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li role="presentation" class="dropdown-header">Opciones</li>
                                        <li><a href="<?php echo base_url();?>index.php/auth">Ver Usuarios</a></li>
                                        <li><a href="<?php echo base_url();?>index.php/auth/create_user">Agregar Usuario</a></li>
                                    </ul>
                                </li>



                            <?php } ?>

                                <?php if ($this->ion_auth->logged_in()){ ?>
                                    <li class=""><a href="<?php echo base_url();?>index.php/auth/logout">Salir</a></li>
                                <?php } ?>
 
                            </ul>

            
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

<?php } ?>