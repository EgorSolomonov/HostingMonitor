<?php
declare(strict_types=1);

namespace HostingMonitor\Infrastructure\Repository;

use HostingMonitor\Domain\Server;

/**
 * Класс ArrayServerRepository выполняет контракт по сохранению,обновлению и выводу инфы о сервере от ServerRepositoryInterface
 * 
 * @package HostingMonitor        ← Название проекта/модуля
 * @subpackage Notifiers          ← Подгруппа внутри пакета
 * @author EgorSolomonov
 */
class ArrayServerRepository implements ServerRepositoryInterface
{
    /**
     * Хранилище серверов в памяти
     * 
     * @var Server[]  //  так пишется для понимания что внутри массива, чтобы и IDE и человек понял что внурти может быть только объект типа Server
     */
    private array $servers = [];

    public function __construct(array $servers){
        $this->servers = $servers;
    }

    /**
     * Поиск сервера по его id
     * 
     * @param int $id,
     * @return ?Server
     */
    public function findById(int $id): ?Server {
        foreach ($this->servers as $server) {
            if($server->getId() === $id) {
                return $server;
            }
        }

        return null;
    }

    /**
     * Поиск всех серверов сразу
     * 
     * @return array
     */
    public function findAll(): array {
        return $this->servers;
    }

    /**
     * Поиск всех серверов сразу
     * 
     * @param Server $server
     * @return void
     */
    public function save(Server $server): void {
        foreach ($this->servers as $key => $value) {
            if($value->getId() === $server->getId()) {
                $this->servers[$key] = $server; // перезаписываем
                return;
            }
        }

            $this->servers[] = $server; // добавляем новый
    }
}