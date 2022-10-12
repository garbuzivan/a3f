<?php

declare(strict_types=1);

namespace Garbuzivan\A3F\Test\Loaders;

use Garbuzivan\A3F\Contracts\LoaderInterface;
use Garbuzivan\A3F\Loaders\LoadUrlFailException;
use Garbuzivan\A3F\Loaders\UrlResource;
use PHPUnit\Framework\TestCase;

class UrlResourceTest extends TestCase
{
    /**
     * Проверка на успешность загрузки данных по ссылке
     *
     * @throws LoadUrlFailException
     *
     * @group Loaders
     */
    public function testLoadTrue()
    {
        $loader = new UrlResource;
        $loader->load('https://habrahabr.ru/');
        // Если длина html больше 0 символов, будем считать что все прошло успешно
        // В реальности мы бы проверяли http статус и другие важные для нас аспекты
        // (string)$loader - такое извращенство исключительно для демострации использования магических методов)))
        $this->assertTrue(mb_strlen((string)$loader) > 0);
    }

    /**
     * Проверка на фейл при загрузке несуществующего адреса
     *
     * @group Loaders
     */
    public function testLoadFalse()
    {
        $loader = new UrlResource;
        try {
            $loader->load('https://habrahabrhabrahabr.ru/');
        }
        catch (LoadUrlFailException $e) {
            // Наш адрес не существует, исключение выскочит НЕ на проверку возврата методов false вместо строки
            $this->assertTrue(false);
        }
        catch (\Exception $e) {
            // Наш адрес не существует, будет исключение по php_network_getaddresses
            $this->assertTrue(true);
        }
        // Сделаем проверку на реализацию интерфейса нашего лодера
        $this->assertInstanceOf(LoaderInterface::class, $loader);
    }
}
