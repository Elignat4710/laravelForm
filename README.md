##Пособие по установке проекта

1. ПО которое должно быть установлено:
   - PHP
   - MySQL
   - Composer
   - Nodejs
   - npm
2. Создаем базу данных в MySQL. Заходим в консоль MySQl -  `create database laravelForm`
3. Устанавливаем все зависимости `npm install && composer install`
4. Создаем файл в проекте `.env` по примеру `.env.example`. Настраиваем подключение к БД MySQL 
5. Делаем миграции всех таблиц `php artisan migrate`
6. Создаем роль админа `php artisan permission:create-role admin`
7. Включаем сиды для заполнения таблицы `countries` и создания аккаунта админа `php artisan db:seed`
    | Логин  | admin@admin.com |
    | ------ | --------------- |
    | Пароль | password        |
8. Включаем ссылку для хранилища фотографий `php artisan storage:link`
9. Устанавливаем ключ шифрования сессий и кук `php arisan key:generate`
10. Запускаем MIX `npm run dev`

## Endpoints
|endpoint         |value                       |
|-----------------|----------------------------|
| ' / '           |Главная страница с формой   |
|' /admin_panel ' |Админ панель                |
|' /listprofiles '|Страница со списком мемберов|

# Конец :)
