<?php

// lade composer autoloader (nur hier in index.php notwendig):
require_once __DIR__ . '/../vendor/autoload.php';

// setze Output-Type auf Plaintext, für debugging-Ausgabe:
header('Content-Type: text/plain');

// extrahiere URL-Route:
$path_info = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/';
echo "requested route: {$path_info}\n";
echo "requested params: " . print_r($_REQUEST, true) . "\n";

// Teste Auto-Loading (siehe composer.json):
// Auto-Laden von Klasse "Test" im Namespace "M151" (Verzeichnis src/):
$test = new M151\Test();
$test->hello();
