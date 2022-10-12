<?php

declare(strict_types=1);

namespace Garbuzivan\A3F\Test\Parsers;

use Garbuzivan\A3F\Parsers\HtmlFirstParser;
use PHPUnit\Framework\TestCase;

class HtmlFirstParserTest extends TestCase
{
    /**
     * Допустим мы проверили некий html на факт работы
     *
     * @group Parsers
     */
    public function testParser()
    {
        $parser = new HtmlFirstParser;
        // Практика преобразования мне не нравится, но мы хотели сделать демонстрацию магического метода
        $parser->read('<body><div>Div test</div> other text</body>');
        $data = $parser->getDom();
        $this->assertTrue(is_object($data));
    }
}
