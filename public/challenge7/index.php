<?php

require_once __DIR__.'/../../config/app.php';

$key = "example_key";

$header = new \Psecio\Jwt\Header($key);
$jwt = new \Psecio\Jwt\Jwt($header);

// Middleware to verify the auth header is there and valid
$verifyAuth = function($request, $response, $next) use ($jwt, $app){
    $authHeader = $request->getHeader('Authorization');

    if (empty($authHeader)) {
        return $response->withJson(['error' => 'Authorization header required'], 400);
    }

    // Header looks like: Bearer <JWT token>
    $headerParts = explode(' ', $authHeader[0]);
    try {
        $token = $headerParts[1];

        // Decode it insecurely, not caring about the signature
        $jwtParts = explode('.', $token);
        $h = json_decode(base64_decode($jwtParts[0]));
        $b = json_decode(base64_decode($jwtParts[1]));

        // If the algorithm is "None" they're trying the exploit
        $decoded = ($h->alg == 'None') ? $b : $jwt->decode($token);

        $attr = get_object_vars($b);

        if ($attr['aud'] !== 'http://capturetf.com') {
            return $response->withJson(['error' => 'Invalid Authorization header (Invalid audience)']);
        }
        if ($attr['iss'] !== 'http://capturetf.com') {
            return $response->withJson(['error' => 'Invalid Authorization header (Invalid issuer)']);
        }

        // Passed all the checks, get the user and put them in the session
        $stmt = $this->db->prepare('select * from users where username=:username');
        $stmt->execute(['username' => $decoded->username]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // If they're trying the exploit, override the user's actual role with what they provided
        if ($h->alg == 'None' && count($jwtParts) < 3) {
            if ($b->role !== $result['role']) {
                return $response->withJson(['message' => 'You did it! Successful auth bypass!']);
            }
            $user['role'] = $b->role;
        }

        $session = $app->getContainer()->get('session');
        $session->set('user', $result);


    } catch (\Exception $e) {
        return $response->withJson(['error' => 'Error: '.$e->getMessage()], 400);
    }
    

    $response = $next($request, $response);
    return $response;
};


$app->get('/', function() use ($jwt) {
    $data = [];
    return $this->view->write('/challenge7/index.php', $data);
});

$app->post('/api/register', function($request, $response) {
    $params = $request->getParams();

    if (!isset($params['username']) || !isset($params['password']) || !isset($params['name'])) {
        return $response->withJson(['error' => 'Invalid input - username, password and name required.']);
    }

    // Be sure the user doesn't already exist
    $stmt = $this->db->prepare('select id from users where username=:username');
    $stmt->execute(['username' => $params['username']]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (!empty($result)) {
        return $response->withJson(['error' => 'Usernames must be unique!']);
    }

    // Insert the user into the DB
    $data = [
        'username' => $params['username'],
        'password' => password_hash($params['password'], PASSWORD_DEFAULT),
        'name' => $params['name'],
        'role' => 'user'
    ];
    $stmt = $this->db->prepare('insert into users (username, password, name, role, ID) values (:username, :password, :name, :role, null)');
    $result = $stmt->execute($data);

    if ($result == false) {
        $code = $stmt->errorCode();
        return $response->withJson(['error' => 'Error creating user "'.$params['username'].'" ('.$code.')']);
    }

    return $response->withJson([
        'message' => 'User "'.$params['username'].'" created successfully. Use /api/login to authenticate'
    ]);
});

$app->get('/api/users', function($request, $response) {
    $session = $this->get('session');
    $user = $session->get('user');

    if ($user == null) {
        return $response->withJson(['error' => 'There was an error']);
    }
    if ($user['role'] == 'admin') {
        $stmt = $this->db->prepare('select * from users');
        $stmt->execute();
    } else {
        $stmt = $this->db->prepare('select * from users where id = :id');
        $stmt->execute(['id' => $user['id']]);
    }
    
    return $response->withJson($stmt->fetchAll(PDO::FETCH_ASSOC));
})->add($verifyAuth);


$app->post('/api/login', function($request, $response) use ($jwt) {
    $params = $request->getParams();

    if (!isset($params['username']) || !isset($params['password'])) {
        return $response->withJson(['error' => 'Invalid login, please try again']);
    }

    $stmt = $this->db->prepare('select username, password, id from users where username=:username');
    $stmt->execute(['username' => $params['username']]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($result)) {
        return $response->withJson(['error' => 'User not found']);
    }

    if (password_verify($params['password'], $result[0]['password']) !== true) {
        return $response->withJson(['error' => 'Login failure']);
    }

    // Login successful, generate their token and return it
    $jwt
        ->issuer('http://capturetf.com')
        ->audience('http://capturetf.com')
        ->issuedAt(time())
        ->notBefore(time())
        ->expireTime(time()+3600);
    $jwt->custom(['role' => 'user', 'username' => $params['username']]);

    $data = [
        'message' => 'Authorization successful',
        'token' => $jwt->encode()
    ];

    return $response->withJson($data);
});

$app->get('/api/generate', function($request, $response) use ($jwt) {
    $jwt
        ->issuer('http://capturetf.com')
        ->audience('http://capturetf.com')
        ->issuedAt(time())
        ->notBefore(time())
        ->expireTime(time()+3600);
    $jwt->custom([
        'role' => 'admin',
        'username' => 'admin'
    ]);

    return $response->withJson(['token' => $jwt->encode()]);
});

$app->run();