<?php

/**
 * Интерфейс для работы с данными сервера
 */
interface ServerRepositoryInterface
{
    /**
     * Поиск сервера по id
     * 
     * @param int $id id сервера
     * @return Server|null возвращает сервер с данными или null
     */
    public function findById(int $id): ?Server;

    /**
     * Поиск всех имеющихся серверов
     * 
     * @return Server[] возврат массива с серверами
     */
    public function findAll(): array;

    /**
     * Сохранить сервер
     * 
     * @param Server $server переданный сервер для сохранения 
     * @return void 
     */
    public function save(Server $server): void;
}