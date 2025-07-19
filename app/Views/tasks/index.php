<?php
use App\Models\TaskStatusEnum;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Lista de Tarefas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        tr.clickable-row {
            cursor: pointer;
        }

    </style>
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Lista de Tarefas</h1>

    <!-- Formulário de pesquisa por ID -->
    <form method="get" action="<?= base_url('/tasks') ?>" class="row g-3 mb-4">
        <div class="col-auto">
            <input type="text" pattern="([0-9])+" name="search_id" class="form-control" placeholder="Buscar por ID" value="<?= esc($search_id) ?>">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary">Buscar</button>
            <a href="<?= base_url('/tasks') ?>" class="btn btn-secondary">Limpar</a>
            |
            <a href="<?= base_url('/tasks/create') ?>" class="btn btn-success">+ Nova Tarefa</a>
        </div>
    </form>

    <!-- Tabela -->
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Descrição</th>
                <th>Status</th>
                <th>Criado em</th>
                <th>Atualizado em</th>
            </tr>
        </thead>
        <tbody>
        <?php if (!empty($tasks) && is_array($tasks)): ?>
            <?php foreach ($tasks as $task): ?>
                <tr class="clickable-row" data-href="<?= base_url('/tasks/edit/' . $task['id']) ?>">
                    <td><?= esc($task['id']) ?></td>
                    <td><?= esc($task['title']) ?></td>
                    <td><?= esc($task['description']) ?></td>
                    <td><?= esc(TaskStatusEnum::toHuman($task['status'])) ?></td>
                    <td><?= date('d/m/Y H:i', strtotime($task['created_at'])) ?></td>
                    <td><?= date('d/m/Y H:i', strtotime($task['updated_at'])) ?></td>
                </tr>
            <?php endforeach; ?>

            <!-- Preencher espaço com linhas vazias, se necessário -->
            <?php for ($i = count($tasks); $i < 10; $i++): ?>
                <tr class="placeholder-row">
                    <td colspan="6">&nbsp;</td>
                </tr>
            <?php endfor; ?>

        <?php else: ?>
            <tr>
                <td colspan="6" class="text-center">Nenhuma tarefa encontrada.</td>
            </tr>

            <?php for ($i = 1; $i < 10; $i++): ?>
                <tr class="placeholder-row">
                    <td colspan="6">&nbsp;</td>
                </tr>
            <?php endfor; ?>
        <?php endif; ?>
        </tbody>
    </table>

    <!-- Paginação -->
    <?php echo $pager->links('default', 'custom') ?>

</div>

<!-- Script para tornar as linhas clicáveis -->
<script>
    document.querySelectorAll('tr.clickable-row').forEach(row => {
        row.addEventListener('click', () => {
            window.location.href = row.dataset.href;
        });
    });
</script>

</body>
</html>
