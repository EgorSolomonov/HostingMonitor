<?php
declare(strict_types=1);

namespace HostingMonitor\Infrastructure\Notifier;

use HostingMonitor\Domain\Server;

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
        echo "[WARNING] {$server->getName()}: {$message}";
        
        return true;
    }
}