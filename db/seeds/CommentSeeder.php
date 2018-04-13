<?php


use Phinx\Seed\AbstractSeed;

class CommentSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'post_id' => '2',
                'contents' => 'This is just a normal comment! Nothing to see here',
                'post_date' => date('Y-m-d H:i:s', time())
            ],
            [
                'post_id' => '1',
                'contents' => "How 'bout dem memes?<br/><img src=\"/challenge3/img/dancing-spiderman.gif\">",
                'post_date' => date('Y-m-d H:i:s', time())
            ],
            [
                'post_id' => '1',
                'contents' => 'Check this out!<br/><img src="/challenge3/img/iron-man.gif"/>',
                'post_date' => date('Y-m-d H:i:s', time())
            ]
        ];
        $table = $this->table('comments');
        $table->insert($data)
            ->save();
    }
}
