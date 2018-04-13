<?php

require_once __DIR__.'/../../config/app.php';
require_once __DIR__.'/files/auth.phps';
require_once __DIR__.'/files/Data.phps';

$app->get('/', function() {
    
    $d = new Data();
    list($labels, $data) = $d->generate();
    
    $data = [
        'labels' => "'Result ".implode("','Result ", $labels)."'",
        'data' => $data
    ];
    return $this->view->write('/challenge5/index.php', $data);
});

$app->post('/', function($request, $response) {
    
    $data = $request->getParam('data');
    $d = new Data();
    list($labels, $data) = $d->handle($data);

    $data = [
        'labels' => "'Result ".implode("','Result ", $labels)."'",
        'data' => $data
    ];
    return $this->view->write('/challenge5/index.php', $data);
});

$app->run();