<?php

require __DIR__ . '/../src/Whois/Whois.php';
require __DIR__ . '/../vendor/autoload.php';

if (!class_exists('Tester\Assert')) {
  echo "Install Nette Tester using `composer update --dev`\n";
  exit(1);
}

\Tester\Environment::setup();
