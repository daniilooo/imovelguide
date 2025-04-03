<?php

require __DIR__ . '/vendor/autoload.php';

//controladores
use controllers\CorretorController;
//regras de negócio
use rn\RnCorretor;

$url = isset($_GET['url']) ? $_GET['url'] : '';

if (!empty($url)) {
    $url = rtrim($url, '/');
    $url_parts = explode('/', $url);

    $recurso = isset($url_parts[0]) ? $url_parts[0] : '';

    $acao = isset($url_parts[1]) ? $url_parts[1] : 'index';

    switch ($recurso) {
        case 'corretores':
            $controller = new CorretorController(new RnCorretor());
            break;        
        default:
            $controller = null;
            break;
    }

    if ($controller && method_exists($controller, $acao)) {
        $params = array_slice($url_parts, 2);
        call_user_func_array([$controller, $acao], $params);
    } else {
        echo "404 não encontrado - método não existe no controlador";
    }
} else {
    echo "Controladores instáveis";
    exit;
}

?>
