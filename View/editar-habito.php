<?php $tituloPagina = 'Editar Hábito'; ?>
<?php require __DIR__ . '/../templates/header.php'; ?>
<?php require __DIR__ . '/../templates/navbar.php'; ?>
<h2 class="mb-4">Editar Hábito</h2>
<?php $action = 'index.php?action=atualizar-habito';
$textoBotao = 'Atualizar';
require __DIR__ . '/../templates/form-habito.php'; ?>
<?php require __DIR__ . '/../templates/footer.php'; ?>