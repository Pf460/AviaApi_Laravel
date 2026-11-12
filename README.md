# AviaProjectApi - тестовое задание на Laravel

---

## Стэк

- Docker desktop
- Postman
- PHP 8.4
- Laravel 13
- PostgreSQL 15
- NGINX

---

## Инструкция по запуску

1. Копируем репозиторий с GitHub
````bash
git clone https://github.com/Pf460/AviaApi_Laravel.git
````
2. Настройка окружения
````bash
cd project
cp .env.example .env

cd ..
cd deploy/dev
ln -s ../../project/.env .env
````
3. Запуск
````bash
cd deploy/dev
docker compose up -d --build
docker compose exec app php artisan migrate
docker compose exec app php artisan db:seed
````

---
