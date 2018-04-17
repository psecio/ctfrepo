<?php


use Phinx\Migration\AbstractMigration;

class CreateFilesTable extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('files');
        $table->addColumn('name', 'string')
            ->addColumn('content', 'string')
            ->addColumn('title', 'string')
            ->addColumn('size', 'string')
            ->addcolumn('hide', 'string')
            ->save();
    }
}
