<?php

require_once __DIR__.'/../../config/app.php';

$app->get('/', function() {
    $data = [];
    return $this->view->write('/challenge8/index.php', $data);
});

// Get the contents of a directory
$app->post('/', function($request, $response) {

    $match = $request->getParam('match');
    if ($match === null) {
        return $response->withJson(['message' => 'Match value required']);
    }

    $filePath = realpath(__DIR__.'/files');
    exec('ls '.$filePath.' | grep '.$match, $files, $return);

    // return $this->view->write('/challenge8/index.php', $data);
    return $response->withJson(['message' => count($files).' matches found', 'files' => $files]);
});

$app->run();

?>