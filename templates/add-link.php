<?php $this->layout('base', ['categories' => $categories, 'selectedCategory' => $selectedCategory, 'title' => 'Agregar link']) ?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Agregar link a <span class="font-italic"><?= $this->e($selectedCategory->getName()) ?></h1>
    </div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 mt-4">
        <form action="" method="post">
            <div class="form-row">
                <div class="col-5">
                    <input type="url" class="form-control" placeholder="https://google.com.ar"
                           pattern="https?://.+" name="url" required>
                </div>
                <div class="col-5">
                    <input type="text" class="form-control" placeholder="Google"
                           name="title">
                </div>
                <div class="col-2">
                    <button type="submit" class="btn btn-outline-secondary">Agregar</button>
                </div>
            </div>
        </form>
    </div>
</main>
