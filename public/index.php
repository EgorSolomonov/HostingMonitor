<?php
// Подключение автозагрузки Composer
require_once __DIR__ . '/../vendor/autoload.php';

use HostingMonitor\Domain\Server;
use HostingMonitor\Application\HostingMonitor;
use HostingMonitor\Infrastructure\Notifier\ConsoleNotifier;
use HostingMonitor\Infrastructure\Repository\ArrayServerRepository;


$HM = new HostingMonitor(
    new ConsoleNotifier(),
    new ArrayServerRepository(
        [
            new Server(1, 'adminvps.ru', new DateTime('2026-01-01'), 1536870912, 536870912),
            new Server(2, 'reg.ru', new DateTime('2026-04-11'), 1536870912, 536870912)
        ]
    )
);

$HM->checkAllServers();



// $server = new Server(
//     1,
//     'adminvps',
//     new DateTime('2026-04-01'),
//     1536870912,   // 1 ГБ всего
//     5368709121   // 0.5 ГБ использовано
// );

// $serverMem = $server->isDiskUsageHigh();

// var_dump($serverMem);