<?php

class TemplateView extends \Slim\Views\Twig
{
    public function write($view, array $data = [])
    {
        $container = $this['container'];
        $response = $container->response;

        $data['challenges'] = [];
        $dir = new DirectoryIterator(dirname(__FILE__).'/../public');
        foreach ($dir as $fileinfo) {
            if (!$fileinfo->isDot()) {
                $filename = $fileinfo->getFilename();
                if (preg_match('/challenge([0-9]+)/', $filename, $match)) {
                    $data['challenges'][] = [
                        'link' => $filename,
                        'name' => 'Challenge '.$match[1],
                        'id' => $match[1]
                    ];
                }
            }
        }

        // Sort them
        usort($data['challenges'], function($value1, $value2) {
            return $value1['id'] > $value2['id'];
        });

        return $this->render($response, $view, $data);
    }
}