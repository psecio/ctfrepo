<?php


use Phinx\Migration\AbstractMigration;

class CreateUserTable extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('users');
        $table->addColumn('username', 'string')
            ->addColumn('password', 'string')
            ->addColumn('name', 'string')
            ->addColumn('role', 'string')
            ->save();
    }
}
