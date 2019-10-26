<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo base_url();?>public/css/theme.css">
    <link rel="shortcut icon" href="<?php echo base_url();?>public/favicon.ico">
    <title>Login</title>
</head>
<body>
    <div class="login-wrapper">
        <div class="header">
            <h1 class="header__title">Administración de Servicios: Central de Simulación Virginio Gómez</h1>
        </div>
        <div class="logo-wrapper">
            <div class="logo"><img src="<?php echo base_url();?>public/images/virginio_logo.jpg" alt="Logo Virginio"></div>
            <div class="logo"><img src="<?php echo base_url();?>public/images/CFE_logo.png" alt="Logo Empresa Simulada"></div>
        </div>
        <?php echo form_open('login', 'class="form login"');?>
        <div class="form__field">
            <label for="username">Nombre Usuario</label>
            <input type="text" name="username" id="username" required/>
        </div>
        <div class="form__field">
            <label for="password">Contraseña</label>
            <input type="password" name="password" id="password" required/>
        </div>
        <div class="form__field">
            <input class="btn" type="submit" value="Ingresar" name="submit" />
        </div>
        <?php echo form_close();?>
        <?php echo validation_errors();?>
    </div>
</body>
</html>