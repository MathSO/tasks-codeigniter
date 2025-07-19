<?php 
    $pager->setSurroundCount(3);
    if ($pager->getPageCount() > 0): ?>
<nav>
    <ul class="pagination justify-content-center">

        <!-- Botão "Anterior" -->
        <?php if ($pager->hasPreviousPage()): ?>
            <li class="page-item">
                <a class="page-link" href="<?= $pager->getPreviousPage() ?>" aria-label="Anterior">
                    &laquo; Anterior
                </a>
            </li>
        <?php else: ?>
            <li class="page-item disabled"><span class="page-link">&laquo; Anterior</span></li>
        <?php endif; ?>

        <!-- Links numéricos -->
        <?php foreach ($pager->links() as $link): ?>
            <li class="page-item <?= $link['active'] ? 'active' : '' ?>">
                <a class="page-link" href="<?= $link['uri'] ?>">
                    <?= $link['title'] ?>
                </a>
            </li>
        <?php endforeach; ?>

        <!-- Botão "Próxima" -->
        <?php if ($pager->hasNextPage()): ?>
            <li class="page-item">
                <a class="page-link" href="<?= $pager->getNextPage() ?>" aria-label="Próxima">
                    Próxima &raquo;
                </a>
            </li>
        <?php else: ?>
            <li class="page-item disabled"><span class="page-link">Próxima &raquo;</span></li>
        <?php endif; ?>

    </ul>
</nav>
<?php endif ?>
