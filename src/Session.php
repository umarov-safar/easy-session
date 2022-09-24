<?php

namespace Easy\EasySession;

use Easy\EasySession\SessionInterface;

class Session implements SessionInterface
{
    private bool $isStarted = false;

    public function isStarted(): bool
    {
        $this->isStarted = session_status() === PHP_SESSION_ACTIVE;

        return $this->isStarted;
    }

    public function start(): bool
    {
        if ($this->isStarted) {
            return true;
        }

        if (session_status() === PHP_SESSION_ACTIVE) {
            $this->isStarted = true;

            return true;
        }

        session_start();
        $this->isStarted = true;

        return $this->isStarted;
    }


    public function has(string $key): bool
    {
        return array_key_exists($key, $_SESSION);
    }

    public function get(string $key, mixed $difault = null): mixed
    {
        if ($this->has($key)) {
            return $_SESSION[$key];
        }

        return $difault;
    }

    public function set(string $key, mixed $values)
    {
        $_SESSION[$key] = $values;
    }

    public function clear(): void
    {
        session_unset();
    }

    public function remove(string $key): void
    {
        if ($this->has($key)) {
            unset($_SESSION[$key]);
        }
    }

    public function getId(): string
    {
        return session_id();
    }

    public function all(): array
    {
        return $_SESSION;
    }

    public function setFromExistingKey($newKey, $fromKey): bool
    {
        if($this->has($fromKey)) {
            $_SESSION[$newKey] = $_SESSION[$fromKey];

            return true;
        }

        return false;
    }

    public function destroy(): void 
    {
        $this->clear();
        session_destroy();
    }

}
