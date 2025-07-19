<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Editar Tarefa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Editar Tarefa #<?= esc($task['id']) ?></h1>

    <form method="post" action="<?= base_url('/tasks/update/' . $task['id']) ?>">
        <?= csrf_field() ?>

        <div class="mb-3">
            <label for="title" class="form-label">Título</label>
            <input type="text" name="title" id="title" class="form-control" value="<?= esc($task['title']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descrição</label>
            <textarea name="description" id="description" class="form-control" rows="4"><?= esc($task['description']) ?></textarea>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-select" required>
                <option value="pendente"     <?= $task['status'] === 'pendente'     ? 'selected' : '' ?>>Pendente</option>
                <option value="em_andamento" <?= $task['status'] === 'em_andamento' ? 'selected' : '' ?>>Em andamento</option>
                <option value="concluida"    <?= $task['status'] === 'concluida'    ? 'selected' : '' ?>>Concluída</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Salvar</button>
        <a href="<?= base_url('/tasks') ?>" class="btn btn-secondary">Voltar</a>
        |
        <button type="submit" name="delete" class="btn btn-danger">Excluir</button>
    </form>
</div>
</body>
</html>
