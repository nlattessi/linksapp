<?php $this->layout('base') ?>

<div class="row">
    <div class="col-3">
        <p class="lead text-center">Categorias <a href="/agregar-categoria">
                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                     x="0px" y="0px"
                     width="32px" height="32px" viewBox="0 0 92 92" enable-background="new 0 0 92 92"
                     xml:space="preserve">
<path style="fill:#17a7d0;" id="XMLID_933_" d="M72.5,46.5c0,2.5-2,4.5-4.5,4.5H50v17c0,2.5-2,4.5-4.5,4.5S41,70.5,41,68V51H24c-2.5,0-4.5-2-4.5-4.5
	s2-4.5,4.5-4.5h17V24c0-2.5,2-4.5,4.5-4.5s4.5,2,4.5,4.5v18h18C70.5,42,72.5,44,72.5,46.5z"/>
</svg>
            </a></p>

        <div class="list-group text-center">
            <?php foreach ($categories as $category): ?>

                <a class="list-group-item list-group-item-action <?= ($category->getName() === $selectedCategoryName) ? ' active' : '' ?>"
                   href="/?category=<?= urlencode($category->getName()); ?>">
                    <?= $this->e($category->getName()) ?>
                </a>

            <?php endforeach; ?>
            <a class="list-group-item list-group-item-action text-info" href="/">Todos</a>
        </div>
    </div>
    <div class="col-9">
        <p class="lead text-center">Links <a href="/agregar-link">
                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                     x="0px" y="0px"
                     width="32px" height="32px" viewBox="0 0 92 92" enable-background="new 0 0 92 92"
                     xml:space="preserve">
<path style="fill:#17a7d0;" id="XMLID_933_" d="M72.5,46.5c0,2.5-2,4.5-4.5,4.5H50v17c0,2.5-2,4.5-4.5,4.5S41,70.5,41,68V51H24c-2.5,0-4.5-2-4.5-4.5
	s2-4.5,4.5-4.5h17V24c0-2.5,2-4.5,4.5-4.5s4.5,2,4.5,4.5v18h18C70.5,42,72.5,44,72.5,46.5z"/>
</svg>
            </a></p>

        <div class="list-group text-center">
            <?php foreach ($links as $link): ?>

                <a class="list-group-item list-group-item-action"
                   href="<?= $this->e(urldecode($link->getUrl())); ?>">
                    <?= $this->e($link->getTitle()) ?>
                </a>

            <?php endforeach; ?>
        </div>
    </div>
</div>