<?php

require_once __DIR__.'/../../config/app.php';

$app->get('/', function() {
    $data = [];
    return $this->view->write('/challenge2/index.php', $data);
});
$app->get('/user/login', function() {
    $data = [];
    return $this->view->write('/challenge2/login.php', $data);
});
$app->post('/user/login', function($request, $response, $args) {
    $data = ['found' => false];
    $username = $request->getParam('username');
    $password = $request->getParam('password');

    if ($username == 'admin' && $password == '3l33t') {
        $data['found'] = true;
    }

    return $this->view->write('/challenge2/login.php', $data);
});
$app->run();