<?php

require_once('inc.php');
header('Content-Type: text/plain');
if (file_exists('key.php'))
{
    $key = require('key.php');
    if ($key['current'] === $_SERVER['QUERY_STRING'])
    {
        $submodule = getcwd();
        $project = $submodule.'/../../../';
        chdir(dirname($project));
        _exec('pwd');
        _exec('git pull');
        _exec('git submodule update');
		_exec('php yiic migrate --interactive=0');
		_exec('chmod -R 0777 assets');
		_exec('rm -rf assets');
		_exec('mkdir assets');
		_exec('chmod -R 0777 assets');
    }
}

_log(var_export($_POST, true));