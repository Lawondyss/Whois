<?php
/**
 * Class Whois
 * @package Whois
 * @author Ladislav Vondráček
 */

namespace Whois;

class Whois
{
  /** @var string */
  private $apiUrl = 'http://api.sudostuff.com/whois/';


  /**
   * @param string $domain
   * @return array
   */
  public function getInfo($domain)
  {
    $this->validateDomain($domain);

    $domain = strtolower($domain);

    $info = $this->request($domain);

    return $info;
  }


  /**
   * @param array $domain
   * @return array
   */
  private function request($domain)
  {
    $this->validateDomain($domain);

    $response = file_get_contents($this->apiUrl . $domain);

    $data = $this->parse($response);

    return $data;
  }


  /**
   * @param string $response
   * @return array
   * @throws ErrorException
   */
  private function parse($response)
  {
    $lines = explode("\n", $response);

    if (count($lines) == 1) {
      throw new ErrorException($lines[0]);
    }

    $data = array();
    foreach ($lines as $line) {
      if ($this->isUnnecessaryLine($line)) {
        continue;
      }

      list($key, $value) = explode(':', $line);
      $value = trim($value);

      $data[$key] = $value;
    }

    return $data;
  }


  /**
   * @param string $line
   * @return bool
   */
  private function isUnnecessaryLine($line)
  {
    $line = trim($line);

    if (
      strlen($line) == 0 ||
      !strstr($line, ':') ||
      substr($line, 0, 1) == '%' ||
      substr($line, 0, 3) == '>>>' ||
      substr($line, 0, 3) == 'URL' ||
      substr($line, 0, 4) == 'only' ||
      substr($line, 0, 5) == 'Visit'
    ) {
      return true;
    }
    return false;
  }


  /**
   * @param string $domain
   * @throws InvalidArgumentException
   */
  private function validateDomain($domain)
  {
    if (!isset($domain)) {
      throw new InvalidArgumentException('Set domain.');
    }
    elseif (!is_string($domain)) {
      throw new InvalidArgumentException('Domain must be string.');
    }
    elseif (!preg_match('~^[a-z-]+\.[a-z]{2,3}$~i', $domain)) {
      throw new InvalidArgumentException('Domain must be in format "domain.tld".');
    }
  }
}


class ErrorException extends \Exception{}

class InvalidArgumentException extends \Exception{}