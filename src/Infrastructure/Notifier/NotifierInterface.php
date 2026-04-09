<?php

namespace HostingMonitor\Infrastructure\Notifier;

use HostingMonitor\Domain\Server;

/**
 * Интерфейс для отправки уведомлений о серверах
 */
interface NotifierInterface
{
    /**
     * Отправить уведомление о сервере
     * 
     * @param Server $server Сервер, о котором уведомляем
     * @param string $message Текст сообщения
     * @return bool Успешно ли отправлено
     */
    public function notify(Server $server, string $message): bool;
}