<?php

namespace envloader;

use RuntimeException;
class EnvLoader
{
    private string $path;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    public function load(): void
    {
        if (!file_exists($this->path)) {
            throw new RuntimeException("Fichier .env introuvable: " . $this->path);
        }

        $lines = file($this->path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            $line = trim($line);
            if ($line === '' || str_starts_with($line, '#'))
                continue;
            if (strpos($line, '=') === false)
                continue;

            list($key, $value) = explode('=', $line, 2);

            $key = trim($key);
            $value = trim($value);

            if (
                (str_starts_with($value, '"') && str_ends_with($value, '"')) ||
                (str_starts_with($value, "'") && str_ends_with($value, "'"))
            ) {
                $value = substr($value, 1, -1);
            }

            putenv("$key=$value");
            $_ENV[$key] = $value;
            $_SERVER[$key] = $value;
        }
    }

    public function get(string $key): ?string
    {
        return getenv($key) ?: null;
    }
}