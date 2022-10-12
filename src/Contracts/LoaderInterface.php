<?php

namespace Garbuzivan\A3F\Contracts;

interface LoaderInterface
{
    /**
     * Метод загрузки данных по ссылке
     *
     * @param string $source - источник загрузки данных
     *
     * @return void
     */
    public function load(string $source): void;

    /**
     * Метод для возврата данных
     *
     * @return string
     */
    public function __toString(): string;
}