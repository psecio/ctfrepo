<?php


use Phinx\Seed\AbstractSeed;

class UserSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'username' => 'admin',
                'password' => password_hash('admin', PASSWORD_DEFAULT),
                'name' => 'Admin',
                'role' => 'admin'
            ],
            [
                'username' => 'ccornutt',
                'password' => password_hash('test123', PASSWORD_DEFAULT),
                'name' => 'Chris Cornutt',
                'role' => 'user'
            ],
            [
                'username' => 'calevans',
                'password' => password_hash('test456', PASSWORD_DEFAULT),
                'name' => 'Cal Evans',
                'role' => 'user'
            ]
        ];
        $table = $this->table('users');
        $table->insert($data)
            ->save();
    }
}
