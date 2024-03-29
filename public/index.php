<?php

require_once __DIR__.'/../config/app.php';

$app->get('/', function() {
    $data = [];
    return $this->view->write('/index/index.php', $data);
});

$app->get('/logout', function() {
    $this->session->set('user', null);
    return $this->response->withRedirect('/');
});

$app->run();