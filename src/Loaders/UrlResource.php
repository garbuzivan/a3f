<?php

declare(strict_types=1);

namespace Garbuzivan\A3F\Loaders;

use Exception;
use Garbuzivan\A3F\Contracts\LoaderInterface;

/**
 * Допустим у нас может быть реализовано огромное множество
 */
class UrlResource implements LoaderInterface
{
    protected string $html;

    /**
     * Метод загрузки данных по ссылке
     *
     * @param string $url - ссылка для загрузки данных
     *
     * @return void
     * @throws LoadUrlFailException
     */
    public function load(string $url): void
    {
        // Можно заменить на красивую реализацию например через CURL но это ведб просто демонстрация
        $this->html = file_get_contents($url);
        if (!$this->html) {
            // Допустим тут у нас обработка ошибки, логирование и тд и тп
            throw new LoadUrlFailException('Ошибка загрузки данных');
        }
    }

    /**
     * Метод для возврата данных
     *
     * @return string
     * @throws Exception
     */
    public function __toString(): string
    {
        if (!$this->html) {
            // Можно было конечно в рамках этой демонстрации закинуть все в один публичны метод, но мы помним,
            // что в полноценной реализации могут быть свои фишечки и т.д.
            // Поэтому для демонстрации решил вызвать магический метод с проверкой
            // В реадьной жизни у нас может быть метод например для проверки типа ресурса
            // (особенно если string заменить на mixed) передаваемого в load
            // Тогда мы можем в основной класс передавать ресурс и через например пайплайны список возможных методов,
            // а отработает нужный loader
            throw new Exception('Данные небыли загружены');
        }
        return $this->html;
    }
}