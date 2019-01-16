<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<script
src="https://code.jquery.com/jquery-3.3.1.min.js"
integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
crossorigin="anonymous"></script>
<title><?php echo $this->title; ?></title>
<link rel="stylesheet" href="<?php echo base_url();?>public/css/theme.css">
<link rel="shortcut icon" href="<?php echo base_url();?>public/favicon.ico">
</head>
<body>
    <?php $this->load->view('navbar');?>
</body>
</html>