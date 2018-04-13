<?php

require_once __DIR__.'/../../config/app.php';

function getPost($db, $postId)
{
    $stmt = $db->prepare('select * from posts where id = :id');
    $stmt->execute(['id' => $postId]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getComments($db, $postId)
{
    $stmt = $db->prepare('select * from comments where post_id = :id');
    $stmt->execute(['id' => $postId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
//----------------------------

$app->get('/', function() {
    $posts = $this->db->query('select * from posts');
    $data = [
        'posts' => $posts
    ];
    return $this->view->write('/challenge3/index.php', $data);
});

$app->get('/view/{id}', function($request, $response, $args) {
    $id = $args['id'];
    $this->response = $response->withHeader('X-XSS-Protection', '0');
    
    if ($request->getParam('reset') !== null) {
        $this->db->exec('delete from comments where post_id = '.(int)$id);
    }

    $data = [
        'post' => getPost($this->db, $id),
        'comments' => getComments($this->db, $id)
    ];

    return $this->view->write('/challenge3/view.php', $data);
});
$app->post('/view/{id}', function($request, $response, $args) {
    $id = $args['id'];
    $comment = $request->getParam('comment');
    $data = [
        'post' => getPost($this->db, $id)
    ];
    $this->response = $response->withHeader('X-XSS-Protection', '0');

    // See if they're trying to sneak in script tags
    $lower = strtolower($comment);
    if (preg_match('/<[^>]*script/', $lower) > 0) {
        $data['message'] = 'Javascript content is not allowed!';
    } else {
        $stmt = $this->db->prepare('insert into comments (post_id, contents, post_date) values (:postId, :contents, :date)');
        $stmt->execute([
            'postId' => $id,
            'contents' => strip_tags($comment, '<img>'),
            'date' => date('Y-m-d H:i:s', time())
        ]);
    }

    $data['comments'] = getComments($this->db, $id);

    return $this->view->write('/challenge3/view.php', $data);
});

$app->run();