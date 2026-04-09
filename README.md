# 🖥️ Hosting Monitor

Модуль для мониторинга оплаты хостинга/VPS и использования ресурсов.

## 🎯 Цель проекта
- Изучение ООП в PHP на практике
- Подготовка к разработке модуля для 1С-Битрикс
- Портфолио разработчика

## 🏗️ Архитектура

src/
├── Domain/ # Бизнес-сущности (Ядро)
│ └── Server.php # Сущность сервера
├── Application/ # Сервисы (координация)
│ └── HostingMonitor.php
└── Infrastructure/ # Внешние зависимости
├── Notifier/ # Уведомления
│ ├── NotifierInterface.php
│ └── ConsoleNotifier.php
└── Repository/ # Хранилища данных
│ ├── ServerRepositoryInterface.php
│ └── ArrayServerRepository.php

🔧 Технологии
- PHP 8.1+
- Composer (PSR-4 autoloading)
- ООП: интерфейсы, инкапсуляция, внедрение зависимостей

🚀 Функционал
✅ Отслеживание даты оплаты сервера
✅ Мониторинг использования диска
✅ Гибкая система уведомлений (интерфейсы)
✅ Тестируемая архитектура

## 📦 Установка

```bash
# 1. Клонируй репозиторий
git clone https://github.com/твой-ник/hosting-monitor.git

# 2. Установи зависимости
composer install

# 3. Билд докер контейнера
docker compose up -d