<?php

class Habito
{
    public const CATEGORIAS = ['Saúde', 'Estudos', 'Exercícios', 'Produtividade', 'Lazer', 'Pessoal', 'Outro'];
    public const FREQUENCIAS = ['Diário', 'Semanal', 'Mensal'];
    public const STATUS = ['Ativo', 'Concluído'];

    public static function criar(int $usuarioId, string $nome, string $descricao, string $categoria, string $frequencia, string $status): int
    {
        $stmt = Conexao::get()->prepare(
            'INSERT INTO habitos (usuario_id, nome, descricao, categoria, frequencia, status)
             VALUES (:usuario_id, :nome, :descricao, :categoria, :frequencia, :status)'
        );
        $stmt->execute([
            'usuario_id' => $usuarioId,
            'nome' => $nome,
            'descricao' => $descricao,
            'categoria' => $categoria,
            'frequencia' => $frequencia,
            'status' => $status,
        ]);
        return (int) Conexao::get()->lastInsertId();
    }

    public static function listarPorUsuario(int $usuarioId, array $filtros = []): array
    {
        $sql = 'SELECT * FROM habitos WHERE usuario_id = :usuario_id';
        $params = ['usuario_id' => $usuarioId];

        if (!empty($filtros['categoria']) && in_array($filtros['categoria'], self::CATEGORIAS, true)) {
            $sql .= ' AND categoria = :categoria';
            $params['categoria'] = $filtros['categoria'];
        }
        if (!empty($filtros['frequencia']) && in_array($filtros['frequencia'], self::FREQUENCIAS, true)) {
            $sql .= ' AND frequencia = :frequencia';
            $params['frequencia'] = $filtros['frequencia'];
        }
        if (!empty($filtros['status']) && in_array($filtros['status'], self::STATUS, true)) {
            $sql .= ' AND status = :status';
            $params['status'] = $filtros['status'];
        }

        $sql .= ' ORDER BY data_criacao DESC';
        $stmt = Conexao::get()->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public static function buscarPorIdEUsuario(int $id, int $usuarioId): ?array
    {
        $stmt = Conexao::get()->prepare('SELECT * FROM habitos WHERE id = :id AND usuario_id = :usuario_id LIMIT 1');
        $stmt->execute(['id' => $id, 'usuario_id' => $usuarioId]);
        $habito = $stmt->fetch();
        return $habito ?: null;
    }

    public static function atualizar(int $id, int $usuarioId, string $nome, string $descricao, string $categoria, string $frequencia, string $status): bool
    {
        $stmt = Conexao::get()->prepare(
            'UPDATE habitos SET nome = :nome, descricao = :descricao, categoria = :categoria,
             frequencia = :frequencia, status = :status, data_atualizacao = CURRENT_TIMESTAMP
             WHERE id = :id AND usuario_id = :usuario_id'
        );
        return $stmt->execute([
            'nome' => $nome,
            'descricao' => $descricao,
            'categoria' => $categoria,
            'frequencia' => $frequencia,
            'status' => $status,
            'id' => $id,
            'usuario_id' => $usuarioId,
        ]);
    }

    public static function excluir(int $id, int $usuarioId): bool
    {
        $stmt = Conexao::get()->prepare('DELETE FROM habitos WHERE id = :id AND usuario_id = :usuario_id');
        $stmt->execute(['id' => $id, 'usuario_id' => $usuarioId]);
        return $stmt->rowCount() > 0;
    }

    public static function alterarStatus(int $id, int $usuarioId, string $status): bool
    {
        $stmt = Conexao::get()->prepare(
            'UPDATE habitos SET status = :status, data_atualizacao = CURRENT_TIMESTAMP
             WHERE id = :id AND usuario_id = :usuario_id'
        );
        $stmt->execute(['status' => $status, 'id' => $id, 'usuario_id' => $usuarioId]);
        return $stmt->rowCount() > 0;
    }

    public static function contarPorStatus(int $usuarioId): array
    {
        $stmt = Conexao::get()->prepare('SELECT status, COUNT(*) AS total FROM habitos WHERE usuario_id = :usuario_id GROUP BY status');
        $stmt->execute(['usuario_id' => $usuarioId]);
        $linhas = $stmt->fetchAll();
        $contagens = ['total' => 0, 'Ativo' => 0, 'Concluído' => 0];
        foreach ($linhas as $linha) {
            $contagens[$linha['status']] = (int) $linha['total'];
            $contagens['total'] += (int) $linha['total'];
        }
        return $contagens;
    }
}
