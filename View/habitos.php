<?php $tituloPagina = 'Meus Hábitos'; ?>
<?php require __DIR__ . '/../templates/header.php'; ?>
<?php require __DIR__ . '/../templates/navbar.php'; ?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h2 class="mb-1">Meus Hábitos</h2>
        <p class="text-muted mb-0">Gerencie seus hábitos pessoais.</p>
    </div><a href="index.php?action=criar-habito" class="btn btn-success">+ Novo hábito</a>
</div>
<form action="index.php" method="get" class="card card-body shadow-sm mb-4"><input type="hidden" name="action"
        value="habitos">
    <div class="row g-2">
        <div class="col-md-4"><select name="categoria" class="form-select">
                <option value="">Todas as categorias</option><?php foreach (Habito::CATEGORIAS as $item): ?>
                    <option value="<?= htmlspecialchars($item) ?>" <?= (($_GET['categoria'] ?? '') === $item) ? 'selected' : '' ?>><?= htmlspecialchars($item) ?></option><?php endforeach; ?>
            </select></div>
        <div class="col-md-3"><select name="frequencia" class="form-select">
                <option value="">Todas as frequências</option><?php foreach (Habito::FREQUENCIAS as $item): ?>
                    <option value="<?= htmlspecialchars($item) ?>" <?= (($_GET['frequencia'] ?? '') === $item) ? 'selected' : '' ?>><?= htmlspecialchars($item) ?></option><?php endforeach; ?>
            </select></div>
        <div class="col-md-3"><select name="status" class="form-select">
                <option value="">Todos os status</option><?php foreach (Habito::STATUS as $item): ?>
                    <option value="<?= htmlspecialchars($item) ?>" <?= (($_GET['status'] ?? '') === $item) ? 'selected' : '' ?>><?= htmlspecialchars($item) ?></option><?php endforeach; ?>
            </select></div>
        <div class="col-md-2"><button class="btn btn-outline-success w-100">Filtrar</button></div>
    </div>
</form>
<?php if (empty($habitos)): ?>
    <div class="card shadow-sm">
        <div class="card-body text-center py-5">
            <h5>Nenhum hábito encontrado.</h5>
            <p class="text-muted">Cadastre seu primeiro hábito.</p><a href="index.php?action=criar-habito"
                class="btn btn-success">Criar hábito</a>
        </div>
    </div><?php else: ?>
    <div class="row g-3"><?php foreach ($habitos as $habito): ?>
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start gap-2">
                            <h5 class="card-title"><?= htmlspecialchars($habito['nome'], ENT_QUOTES, 'UTF-8') ?></h5><span
                                class="badge <?= $habito['status'] === 'Concluído' ? 'bg-success' : 'bg-secondary' ?>"><?= htmlspecialchars($habito['status']) ?></span>
                        </div>
                        <p class="text-muted small mb-2"><?= htmlspecialchars($habito['categoria']) ?> ·
                            <?= htmlspecialchars($habito['frequencia']) ?>
                        </p>
                        <p class="card-text text-truncate"><?= htmlspecialchars($habito['descricao'], ENT_QUOTES, 'UTF-8') ?>
                        </p>
                        <div class="mt-auto pt-2 d-flex flex-wrap gap-2"><a
                                href="index.php?action=detalhes-habito&id=<?= (int) $habito['id'] ?>"
                                class="btn btn-sm btn-outline-success">Detalhes</a><a
                                href="index.php?action=editar-habito&id=<?= (int) $habito['id'] ?>"
                                class="btn btn-sm btn-outline-secondary">Editar</a><?php $novoStatus = $habito['status'] === 'Ativo' ? 'Concluído' : 'Ativo'; ?>
                            <form action="index.php?action=alterar-status" method="post" class="d-inline"><input type="hidden"
                                    name="id" value="<?= (int) $habito['id'] ?>"><input type="hidden" name="status"
                                    value="<?= htmlspecialchars($novoStatus) ?>"><button
                                    class="btn btn-sm btn-outline-primary"><?= $novoStatus === 'Concluído' ? 'Concluir' : 'Reativar' ?></button>
                            </form>
                            <form action="index.php?action=excluir-habito" method="post" class="d-inline"
                                onsubmit="return confirm('Deseja excluir este hábito?');"><input type="hidden" name="id"
                                    value="<?= (int) $habito['id'] ?>"><button
                                    class="btn btn-sm btn-outline-danger">Excluir</button></form>
                        </div>
                    </div>
                </div>
            </div><?php endforeach; ?>
    </div><?php endif; ?>
<?php require __DIR__ . '/../templates/footer.php'; ?>