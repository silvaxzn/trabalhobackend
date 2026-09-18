<?php $tituloPagina = 'Cadastro'; ?>
<?php require __DIR__ . '/../templates/header.php'; ?>
<div class="auth-box card shadow-sm">
    <div class="card-body p-4">
        <h2 class="text-center mb-4">Criar conta</h2>
        <?php if (!empty($erros)): ?>
            <div class="alert alert-danger"><?php foreach ($erros as $erro): ?>
                    <div><?= htmlspecialchars($erro, ENT_QUOTES, 'UTF-8') ?></div><?php endforeach; ?>
            </div><?php endif; ?>
        <form action="index.php?action=register" method="post">
            <div class="mb-3"><label class="form-label">Nome</label><input type="text" name="nome" class="form-control"
                    value="<?= htmlspecialchars($_POST['nome'] ?? '', ENT_QUOTES, 'UTF-8') ?>" maxlength="100" required>
            </div>
            <div class="mb-3"><label class="form-label">E-mail</label><input type="email" name="email"
                    class="form-control" value="<?= htmlspecialchars($_POST['email'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                    maxlength="150" required></div>
            <div class="mb-3"><label class="form-label">Senha</label><input type="password" name="senha"
                    class="form-control" minlength="6" required></div>
            <div class="mb-3"><label class="form-label">Confirmar senha</label><input type="password" name="confirmacao"
                    class="form-control" minlength="6" required></div>
            <button class="btn btn-success w-100">Cadastrar</button>
        </form>
        <p class="text-center mt-3 mb-0"><a href="index.php?action=login">Voltar para o login</a></p>
    </div>
</div>
<?php require __DIR__ . '/../templates/footer.php'; ?>