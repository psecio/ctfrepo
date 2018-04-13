<?php

require_once __DIR__.'/../../config/app.php';

$app->get('/', function() {
    $input = json_decode(file_get_contents(__DIR__.'/posts.txt'));
    $data = [
        'posts' => $input->posts
    ];
    return $this->view->write('/challenge1/index.php', $data);
});

$app->get('/admin', function() {
    $data = [];
    // Set the cookie
    if (!isset($_COOKIE['is_admin'])) {
        $cookie = base64_encode('admin=0');
        setcookie('is_admin', $cookie);
    } else {
        // If it's set, see if they changed it
        $cookie = base64_decode($_COOKIE['is_admin']);

        if (urldecode($cookie) == 'admin=1') {
            $data['flag'] = 'Success! You found the flag at the "hidden" admin access point';
        }
    }
    
    return $this->view->write('/challenge1/admin.php', $data);
});
$app->post('/admin', function() {
    $data = [
        'message' => 'Invalid credentials'
    ];
    return $this->view->write('/challenge1/admin.php', $data);
});

$app->run();