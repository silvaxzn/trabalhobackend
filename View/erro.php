<?php $tituloPagina = 'Erro'; ?>
<?php require __DIR__ . '/../templates/header.php'; ?>
<div class="card shadow-sm text-center">
    <div class="card-body py-5">
        <h2>Ops!</h2>
        <p class="text-muted"><?= htmlspecialchars($mensagem ?? 'Ocorreu um erro inesperado.', ENT_QUOTES, 'UTF-8') ?>
        </p><a href="index.php?action=dashboard" class="btn btn-success">Voltar ao painel</a>
    </div>
</div>
<?php require __DIR__ . '/../templates/footer.php'; ?>