<?php $tituloPagina = 'Detalhes do Hábito'; ?>
<?php require __DIR__ . '/../templates/header.php'; ?>
<?php require __DIR__ . '/../templates/navbar.php'; ?>
<div class="card shadow-sm">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-start">
            <div>
                <h2><?= htmlspecialchars($habito['nome'], ENT_QUOTES, 'UTF-8') ?></h2>
                <p class="text-muted"><?= htmlspecialchars($habito['categoria']) ?> ·
                    <?= htmlspecialchars($habito['frequencia']) ?>
                </p>
            </div><span
                class="badge <?= $habito['status'] === 'Concluído' ? 'bg-success' : 'bg-secondary' ?> fs-6"><?= htmlspecialchars($habito['status']) ?></span>
        </div>
        <hr>
        <p style="white-space: pre-wrap;">


            <?= htmlspecialchars($habito['descricao'], ENT_QUOTES, 'UTF-8') ?: 'Sem descrição.' ?>
        </p>
        <p class="text-muted small mb-0">Criado em
                   <?= htmlspecialchars(date('d/m/Y H:i', strtotime($habito['data_criacao']))) ?><?php if (!empty($habito['data_atualizacao']) && $habito['data_atualizacao'] !== $habito['data_criacao']): ?>
                · Atualizado em

                <?= htmlspecialchars(date('d/m/Y H:i', strtotime($habito['data_atualizacao']))) ?><?php endif; ?>
        </p>
        <div class="mt-4"><a href="index.php?action=editar-habito&id=<?= (int) $habito['id'] ?>"
                class="btn btn-outline-secondary">Editar</a> <a href="index.php?action=habitos"
                class="btn btn-outline-success">Voltar</a></div>
    </div>
</div>
<?php require __DIR__ . '/../templates/footer.php'; ?>