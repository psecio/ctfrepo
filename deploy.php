<?php

require_once 'vendor/autoload.php';
use Cmd\Command;
use Cmd\Output;
use DigitalOceanV2\Adapter\BuzzAdapter;
use DigitalOceanV2\DigitalOceanV2;
use Mailgun\Mailgun;

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

$config = [
    'required' => ['email']
];
$cmd = new Command();
$out = new Output();

try {
    $args = $cmd->execute($_SERVER['argv'], $config);
} catch (\Exception $e) {
    $out->error('  '.$e->getMessage().'  ');
    die("\n");
}

// Generate a random server name
$name = 'ctfrepo-'.md5(mt_rand(0, 100));
$doToken = $_ENV['DO_TOKEN'];

echo 'Building '.$name." for ".$args['email']."\n";

$createCmd = 'docker-machine create --driver=digitalocean --digitalocean-access-token='.$doToken
    .' --digitalocean-size=1gb '.$name.'; docker-machine env '.$name.'; eval $(docker-machine env '.$name.');'
    .' docker-compose up -d --build';

echo $out->info($createCmd, true)."\n";
passthru($createCmd);

$out->success('Created machine '.$name);

// Call the DO API and get the IP
$adapter = new BuzzAdapter($_ENV['DIGITALOCEAN_ACCESS_TOKEN']);
$do = new DigitalOceanV2($adapter);

$droplet = $do->droplet();
$droplets = $droplet->getAll();

$ipAddress = null;
foreach ($droplets as $droplet) {
    if ($droplet->name == $name) {
        $ipAddress = $droplet->networks[0]->ipAddress;
    }
}
if ($ipAddress == null) {
    die('Could not find IP for '.$name);
} else {
    echo $out->success('  Success!  ', true)."\n";
    echo 'IP address for '.$name.': '.$ipAddress.'  '."\n\n";

    echo 'Sending email to '.$args['email'].' with details'."\n";

    // Send an email to the email address with the IP information
    $mg = Mailgun::create($_ENV['MAILGUN_SECRET_KEY']);
    $mg->messages()->send($_ENV['MAILGUN_DOMAIN'], [
        'from'    => 'info@websec.io',
        'to'      => $args['email'],
        'subject' => 'Your instance is ready: '.$name,
        'text'    => 'Please visit the following to view your instance: http://'.$ipAddress
    ]);
}
