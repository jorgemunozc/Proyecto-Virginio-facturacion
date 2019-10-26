<div class="main-content"> 
    <div class="clientes-option">
    <label for="clientes">Cliente: </label>
    <select name="lista-clientes" id="clientes-opt">
        <option value="0">Seleccione cliente</option>
        <?php foreach($clientes as $cliente):?>
        <option value="<?php echo $cliente->rut;?>"><?php echo $cliente->razon_social;?></option>
        <?php endforeach;?>
    </select>
    </div>