<?php

require_once __DIR__ . '/GoogleCase.php';

use Galek\Socials\Google\Google;
use Galek\Socials\Google\ShareFactory;
use Tester\Assert;

class GooglePlusTest extends GoogleCase{
    
    private $container;
    /** @var Share */
    public $control;
    
    function __construct(Nette\DI\Container $container){
        $this->container = $container;
    }
    protected function setUp(){
	$this->facebook = new ShareFactory();
        $this->control = $this->renderComponent($this->container,  $this->facebook);
    }

    public function testRenderDefault(){
        ob_start();
        $this->control->render();
        $output = ob_get_clean();
        $file = __DIR__.'/src/default/plus/share.latte';
        Assert::matchFile($file, $output);
    }
}

$testCase = new GooglePlusTest($container);
$testCase->run();