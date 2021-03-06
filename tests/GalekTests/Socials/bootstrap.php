<?php

// The Nette Tester command-line runner can be
// invoked through the command: ../vendor/bin/tester .

if (@!include __DIR__ . '/../../../vendor/autoload.php') {
	echo 'Install Nette Tester using `composer install`';
	exit(1);
}

// configure environment
Tester\Environment::setup();
date_default_timezone_set('Europe/Prague');


// output buffer level check

register_shutdown_function(function ($level) {
	Tester\Assert::same($level, ob_get_level());
}, ob_get_level());
/*

function test(\Closure $function)
{
	$function();
}

*/


$configurator = new Nette\Configurator;
$configurator->setDebugMode(FALSE);
$configurator->setTempDirectory(__DIR__ . '/../temp');
$configurator->createRobotLoader()
	->addDirectory(__DIR__ . '/../app')
	->register();
$configurator->addConfig(__DIR__ . '/../app/config/config.neon');
//$configurator->addConfig(__DIR__ . '/../app/config/config.local.neon');
return $configurator->createContainer();
