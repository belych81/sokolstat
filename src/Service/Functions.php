<?php
namespace App\Service;

class Functions
{
  public function truncateText($text, $max) {
      $length = \strlen($text);
      $truncateText = ($length > $max ? substr($text, 0, strpos($text, ' ', $max)).'...' : $text);
      return $truncateText;
  }

  public function getParamUrl($param, $url){
      $paramsUrl = [];
      $urlComponents = parse_url($url);

      if (\array_key_exists('query', $urlComponents)) {
          parse_str(($urlComponents['query'] ?? ''), $paramsUrl);
          if(\array_key_exists($param, $paramsUrl)) {
            return $paramsUrl[$param];
          }
      }
      return false;
  }

}
