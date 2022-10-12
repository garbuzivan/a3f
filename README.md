# A3F - идея

В качестве примера мы решаем задачу по чтению по ссылке HTML контента. 
В результате должны вернуть наименование тегов и сколько раз они встречаются в коде.

## Примечание

В нашей задаче мы можем выделить два момента. 
Первый - у нас могут быть различные источники со временем.
Второй - обработчики и парсинг может быть тоже иной. 

Иными они могут быть опционально, т.е. для одного узла один набор обработчиков, а для другого другой. 
Поэтому мы следуем принципу единой ответственности из SOLID и наши классы отвечают только за одну задачу. 
Так-же мы стараемся избегать лишних зависимостей, что позволяет нам переиспользовать код в последующем. 

За счет контрактов, мы обязуем любые новые обработчики следовать набору правил и избегать ошибок.

Реализация через сервис, открывает нам возможность изолированно использовать код в бизнес задачах, 
при этом мы можем в нужный момент подменить реализацию. В данном примере не отображено, 
но как правило мы можем воспользоваться принципом инверсии зависимостей (что нам диктует культура разработки под laravel)

## Запуск тестов

<pre>./vendor/bin/phpunit</pre>

## Ответ на задчу реализован в тесте tests/ServiceTest.php

<pre>./vendor/bin/phpunit --group=Service</pre>
