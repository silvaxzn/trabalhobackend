<?php $tituloPagina = 'Novo Hábito'; ?>
<?php require __DIR__ . '/../templates/header.php'; ?>
<?php require __DIR__ . '/../templates/navbar.php'; ?>
<h2 class="mb-4">Novo Hábito</h2>
<?php $action = 'index.php?action=criar-habito';
$textoBotao = 'Salvar';
require __DIR__ . '/../templates/form-habito.php'; ?>
<?php require __DIR__ . '/../templates/footer.php'; ?>