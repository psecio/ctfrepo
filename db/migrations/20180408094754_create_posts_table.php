<?php


use Phinx\Migration\AbstractMigration;

class CreatePostsTable extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('posts');
        $table->addColumn('title', 'string')
            ->addColumn('contents', 'text')
            ->addColumn('post_date', 'datetime')
            ->save();
    }
}
