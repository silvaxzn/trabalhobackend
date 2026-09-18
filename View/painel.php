<?php $tituloPagina = 'Painel'; ?>
<?php require __DIR__ . '/../templates/header.php'; ?>
<?php require __DIR__ . '/../templates/navbar.php'; ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-1">Painel</h2>
        <p class="text-muted mb-0">Acompanhe seus hábitos.</p>
    </div><a href="index.php?action=criar-habito" class="btn btn-success">+ Novo hábito</a>
</div>
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="stat-card"><span>Total de hábitos</span><strong><?= (int) $contagens['total'] ?></strong></div>
    </div>
    <div class="col-md-4">
        <div class="stat-card"><span>Ativos</span><strong><?= (int) $contagens['Ativo'] ?></strong></div>
    </div>
    <div class="col-md-4">
        <div class="stat-card"><span>Concluídos</span><strong><?= (int) $contagens['Concluído'] ?></strong></div>
    </div>
</div>
<div class="card shadow-sm">
    <div class="card-body">
        <h5>Comece agora</h5>
        <p class="text-muted">Cadastre um hábito e acompanhe seu progresso.</p><a href="index.php?action=habitos"
            class="btn btn-outline-success">Ver meus hábitos</a>
    </div>
</div>
<?php require __DIR__ . '/../templates/footer.php'; ?>