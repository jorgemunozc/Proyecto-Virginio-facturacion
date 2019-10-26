<!DOCTYPE html>
<html lang="es">
<head>
    <?php $this->load->view('meta');?>
</head>
<body>
    <div class="wrapper">
        <?php $this->load->view('navbar');?>
        <main class="main-content">
            <?php echo $content; ?>
        </main>
    </div>
</body>
</html>