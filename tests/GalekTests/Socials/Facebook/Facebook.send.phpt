<?php

require_once __DIR__ . '/FacebookTestCase.php';

use Galek\Socials\Facebook\Facebook;
use Galek\Socials\Facebook\SendFactory;
use Galek\Socials\Facebook\Send;
use Tester\Assert;

class FacebookSendTest extends FacebookTestCase{
    
    private $container;
    /** @var Comments */
    public $control;
    
    function __construct(Nette\DI\Container $container){
        $this->container = $container;
    }
    protected function setUp(){
	$this->facebook = new SendFactory(self::TEST_API);
        $this->control = $this->renderComponent($this->container,  $this->facebook);
    }

    public function testRenderDefault(){
        ob_start();
        $this->control->render();
        $output = ob_get_clean();
        $file = __DIR__.'/src/default/send/default.latte';
        Assert::matchFile($file, $output);
    }
}

$testCase = new FacebookSendTest($container);
$testCase->run();