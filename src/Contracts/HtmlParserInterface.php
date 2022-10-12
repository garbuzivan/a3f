<?php

namespace Garbuzivan\A3F\Contracts;

interface HtmlParserInterface
{
    /**
     * Метод загрузки данных по ссылке
     *
     * @return object
     */
    public function getDom(): object;

    /**
     * Метод для чтения строки для преобразования в DOM
     *
     * @param string $html
     *
     * @return string
     */
    public function read(string $html);
}