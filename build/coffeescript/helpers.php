<?php

namespace CoffeeScript;

function compact(array $array)
{
  $compacted = array();

  foreach ($array as $k => $v)
  {
    if ($v)
    {
      $compacted[] = $v;
    }
  }

  return $compacted;
}

function del( & $obj, $key)
{
  $val = NULL;

  if (isset($obj[$key]))
  {
    $val = $obj[$key];
    unset($obj[$key]);
  }

  return $val;
}

function flatten(array $array)
{
  $flattened = array();

  foreach ($array as $k => $v)
  {
    if (is_array($v))
    {
      $flattened = array_merge($flattened, flatten($v));
    }
    else
    {
      $flattened[] = $v;
    }
  }

  return $flattened;
}

function last($array, $back = 0)
{
  $i = count($array) - $back - 1;

  return isset($array[$i]) ? $array[$i] : NULL;
}

/**
 * In Jison, token types (tags) are represented simply using strings, whereas
 * with ParserGenerator (a port of Lemon) we're stuck with using numeric
 * constants for each type.
 *
 * This function maps those string representations to their numeric constants,
 * making it easier to port directly from the CoffeeScript source.
 */
function t($name)
{
  static $map = array(
    '.'   => 'ACCESSOR',
    '&'   => 'AMPERSAND',
    '['   => 'ARRAY_START',
    ']'   => 'ARRAY_END',
    ':'   => 'COLON',
    '?.'  => 'EXISTENTIAL_ACCESSOR',
    '('   => 'PAREN_START',
    ')'   => 'PAREN_END',
    '::'  => 'PROTOTYPE'
  );

  if (func_num_args() > 1)
  {
    $name = func_get_args();
  }

  if ((func_num_args() > 1 && $name = func_get_args()) || is_array($name))
  {
    $tags = array();

    foreach ($name as $v)
    {
      $tags[] = t($v);
    }

    return $tags;
  }

  $name = 'Parser::YY_'.(isset($map[$name]) ? $map[$name] : $name);

  return defined($name) ? constant($name) : NULL;
}

?>