<?php $tituloPagina = 'Entrar'; ?>
<?php require __DIR__ . '/../templates/header.php'; ?>
<div class="auth-box card shadow-sm">
    <div class="card-body p-4">
        <div class="text-center mb-4">
            <div class="brand-icon">✓</div>
            <h2 class="mb-1"><?= htmlspecialchars(APP_NAME) ?></h2>
            <p class="text-muted">Cuide dos seus hábitos.</p>
        </div>
        <?php if (!empty($erros)): ?>
            <div class="alert alert-danger"><?php foreach ($erros as $erro): ?>
                    <div><?= htmlspecialchars($erro, ENT_QUOTES, 'UTF-8') ?></div><?php endforeach; ?>
            </div><?php endif; ?>
        <form action="index.php?action=login" method="post">
            <div class="mb-3"><label class="form-label">E-mail</label><input type="email" name="email"
                    class="form-control" value="<?= htmlspecialchars($_POST['email'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                    required></div>
            <div class="mb-3"><label class="form-label">Senha</label><input type="password" name="senha"
                    class="form-control" required></div>
            <button class="btn btn-success w-100">Entrar</button>
        </form>
        <p class="text-center mt-3 mb-0">Não tem conta? <a href="index.php?action=register">Cadastre-se</a></p>
    </div>
</div>
<?php require __DIR__ . '/../templates/footer.php'; ?>