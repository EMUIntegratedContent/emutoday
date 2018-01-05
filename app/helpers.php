<?php

/**
 * Helper fucntion to style active menu items
 * @param [type] $path   [description]
 * @param string $active [description]
 */
function set_active($path, $active = 'active', $complex = 0)
{
  if ($complex == 0) {
      return Request::is($path)? $active : '';
  } else {
    $complexpath = Request::segment(1) . '/' . Request::segment(2);
    return $path == $complexpath? $active : '';

  }

}

/**
 * Truncate a string after a certain number of characters, stopping at the last WHOLE WORD before the limit.
 * Then add '...' after that final whole word.
 * TUTORIAL: http://www.ambrosite.com/blog/truncate-long-titles-to-the-nearest-whole-word-using-php-strrpos
 *
 * @param string $text     The string to truncate
 * @param int $limit       Maximum length of string
 */
function truncateLimitWords($text, $limit){
  if(count($text) > $limit){
    $text = substr( $text, 0, strrpos( substr( $text, 0, $limit), ' ' ) );
    $text = $text . '...';

    return $text;
  }

  return $text;
}
