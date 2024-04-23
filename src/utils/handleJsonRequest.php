<?php
function handleJsonRequest($requiredParams) {
    $body = file_get_contents('php://input');
    $data = json_decode($body, true);

    if ($data === null) {
        http_response_code(400);
        echo json_encode(array('error' => 'Invalid JSON'));
        exit;
    }

    foreach ($requiredParams as $param) {
        if (!isset($data[$param])) {
            http_response_code(400);
            echo json_encode(array('error' => "Missing parameter: $param"));
            exit;
        }
    }

    $extractedData = array();
    foreach ($requiredParams as $param) {
        $extractedData[$param] = $data[$param];
    }

    return $extractedData;
}
?>
