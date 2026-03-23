<?php
declare(strict_types=1); // используем строгую типизацию

/**
 * Класс Server представляет сущность сервера/хостинга
 * 
 * @package HostingMonitor
 * @author EgorSolomonov
 */
class Server {
    /**
     * Уникальный идентификатор сервера
     * 
     * @var int
     */
    private int $id; // задается однажды

    /**
     * Имя сервера
     * 
     * @var string
     */
    private string $name; //  Имя может быть изменено

    /**
     * Дата истечения сервера
     * 
     * @var DateTime
     */
    private DateTime $expirationDate; //Дата оплаты может продлеваться


    public function __construct(int $id,string $name,DateTime $expirationDate)
    {
        $this->id = $id; 
        $this->name = $name; 
        $this->expirationDate = $expirationDate; 
    }

    /**
     * Получить id сервера
     * 
     * @return int
     */
    public function getId():int {
        return $this->id;
    }

    /**
     * Получить название сервера
     * 
     * @return string
     */
    public function getName():string {
        return $this->name;
    }

    /**
     * Установить название сервера
     * 
     * @param string $name
     * @return void
     * @throws InvalidArgumentException Если имя пустое
     */
    public function setName(string $name): void
    {
        if (trim($name) === '') {
            throw new InvalidArgumentException('Название сервера не может быть пустым');
        }
    
        $this->name = $name;
    }

    /**
     * Получить дату истечения сервера
     * 
     * @return DateTime
     */
    public function getExpirationDate():DateTime {
        return $this->expirationDate;   
    }

    /**
     * Установить дату истечения сервера
     * 
     * @param DateTime $expirationDate
     * @return void
     */
    public function setExpirationDate(DateTime $expirationDate):void {
        $this->expirationDate = $expirationDate;
    }

    /**
     * Получить кол-во дней до истечения сервера
     * 
     * @return int
     */
    public function getDaysUntilExpiration():int {
        return (int)((new DateTime())->diff($this->expirationDate))->format('%r%a');
    }

    /**
     * Проверить сервер на активность
     * 
     * @return bool
     */
    public function isExpired():bool {
        return $this->getDaysUntilExpiration() < 0;
    }

    /**
     * Проверить сервер возможность скорой деактивации
     * 
     * @param int $week
     * @return bool
     */
    public function willExpireSoon(int $week = 7):bool {
        $daysLeft = $this->getDaysUntilExpiration();
        return $daysLeft >= 0 && $daysLeft <= $week;
    }

    /**
     * Проверить, что сервер не истечёт в ближайшие N дней
     * 
     * @param int $week
     * @return bool
     */
    public function willNotExpireSoon(int $week = 7): bool {
        $daysLeft = $this->getDaysUntilExpiration();
        return $daysLeft > $week;
    }
}

$server = new Server(
    1,
    'adminvps',
    new DateTime('2026-04-01')
);

// $serverId = $server->getId();
// var_dump($_SERVER);