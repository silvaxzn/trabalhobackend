<?php
$action = $action ?? 'index.php?action=criar-habito';
$textoBotao = $textoBotao ?? 'Salvar';
?>
<?php if (!empty($erros)): ?><div class="alert alert-danger"><?php foreach ($erros as $erro): ?><div><?= htmlspecialchars($erro, ENT_QUOTES, 'UTF-8') ?></div><?php endforeach; ?></div><?php endif; ?>
<form action="<?= htmlspecialchars($action, ENT_QUOTES, 'UTF-8') ?>" method="post" class="card shadow-sm"><div class="card-body">
<?php if (!empty($habito['id'])): ?><input type="hidden" name="id" value="<?= (int)$habito['id'] ?>"><?php endif; ?>
<div class="mb-3"><label class="form-label">Nome do hábito</label><input type="text" name="nome" class="form-control" maxlength="150" value="<?= htmlspecialchars($habito['nome'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required></div>
<div class="mb-3"><label class="form-label">Descrição</label><textarea name="descricao" class="form-control" rows="4" maxlength="1000" placeholder="Descreva o hábito (opcional)"><?= htmlspecialchars($habito['descricao'] ?? '', ENT_QUOTES, 'UTF-8') ?></textarea></div>
<div class="row g-3"><div class="col-md-4"><label class="form-label">Categoria</label><select name="categoria" class="form-select" required><option value="">Selecione</option><?php foreach (Habito::CATEGORIAS as $item): ?><option value="<?= htmlspecialchars($item) ?>" <?= (($habito['categoria'] ?? '') === $item) ? 'selected' : '' ?>><?= htmlspecialchars($item) ?></option><?php endforeach; ?></select></div><div class="col-md-4"><label class="form-label">Frequência</label><select name="frequencia" class="form-select" required><?php foreach (Habito::FREQUENCIAS as $item): ?><option value="<?= htmlspecialchars($item) ?>" <?= (($habito['frequencia'] ?? '') === $item) ? 'selected' : '' ?>><?= htmlspecialchars($item) ?></option><?php endforeach; ?></select></div><div class="col-md-4"><label class="form-label">Status</label><select name="status" class="form-select" required><?php foreach (Habito::STATUS as $item): ?><option value="<?= htmlspecialchars($item) ?>" <?= (($habito['status'] ?? '') === $item) ? 'selected' : '' ?>><?= htmlspecialchars($item) ?></option><?php endforeach; ?></select></div></div>
<div class="mt-4"><button class="btn btn-success"><?= htmlspecialchars($textoBotao) ?></button> <a href="index.php?action=habitos" class="btn btn-outline-secondary">Cancelar</a></div>
</div></form>
