<?php

use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\WebDriverBy;

class OcorrenciaFaceTest extends PHPUnit_Framework_TestCase
{
	/**
     * @var RemoteWebDriver
     */
    protected $webDriver;
    
    protected $url;

	public function setUp()
	{
		$this->url = 'http://local.sis21/cradf/site/';
		$host = 'http://localhost:4444/wd/hub';
		$driver = DesiredCapabilities::firefox();
	    $this->webDriver = RemoteWebDriver::create($host, $driver);
	}

	public function tearDown()
	{
		if ($this->webDriver) {
			$this->webDriver->quit();
		}	
	}
	
    public function testOther()
    {
    	$this->webDriver->get($this->url);
    	
    	$this->webDriver->wait(10, 300)->until(function ($webDriver) {
    		try {
    			$webDriver->findElement(WebDriverBy::cssSelector('div.login-logo'));
    			return true;
    		} catch(NoSuchElementException $ex) {
    			return false;
    		}
    	});
    		 
		$this->webDriver->findElement(WebDriverBy::name('login'))->sendKeys('cradf');
		$this->webDriver->findElement(WebDriverBy::name('senha'))->sendKeys('p21&show');
		$this->webDriver->findElement(WebDriverBy::name('confirmar'))->click();
    		
		$this->webDriver->wait(10, 300)->until(function ($webDriver) {
			try {
				$webDriver->findElement(WebDriverBy::cssSelector('div.logo-default'));
				return true;
			} catch(NoSuchElementException $ex) {
				return false;
			}
		});
    	
		$this->webDriver->get($this->url . 'admin.php?acao=Qjc2RTI4RDlPOjEwOiJTaXMyMV9BY2FvIjo5OntzOjE1OiIAKgBwcm9wcmllZGFkZXMiO086MTA6IkxpYjIxQXJyYXkiOjE6e3M6MTc6IgBMaWIyMUFycmF5AGFycmF5IjthOjM6e3M6MTQ6ImNsYXNzZUNvbnRyb2xlIjtzOjI0OiJDcmFMaXN0YUNvZGlnb09jb3JyZW5jaWEiO3M6OToiY2xhc3NlUGFpIjtzOjE4OiJDcmFNZW51Q3JhQ2FkYXN0cm8iO3M6MTA6InRpcG9GdW5jYW8iO2k6Mjt9fXM6OToiACoAY29kaWdvIjtOO3M6MTA6IgAqAGFjYW9QYWkiO047czoxMToiACoAbWVuc2FnZW0iO047czoxNToiACoAbWVuc2FnZW1FcnJvIjtOO3M6OToiACoAdGl0dWxvIjtzOjEyOiJPY29ycsOqbmNpYXMiO3M6MjQ6IgAqAGNhbWluaG9SZWxhdGl2b0ltYWdlbSI7TjtzOjE1OiIAKgBhY2Vzc29OZWdhZG8iO2I6MDtzOjc6IgAqAGxpbmsiO047fQ%3D%3D');

		$this->webDriver->wait(10, 300)->until(function ($webDriver) {
			try {
				$webDriver->findElement(WebDriverBy::cssSelector('div.page-title'));
				return true;
			} catch(NoSuchElementException $ex) {
				return false;
			}
		});
    	
		$this->webDriver->findElement(WebDriverBy::cssSelector('a[data-id="18"][data-original-title="Alterar"]'))->click();
    	
		$this->webDriver->wait(10, 300)->until(function ($webDriver) {
			try {
				$webDriver->findElement(WebDriverBy::name('confirmar'));
				return true;
			} catch(NoSuchElementException $ex) {
				return false;
			}
		});
			
		$this->webDriver->findElement(WebDriverBy::cssSelector('input#operacaoManual[value="1"]'))->click();
		$this->webDriver->findElement(WebDriverBy::cssSelector('input#cobrarCustas[value="1"]'))->click();
		$this->webDriver->findElement(WebDriverBy::name('labelCustas'))->sendKeys('Label Show face');
		$this->webDriver->findElement(WebDriverBy::name('confirmar'))->click();
    }
}