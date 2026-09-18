<?php

class HabitoController
{
    private static function validar(array $dados): array
    {
        $erros = [];
        $nome = trim($dados['nome'] ?? '');
        $descricao = trim($dados['descricao'] ?? '');

        if ($nome === '') $erros[] = 'Nome do hábito é obrigatório.';
        elseif (mb_strlen($nome) > 150) $erros[] = 'Nome do hábito deve ter no máximo 150 caracteres.';
        if (mb_strlen($descricao) > 1000) $erros[] = 'Descrição deve ter no máximo 1000 caracteres.';
        if (!in_array($dados['categoria'] ?? '', Habito::CATEGORIAS, true)) $erros[] = 'Categoria inválida.';
        if (!in_array($dados['frequencia'] ?? '', Habito::FREQUENCIAS, true)) $erros[] = 'Frequência inválida.';
        if (!in_array($dados['status'] ?? '', Habito::STATUS, true)) $erros[] = 'Status inválido.';
        return $erros;
    }

    public static function dashboard(): void
    {
        AutenticacaoController::exigirLogin();
        $contagens = Habito::contarPorStatus(AutenticacaoController::usuarioIdLogado());
        require __DIR__ . '/../View/painel.php';
    }

    public static function listar(): void
    {
        AutenticacaoController::exigirLogin();
        $filtros = [
            'categoria' => $_GET['categoria'] ?? '',
            'frequencia' => $_GET['frequencia'] ?? '',
            'status' => $_GET['status'] ?? '',
        ];
        $habitos = Habito::listarPorUsuario(AutenticacaoController::usuarioIdLogado(), $filtros);
        require __DIR__ . '/../View/habitos.php';
    }

    public static function telaCriar(): void
    {
        AutenticacaoController::exigirLogin();
        $erros = [];
        $habito = ['nome' => '', 'descricao' => '', 'categoria' => '', 'frequencia' => 'Diário', 'status' => 'Ativo'];
        require __DIR__ . '/../View/criar-habito.php';
    }

    public static function criar(): void
    {
        AutenticacaoController::exigirLogin();
        $dados = [
            'nome' => $_POST['nome'] ?? '',
            'descricao' => $_POST['descricao'] ?? '',
            'categoria' => $_POST['categoria'] ?? '',
            'frequencia' => $_POST['frequencia'] ?? '',
            'status' => $_POST['status'] ?? '',
        ];
        $erros = self::validar($dados);
        $habito = $dados;
        if ($erros) {
            require __DIR__ . '/../View/criar-habito.php';
            return;
        }

        try {
            Habito::criar(AutenticacaoController::usuarioIdLogado(), trim($dados['nome']), trim($dados['descricao']), $dados['categoria'], $dados['frequencia'], $dados['status']);
        } catch (PDOException $e) {
            $erros[] = 'Erro ao salvar hábito. Tente novamente.';
            require __DIR__ . '/../View/criar-habito.php';
            return;
        }
        $_SESSION['sucesso'] = 'Hábito cadastrado com sucesso!';
        header('Location: index.php?action=habitos');
        exit;
    }

    public static function telaEditar(): void
    {
        AutenticacaoController::exigirLogin();
        $habito = Habito::buscarPorIdEUsuario((int) ($_GET['id'] ?? 0), AutenticacaoController::usuarioIdLogado());
        if (!$habito) {
            $_SESSION['erro'] = 'Hábito não encontrado.';
            header('Location: index.php?action=habitos');
            exit;
        }
        $erros = [];
        require __DIR__ . '/../View/editar-habito.php';
    }

    public static function atualizar(): void
    {
        AutenticacaoController::exigirLogin();
        $id = (int) ($_POST['id'] ?? 0);
        $dados = [
            'nome' => $_POST['nome'] ?? '',
            'descricao' => $_POST['descricao'] ?? '',
            'categoria' => $_POST['categoria'] ?? '',
            'frequencia' => $_POST['frequencia'] ?? '',
            'status' => $_POST['status'] ?? '',
        ];
        $erros = self::validar($dados);
        $habito = array_merge(['id' => $id], $dados);
        $usuarioId = AutenticacaoController::usuarioIdLogado();

        if ($erros) {
            require __DIR__ . '/../View/editar-habito.php';
            return;
        }
        if (!Habito::buscarPorIdEUsuario($id, $usuarioId)) {
            $_SESSION['erro'] = 'Hábito não encontrado.';
            header('Location: index.php?action=habitos');
            exit;
        }

        try {
            Habito::atualizar($id, $usuarioId, trim($dados['nome']), trim($dados['descricao']), $dados['categoria'], $dados['frequencia'], $dados['status']);
        } catch (PDOException $e) {
            $erros[] = 'Erro ao atualizar hábito. Tente novamente.';
            require __DIR__ . '/../View/editar-habito.php';
            return;
        }
        $_SESSION['sucesso'] = 'Hábito atualizado com sucesso!';
        header('Location: index.php?action=habitos');
        exit;
    }

    public static function excluir(): void
    {
        AutenticacaoController::exigirLogin();
        try {
            $ok = Habito::excluir((int) ($_POST['id'] ?? 0), AutenticacaoController::usuarioIdLogado());
        } catch (PDOException $e) {
            $ok = false;
        }
        $_SESSION[$ok ? 'sucesso' : 'erro'] = $ok ? 'Hábito excluído com sucesso!' : 'Hábito não encontrado ou não pôde ser excluído.';
        header('Location: index.php?action=habitos');
        exit;
    }

    public static function detalhes(): void
    {
        AutenticacaoController::exigirLogin();
        $habito = Habito::buscarPorIdEUsuario((int) ($_GET['id'] ?? 0), AutenticacaoController::usuarioIdLogado());
        if (!$habito) {
            $_SESSION['erro'] = 'Hábito não encontrado.';
            header('Location: index.php?action=habitos');
            exit;
        }
        require __DIR__ . '/../View/detalhes-habito.php';
    }

    public static function alterarStatus(): void
    {
        AutenticacaoController::exigirLogin();
        $id = (int) ($_POST['id'] ?? 0);
        $status = $_POST['status'] ?? '';
        if (!in_array($status, Habito::STATUS, true)) {
            $_SESSION['erro'] = 'Status inválido.';
            header('Location: index.php?action=habitos');
            exit;
        }
        $ok = Habito::alterarStatus($id, AutenticacaoController::usuarioIdLogado(), $status);
        $_SESSION[$ok ? 'sucesso' : 'erro'] = $ok ? 'Status atualizado com sucesso!' : 'Hábito não encontrado.';
        header('Location: index.php?action=habitos');
        exit;
    }
}
