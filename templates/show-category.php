<?php $this->layout('base', ['categories' => $categories, 'selectedCategory' => $selectedCategory, 'title' => 'Categoria ' . $selectedCategory->getName(),]) ?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 border-bottom">
        <h1 class="h2"><?= $this->e($selectedCategory->getName()) ?></h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
                <form action="/categories/<?= $this->e($selectedCategory->getId()) ?>/delete" method="post">
                    <button type="submit" type="button" class="btn btn-sm btn-outline-secondary"
                            onClick="return confirmSubmit()">
                        Borrar categoria
                    </button>
                </form>
            </div>
            <a type="button" class="btn btn-sm btn-outline-secondary"
               href="/category/<?= $this->e($selectedCategory->getName()) ?>/add-link">
                Agregar link
            </a>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-borderless table-hover">
            <thead>
            <tr>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($selectedCategory->getLinks() as $link): ?>
                <tr>
                    <td>
                        <a href="<?= $this->e(urldecode($link->getUrl())); ?>">
                            <p class="lead">
                                <?= $this->e($link->getTitle()) ?>
                            </p>
                    </td>
                    <td>
                        <form action="/links/<?= $this->e($link->getId()) ?>/delete" method="post">
                            <button type="submit" class="btn btn-outline-secondary btn-sm"
                                    onClick="return confirmDeleteLinkSubmit()"><span class="oi oi-trash"></span>
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>

<?php $this->start('js') ?>

<script>
    function confirmSubmit() {
        return confirm("¿Estás seguro de borrar la categoria <?= $this->e($selectedCategory->getName()) ?>?");
    }

    function confirmDeleteLinkSubmit() {
        return confirm("¿Estás seguro de borrar este link?");
    }
</script>

<?php $this->stop() ?>
