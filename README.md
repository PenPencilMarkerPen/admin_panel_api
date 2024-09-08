# admin_panel_api

## Последовательность выполнения команд для успешного запуска

**_*Данный файл содержит данные для подключения к БД*_**

```shell
cp .example.env .env
```

**_Команда для запуска миграций по созданию таблиц для хранения ролей_**

```shell
php yii migrate --migrationPath=@yii/rbac/migrations
```

**_Миграции для создания основных таблиц_**

```shell
php yii migrate
```

**_Создания ролей доступных для пользователей и Администратора_**

```shell
php yii rbac/init
```

**_Для запуска проекта локально_**

```shell
php -S 0.0.0.0:3000 -t web
```

## Развертывание с использованием Docker

**_Также следует заполнить файл .env_**

```shell
docker-compose --env-file .env -f infra/docker-compose.local.yaml up --build
```

## Список доступных эндпоинтов

_Для доступа в административную панель перейдите по ссылке_

```shell
http://localhost:<port>/
```

_Пароль: admin Логин: Admin_

_Для доступа к API необходимо пройти аутентификацию партнерам_

```shell
http://localhost:<port>/api/auth/login
```

_POST запрос_

```shell
{
    "username": "User",
    "password": "123"
}
```

_Авторизация происходит по средствам Bearer Authentication_

_Структура заголовка Authorization_

```shell
Authorization: Bearer QRA8t7IfYrk6F77YVcoiL6ZUBw0vVHSFcW14ysOjetGnzwDgDj5m7j8
```

_Для просмотра товаров доступных пользователю, который залогинен_

```shell
http://localhost:<port>/api/items
```

```shell
http://localhost:<port>/api/items?name=string
```

```shell
http://localhost:<port>/api/items/1
```

_Для просмотра категорий доступных пользователю, который залогинен_

```shell
http://localhost:<port>/api/categories
```

```shell
http://localhost:<port>/api/categories?name=string
```

```shell
http://localhost:<port>/api/categories/1
```

---

**_Приятного использования!_**
