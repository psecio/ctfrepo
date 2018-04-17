<?php

require_once __DIR__.'/../../config/app.php';

function getAllFiles($db)
{
    $stmt = $db->prepare('select * from files');
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getFileById($db, $fileId, array $cols = [])
{
    if (!empty($cols)) {
        $sql = 'select '.implode(',', $cols).' from files where id = '.$fileId;
    } else {
        $sql = 'select * from files where id = '.$fileId;
    }
    
    $stmt = $db->query($sql, PDO::FETCH_ASSOC);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

$app->get('/', function() {
    $files = getAllFiles($this->db);
    $data = [
        'files' => $files
    ];

    if (isset($_COOKIE['recent'])) {
        $recent = getFileById($this->db, $_COOKIE['recent'], ['title']);
        $data['recent'] = $recent['title'];
    }
    
    return $this->view->write('/challenge6/index.php', $data);
});

$app->get('/view/{id}', function($request, $response, $args) {
    $fileId = $args['id'];
    $file = getFileById($this->db, $fileId);
    $data = [
        'file' => $file
    ];
    if (isset($_COOKIE['recent'])) {
        $recent = getFileById($this->db, $_COOKIE['recent'], ['title']);
        $data['recent'] = $recent['title'];
    }

    // Set a cookie with the recently viewed too
    setcookie('recent', $fileId, time()+86400, '/');

    return $this->view->write('/challenge6/view.php', $data);
});

$app->run();