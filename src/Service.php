<?php

declare(strict_types=1);

namespace Garbuzivan\A3F;

use Garbuzivan\A3F\Contracts\HtmlParserInterface;
use Garbuzivan\A3F\Contracts\LoaderInterface;
use Garbuzivan\A3F\Loaders\UrlResource;
use Garbuzivan\A3F\Parsers\HtmlFirstParser;

/**
 * Предположим мы пишем некий сервис для парсинга данных html, где мы можем создать ряд опций и т.д.
 * Мне нравится подход написания изолированных сервисов, которые при необходимости можно расширять
 * В тот-же момент это позволяет менять всю реализацию не затрагивая код продукта
 */
class Service
{
    protected LoaderInterface $loader;
    protected HtmlParserInterface $parser;

    /**
     *
     */
    public function __construct()
    {
        // Допустим взяли дефолтные обработчики из конфига
        $this->loader = new UrlResource;
        $this->parser = new HtmlFirstParser;
    }

    /**
     * Метод для замены класса загрузчика
     *
     * @param string $class
     *
     * @return $this
     */
    public function setLoader(string $class): self
    {
        $this->loader = new $class;
        return $this;
    }

    /**
     * Метод для замены класса обработчика
     *
     * @param string $class
     *
     * @return $this
     */
    public function setParser(string $class): self
    {
        $this->parser = new $class;
        return $this;
    }

    /**
     * Основной метод задачи
     *
     * @param mixed $resource - ресурс для загрузки данных, предположим, что всегда это строка
     *                        (файлы, ссылки, ссылки на классы)
     *
     * @return object
     */
    public function parser(string $resource): object
    {
        try {
            $this->loader->load($resource);
        }
        catch (\Exception $e) {
            // Допустим
            // Log::error()
            // dd($e);
        }
        // В реальном проекте мы бы никогда не делали преобразование, а
        if (!$this->loader) {
            // `Не будем создавать исключение, вернем пустой объект, если что-то при загрузке источника пошло неправильно
            // В реальных проектах все намного сложнее, чаще всего операции уходят в очереди, чтоб имело место быть попыткам и тд
            // Сценариев может быть много, исходим из задач бизнеса и критичности узла
            return (object)[];
        }
        $this->parser->read((string)$this->loader);
        return $this->parser->getDom();
    }
}
