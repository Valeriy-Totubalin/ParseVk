<?php

/**
 * Режим строгой типизации
 */
declare(strict_types = 1);
/**
 * Установка внутренней кодировки в UTF-8
 */
mb_internal_encoding("UTF-8");

require_once 'vendor/autoload.php';

use App\Controllers\ParserController;

$parser = new ParserController('https://vk.com/animalpic');
$parser->parseVkGroup();
