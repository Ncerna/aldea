<?php
require_once __DIR__ . '/init.php';
function getSessionUserName()
{
    return isset($_SESSION['S_ROL']) ? trim($_SESSION['S_ROL']) : '';
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $userId = isset($_GET['user_id']) ? (int)$_GET['user_id'] : null;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;

    if ($userId === null) {
        http_response_code(400);
        echo json_encode(['error' => 'user_id is required']);
        exit;
    }

    try {
        $userName = getSessionUserName();
        $isAdmin = (strtoupper($userName) === 'ADMINISTRADOR');
        $response = $messageService->getReceivedMessages($userId,  $isAdmin, $page, $limit);
        // Filtrar solo los mensajes con is_approved == 1 si no es ADMINISTRADOR
       /* if (strtoupper($userName) !== 'ADMINISTRADOR') {
            if (isset($response['data']['list']) && is_array($response['data']['list'])) {
                $response['data']['list'] = array_values(array_filter(
                    $response['data']['list'],
                    function ($item) {
                        return isset($item['is_approved']) && $item['is_approved'] == 1;
                    }
                ));
            }
        }*/

        echo json_encode($response);
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(['status' => false, 'msg' => $e->getMessage()]);
    }
}

