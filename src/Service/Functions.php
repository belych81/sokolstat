<?php
namespace App\Service;

class Functions
{
  public function truncateText($text, $max) {
      $length = strlen($text);
      $truncateText = ($length > $max ? substr($text, 0, strpos($text, '. ', $max)).'...' : $text);
      return $truncateText;
  }
}
