<?php

require __DIR__ . '/vendor/autoload.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$action = $_GET['action'] ?? ($_POST['action'] ?? 'dashboard');
$method = $_SERVER['REQUEST_METHOD'];

try {
    switch (true) {
        case $action === 'login' && $method === 'GET':
            AutenticacaoController::telaLogin();
            break;
        case $action === 'login' && $method === 'POST':
            AutenticacaoController::login();
            break;
        case $action === 'register' && $method === 'GET':
            AutenticacaoController::telaCadastro();
            break;
        case $action === 'register' && $method === 'POST':
            AutenticacaoController::cadastrar();
            break;
        case $action === 'logout' && $method === 'POST':
            AutenticacaoController::logout();
            break;
        case $action === 'dashboard' && $method === 'GET':
            HabitoController::dashboard();
            break;
        case $action === 'habitos' && $method === 'GET':
            HabitoController::listar();
            break;
        case $action === 'criar-habito' && $method === 'GET':
            HabitoController::telaCriar();
            break;
        case $action === 'criar-habito' && $method === 'POST':
            HabitoController::criar();
            break;
        case $action === 'editar-habito' && $method === 'GET':
            HabitoController::telaEditar();
            break;
        case $action === 'atualizar-habito' && $method === 'POST':
            HabitoController::atualizar();
            break;
        case $action === 'excluir-habito' && $method === 'POST':
            HabitoController::excluir();
            break;
        case $action === 'detalhes-habito' && $method === 'GET':
            HabitoController::detalhes();
            break;
        case $action === 'alterar-status' && $method === 'POST':
            HabitoController::alterarStatus();
            break;
        default:
            header('Location: index.php?action=dashboard');
            exit;
    }
} catch (PDOException $e) {
    http_response_code(500);
    $mensagem = 'Não foi possível concluir a operação. Verifique a configuração do banco de dados.';
    require __DIR__ . '/View/erro.php';
}
