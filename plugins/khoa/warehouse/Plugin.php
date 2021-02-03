<?php namespace Khoa\Warehouse;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
    }

    public function registerSettings()
    {
    }

    public function registerMarkupTags()
    {
        return [
            'functions' => [
                'jsonDecode' => function ($json) {
                    return json_decode($json, true);
                },
            ]
        ];
    }
}
