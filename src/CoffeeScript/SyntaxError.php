<?php

namespace CoffeeScript;

if (! class_exists('CoffeeScript\Init')) {
    throw new \RuntimeException('The class Init not found');
}

class SyntaxError extends Error {}

?>
