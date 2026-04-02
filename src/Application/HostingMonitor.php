<?php
declare(strict_types=1);

include_once("../interfaces/NotifierInterface.php");
include_once("../interfaces/ServerRepositoryInterface.php");
include_once("../notifiers/ConsoleNotifier.php");
include_once("../repositories/ArrayServerRepository.php");
include_once('../classes/Server.php');

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