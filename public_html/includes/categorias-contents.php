<div class="row">
    <div class="col-3">
        <p class="lead text-center">Categorias <a href="/agregar_categoria.php" type="button" class="btn btn-link" role="button">Agregar</a></p>
        <div class="list-group text-center">
        <?php foreach($categorias as $categoria): ?>
            <?php echo $categoria; ?>
        <?php endforeach; ?>
        <a class="list-group-item list-group-item-action text-info" href="/">Todos</a>
        </div>
    </div>
    <div class="col-9">
        <p class="lead text-center">Links <a href="/agregar_link.php" type="button" class="btn btn-link" role="button">Agregar</a></p>
        <div class="list-group text-center">
        <?php foreach($links as $link): ?>
            <?php echo $link; ?>
        <?php endforeach; ?>
        </div>
    </div>
</div>
