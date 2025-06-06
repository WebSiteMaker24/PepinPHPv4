<?php

// Autoload.php

spl_autoload_register(function (string $class): void {
    // Base directory for the namespace prefix
    $baseDir = __DIR__ . '/src/';

    // Convert namespace to file path
    $file = $baseDir . str_replace('\\', '/', $class) . '.php';

    if (is_file($file)) {
        require_once $file;
    }
});