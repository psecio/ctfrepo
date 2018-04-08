<?php


use Phinx\Seed\AbstractSeed;

class PostSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'title' => 'Test Post #1',
                'contents' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ultrices sed nunc a ullamcorper. Quisque sit amet ante ex. Pellentesque efficitur congue molestie. Quisque eget ex elit. Donec quam sapien, lobortis sed ipsum non, fermentum rhoncus mi. Ut orci nunc, viverra at scelerisque et, faucibus at sapien. Sed ut venenatis massa. Ut vestibulum scelerisque magna, nec aliquet ex iaculis vitae. Etiam id vestibulum sem. Vestibulum congue, nisi vitae volutpat mattis, neque eros fringilla augue, vitae scelerisque nisl eros sed mauris. Nullam elementum pretium nunc, vel lacinia libero hendrerit accumsan. Praesent suscipit ante vel felis cursus imperdiet nec aliquam erat. Nulla facilisi.',
                'post_date' => date('Y-m-d H:i:s', time())
            ],
            [
                'title' => 'Test Post #2',
                'contents' => 'Quisque leo ex, faucibus sit amet lacus at, malesuada imperdiet lacus. Interdum et malesuada fames ac ante ipsum primis in faucibus. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aliquam rutrum justo ac molestie molestie. Aenean interdum augue non arcu gravida, ac maximus purus porttitor. Vestibulum augue tellus, suscipit nec fermentum in, ornare vel arcu. Praesent sit amet consectetur risus. In et risus quis turpis hendrerit condimentum id id elit. Praesent non mi et ligula maximus vehicula ut eget nulla. Aenean eu rutrum nulla. Pellentesque fringilla odio est, eu convallis nisi accumsan a. Nunc nec enim augue. Curabitur bibendum molestie bibendum.',
                'post_date' => date('Y-m-d H:i:s', time())
            ],
            [
                'title' => 'Test Post #2',
                'contents' => 'Phasellus hendrerit vel velit at ornare. Cras in nunc nec quam cursus blandit non eu enim. Nullam lacinia nunc dolor, nec efficitur augue tristique vel. Fusce vulputate auctor ullamcorper. Vivamus eget risus quis enim bibendum molestie. Fusce sagittis dapibus nibh, eget mattis tellus pulvinar at. Morbi pretium facilisis dolor, in ultrices orci. Ut at massa tincidunt, maximus diam quis, luctus metus. Donec efficitur orci vulputate rhoncus sollicitudin. Vivamus in diam vitae lorem cursus maximus a id libero. Suspendisse commodo dignissim ligula non consequat. Maecenas quis tempor ligula, eu egestas enim.',
                'post_date' => date('Y-m-d H:i:s', time())
            ],
        ];
        $table = $this->table('posts');
        $table->insert($data)
            ->save();
    }
}
