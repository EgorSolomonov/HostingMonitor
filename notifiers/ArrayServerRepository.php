<?php
declare(strict_types=1);

include_once('../interfaces/ServerRepositoryInterface.php');
include_once('../index.php');

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

    public function findById(int $id): ?Server {
        foreach ($this->servers as $server) {
            if($server->getId() === $id) {
                return $server;
            }
        }

        return null;
    }

    public function findAll(): array {
        return $this->servers;
    }

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

$serverArrayRepo = new ArrayServerRepository(
    [
        new Server(1, 'test', new DateTime('2026-01-01')),
        new Server(2, '2test2', new DateTime('2026-04-04')),
    ]
);

$get1 = $serverArrayRepo->findById(1);

$getAll = $serverArrayRepo->findAll();

// $serverArrayRepo->save(new Server(1, 'test_new', new DateTime('2026-12-01')));

echo "<pre>";
var_dump($getAll);
echo "</pre>";