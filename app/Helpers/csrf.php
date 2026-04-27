<?php

function csrf_token(): string
{
    if (!isset($_SESSION['_csrf'])) {
        $_SESSION['_csrf'] = bin2hex(random_bytes(32));
    }

    return $_SESSION['_csrf'];
}

function csrf_input(): string
{
    return '<input type="hidden" name="_csrf" value="' . csrf_token() . '">';
}

function csrf_verify(?string $token): bool
{
    if (!$token || !isset($_SESSION['_csrf'])) {
        return false;
    }

    $valid = hash_equals($_SESSION['_csrf'], $token);
    unset($_SESSION['_csrf']);
    return $valid;
}
