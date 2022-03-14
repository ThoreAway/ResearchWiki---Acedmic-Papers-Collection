<?php 

function JSONexceptionHandler($e) {
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    $output['message'] = "Internal Server error!";
    $output['error code'] = "500";

    http_response_code(500);

    if (DEVELOPMENT_MODE) {
        $output['Message'] = $e->getMessage();
        $output['File'] = $e->getFile();
        $output['Line'] = $e->getLine();
    }

    echo json_encode($output);
}