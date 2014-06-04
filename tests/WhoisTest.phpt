<?php

require __DIR__ . '/bootstrap.php';

use Whois\Whois;
use Tester\Assert;
use Tester\TestCase;

class WhoisTestCase extends TestCase
{
  /** @var Whois\Whois */
  private $whois;


  protected function setUp()
  {
    $this->whois = new Whois;
  }


  public function testValidateDomain()
  {
    Assert::exception(function() {
      $this->whois->getInfo(null);
    }, 'Whois\InvalidArgumentException');

    Assert::exception(function() {
      $this->whois->getInfo(0);
    }, 'Whois\InvalidArgumentException');

    Assert::exception(function() {
      $this->whois->getInfo('www.google.com');
    }, 'Whois\InvalidArgumentException');

    Assert::exception(function() {
      $this->whois->getInfo('http://www.google.com');
    }, 'Whois\InvalidArgumentException');
  }


  public function testGetInfo()
  {
    $info = $this->whois->getInfo('google.com');

    Assert::type('array', $info);

    Assert::same('google.com', $info['Domain Name']);
  }
}

$testCase = new WhoisTestCase;
$testCase->run();