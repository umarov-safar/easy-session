<?php

namespace Easy\EasySession;

interface SessionInterface
{
    public function has(string $key): bool;

    public function getId(): string;

    public function all(): array;

    public function get(string $key): mixed;

    public function set(string $key, mixed $value);

    public function clear(): void;

    public function remove(string $key): mixed;

    public function setFromExistingKey($newKey, $fromKey): bool;

    public function destroy(): void;

    public function isEmpty(): bool;
}
