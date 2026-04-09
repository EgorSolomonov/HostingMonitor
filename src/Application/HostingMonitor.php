<?php
declare(strict_types=1);

namespace HostingMonitor\Application;

use HostingMonitor\Domain\Server;
use HostingMonitor\Infrastructure\Notifier\NotifierInterface;
use HostingMonitor\Infrastructure\Repository\ServerRepositoryInterface;

/**
 * Класс HostingMonitor, связывает NotifierInterface и ServerRepositoryInterface для проверки и показа информации о серверах
 * 
 * @package HostingMonitor
 * @author EgorSolomonov
 */
class HostingMonitor {
    /**
     * Контракт на использование функций NotifierInterface
     * 
     * @var NotifierInterface
     */
    private NotifierInterface $notifier;  // имя переменной не должно быть привязано к конкретному исполнителю, он может меняться

    /**
     * Контракт на использование функций ServerRepositoryInterface
     * 
     * @var ServerRepositoryInterface
     */
    private ServerRepositoryInterface $serverRepository;

    public function __construct(NotifierInterface $notifier, ServerRepositoryInterface $serverRepository){
        $this->notifier = $notifier;
        $this->serverRepository = $serverRepository;
    }

    /**
     * Проверка всех серверов и показ уведомлений, в зависимости от состояния, для каждого
     * 
     * @return void
     */
    public function checkAllServers(): void {
        $allServers = $this->serverRepository->findAll();
        
        foreach ($allServers as $key => $server) {
            $message = [];
            if ($server->isExpired()){
                $message[] = "❌ СЕРВЕР ПРОСРОЧЕН";
            }else if ($server->willExpireSoon()) {
                $message[] = "⚠️ Истекает в течение недели";
            }else if ($server->willNotExpireSoon()) {
                $message[] = "Все в порядке, сервер работает!";
            }
            
            if ($server->isDiskUsageHigh()) {
                $message[] = "Диск заполнен на {$server->getDiskUsagePercent()}%";
            }

            $this->notifier->notify($server, implode(' | ', $message) . ' <br>');
        }
    }
}