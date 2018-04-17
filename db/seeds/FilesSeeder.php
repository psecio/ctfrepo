<?php


use Phinx\Seed\AbstractSeed;

class FilesSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [];
        $secret = '3l33th4x0r';

        $data = [
            [
                'name' => '',
                'content' => 'Nunc pulvinar elementum consectetur. Suspendisse vel hendrerit lorem. Curabitur mollis sodales orci, ac rhoncus nisl pellentesque id. Nullam hendrerit rutrum iaculis. Quisque interdum purus non maximus tempus.',
                'title' => 'Test Doc #1',
                'size' => '65',
                'hide' => '0'
            ],
            [
                'name' => '',
                'content' => 'You found the flag - congratulations l33t h4x0r!',
                'title' => 'Warning: Security Issue Detected',
                'size' => '0',
                'hide' => '1'
            ],
            [
                'name' => '',
                'content' => 'Aliquam vitae eros sed arcu varius luctus ut eget ex. Phasellus placerat, nunc a feugiat tincidunt, ex orci ultricies enim, a fermentum urna lacus et tellus.',
                'title' => 'My Next Message',
                'size' => '312',
                'hide' => '0'
            ],
            [
                'name' => '',
                'content' => 'Etiam mattis ullamcorper lectus, sit amet eleifend magna ultrices ut. Quisque sit amet porta metus. In consectetur dapibus sem, nec mattis ipsum venenatis sed.',
                'title' => 'New Message',
                'size' => '34',
                'hide' => '0'
            ],
            [
                'name' => '',
                'content' => 'Sed facilisis ultricies lorem, eu lacinia ex maximus id. Pellentesque mi turpis, varius vitae sapien vitae, mattis porttitor leo. Nunc luctus, nibh at viverra convallis, ligula velit viverra mi, finibus vestibulum eros turpis vitae lacus.',
                'title' => 'Foobarbaz Allthethings',
                'size' => '77',
                'hide' => '0'
            ]
        ];


        // print_r($data);

        $table = $this->table('files');
        $table->insert($data)
            ->save();
    }
}
