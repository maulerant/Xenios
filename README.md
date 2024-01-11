# Xenios


Для запуска окружения с нужными правами нужно выполнять команду
Это нужно для Linux окружения, под mac и windows вроде бы таких проблем нет.

```bash 
CURRENT_UID=$(id -u):$(id -g) docker-compose up
```

Установить зависимости (единоразово и при переключении веток)
```bash 
docker exec -i app composer install --ignore-platform-reqs
```

Созданые и запуск миграций
```bash
docker exec -i app php artisan make:migration MIGRATION_NAME 
docker exec -i app php artisan migrate
```

Консоль
```bash
docker exec -it app bash
```
