<?php
declare(strict_types=1);

include_once('../interfaces/NotifierInterface.php');
include_once('../index.php');

/**
 * Класс ConsoleNotifier выполняет контракт по выводу предупреждений от NotifierInterface
 * 
 * @package HostingMonitor        ← Название проекта/модуля
 * @subpackage Notifiers          ← Подгруппа внутри пакета
 * @author EgorSolomonov
 */
class ConsoleNotifier implements NotifierInterface
{
    public function notify(Server $server, string $message): bool
    {
        echo "[WARNING] {$server->getName()}: истекает через {$server->getDaysUntilExpiration()} дня!";
        
        return true;
    }
}

$server = new Server(
    1,
    'adminvps',
    new DateTime('2026-04-01')
);

$serverNotifie = new ConsoleNotifier();

$serverNotifie->notify($server,"TEST");

var_dump($serverNotifie);