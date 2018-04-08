<?php


use Phinx\Migration\AbstractMigration;

class CreateCommentsTable extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('comments');
        $table->addColumn('post_id', 'integer')
            ->addColumn('contents', 'text')
            ->addColumn('post_date', 'datetime')
            ->save();
    }
}
