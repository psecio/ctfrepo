<?php

require_once __DIR__.'/../../config/app.php';

function getPost($db, $postId)
{
    $stmt = $db->prepare('select * from posts where id = :id');
    $stmt->execute(['id' => $postId]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getUser($db, $username)
{
    $stmt = $db->prepare('select * from users where username = :username');
    $stmt->execute(['username' => $username]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getUsers($db)
{
    $stmt = $db->prepare('select * from users');
    $stmt->execute(['username' => $username]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);   
}

function deleteUser($db, $userId)
{
    $stmt = $db->prepare('delete from users where id = :id');
    return $stmt->execute(['id' => $userId]);
}

function addUser($db, $data)
{
    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

    $sql = 'insert into users (username, password, name, role) values'
        .' (:username, :password, :name, :role)';

    $stmt = $db->prepare($sql);
    return $stmt->execute($data);
}

function isAuth($container)
{
    $user = $container->session->get('user');
    if ($user == null) {
        $container->session->set('flash', 'You must be logged in to view this resource');
        return false;    
    }
    return true;
}

function isAdmin($container)
{
    $user = $container->session->get('user');
    if ($user['role'] !== 'admin') {
        $container->session->set('flash', 'You are not authorized for this resource');
        return false;    
    }
    return true;
}

$app->get('/', function() {
    $data = [];
    return $this->view->write('/challenge4/index.php', $data);
});

$app->post('/', function($request, $response) {

    $data = [];
    $username = $request->getParam('username');
    $password = $request->getParam('password');

    $user = getUser($this->db, $username);
    print_r($user);

    if ($user === false || password_verify($password, $user['password']) == false) {
        $data['message'] = 'Invalid login information!';
    } elseif (password_verify($password, $user['password']) == true) {
        // Valid login, set the user and redirect
        $this->session->set('user', $user);
        return $this->response->withRedirect('/challenge4/dashboard');
    }

    
    return $this->view->write('/challenge4/index.php', $data);
});

$app->get('/dashboard', function() {
    if (!isAuth($this)) {
        $this->session->set('flash', 'You must be logged in to view this resource');
        return $this->response->withRedirect('/challenge4/');
    }

    $data = [
        'users' => getUsers($this->db)
    ];

    return $this->view->write('/challenge4/dashboard.php', $data);
});

$app->get('/delete/{id}', function($request, $response, $args) {
    // Be sure they're authenticated
    if (!isAuth($this)) {
        return $this->response->withRedirect('/challenge4/');
    }

    // Delete the user
    deleteUser($this->db, $args['id']);
    
    $this->session->set('flash', 'User deleted successfully');
    return $this->response->withRedirect('/challenge4/dashboard');
});

$app->get('/add', function() {
    $data = [];

    // Be sure they're authenticated
    if (!isAuth($this)) {
        return $this->response->withRedirect('/challenge4/');
    }

    // Be sure they're an admin
    if (!isAdmin($this)) {
        return $this->response->withRedirect('/challenge4/');
    }

    return $this->view->write('/challenge4/add.php', $data);
});
$app->post('/add', function($request, $response) {
    // Be sure they're authenticated
    if (!isAuth($this)) {
        return $this->response->withRedirect('/challenge4/');
    }

    // Be sure they're an admin
    if (!isAdmin($this)) {
        return $this->response->withRedirect('/challenge4/');
    }

    $username = $request->getParam('username');
    $input = [
        'username' => $username,
        'password' => $request->getParam('password'),
        'name' => $request->getParam('name'),
        'role' => 'suer'
    ];

    // Usernames are unique
    $user = getUser($this->db, $username);
    if ($user !== null) {
        $data['message'] = 'Username must be unique';
        $data = array_merge($data, $input);
        
        return $this->view->write('/challenge4/add.php', $data);

    } else {
        addUser($this->db, $input);
    
        $this->session->set('flash', 'User added successfully');
        return $this->response->withRedirect('/challenge4/dashboard');
    }
});

$app->run();