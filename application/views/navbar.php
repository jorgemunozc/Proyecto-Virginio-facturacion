<aside class="navbar">
    <ul class="navbar-wrapper">
        <li class="navbar__link navbar__link--bg-white">
            <img src="<?php echo base_url().'public/images/';?>virginio_logo.jpg" alt="Logo Virginio">
            <img src="<?php echo base_url().'public/images/';?>CFE_logo.png" alt="Logo Empresa Simulada">
        </li>
        <li class="navbar__link"><a href="<?php echo base_url();?>servicios">Gestionar Servicios</a></li>
        <li class="navbar__link"><a href="<?php echo base_url();?>clientes" >Gestionar Clientes</a></li>
        <li class="navbar__link"><a href="<?php echo base_url();?>facturas/listar_facturaciones">Facturación</a></li>
        <li class="navbar__link"><a href="<?php echo base_url();?>facturas/listar_facturas">Historial facturas</a></li>
        <li class="navbar__link navbar__link--bg-red logout"><a href="<?php echo base_url();?>login/logout">Cerrar Sesión</a></li>
    </ul>
</aside>