<?php

declare(strict_types=1);

namespace Garbuzivan\A3F\Test;

use Garbuzivan\A3F\Service;
use PHPUnit\Framework\TestCase;

class UrlResourceTest extends TestCase
{
    /**
     * Допустим успешный тест это не пустой dom объект
     * В реальных тестах, особенно API проверяем всегда критическую структуру и целостность данных
     *
     * @group Service
     */
    public function testService()
    {
        $service = new Service;
        $dom = $service->parser('https://habrahabr.ru/');
        $this->assertTrue(is_object($dom));
    }

    /**
     * Непосредственно пример
     * Из нашего объекта мы просто циклом считаем задачу и т.д.
     *
     * @group Service
     */
    public function testCountTags()
    {
        $service = new Service;
        $dom = $service->parser('https://habrahabr.ru/');
        $data = [];
        foreach ($dom as $tag) {
            $countTag = $data[$tag] ?? 0;
            $data[$tag] = $countTag + 1;
        }
        // Просто отправим список тегов в ключах и коллиество того, сколько встретился тэг в документе - в значении
        var_dump($data);
        $this->assertTrue(count($data) > 0);
    }
}
