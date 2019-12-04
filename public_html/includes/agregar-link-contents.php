<div class="row">
    <div class="col">
        <h2>Agregar link</h2>
        <hr>
        <form action="" method="post">
            <div class="form-group">
                <label for="url">Url</label>
                <input type="url" pattern="https?://.+" class="form-control" id="url" name="url" placeholder="google.com.ar" required>
            </div>
            <div class="form-group">
                <label for="title">Titulo</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Google!">
            </div>
            <div class="form-group">
                <label for="category">Categoria</label>
                <select class="form-control" id="category" name="category" required>
                <?php foreach($categorias as $categoria): ?>
                    <?=$categoria?>
                <?php endforeach; ?>
                </select>
            </div>
            <hr>
            <button type="submit" class="btn btn-primary">Agregar</button>
            <a type="submit" href="<?=$HOST?>" class="btn btn-link text-info" role="button">Volver</a>
        </form>
    </div>
</div>
