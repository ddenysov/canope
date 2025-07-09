<?php

require getcwd() . '/vendor/autoload.php';

use Zinc\Core\Worker\Roadrunner\Dispatcher;

$dispatcher = new Dispatcher(['base_dir' => getcwd()]);
$dispatcher->dispatch();
