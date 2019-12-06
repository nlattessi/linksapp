<?php $this->layout('base') ?>

<div class="row">
    <div class="col">
        <h2>Agregar categoria</h2>
        <hr>
        <form action="" method="post">
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="desarrollo" required>
            </div>
            <hr>
            <button type="submit" class="btn btn-primary">Agregar</button>
            <a href="/" class="btn btn-link btn-sm text-info" role="button">Volver</a>
        </form>
    </div>
</div>
