# Тестовая задача, демонстрирующая реализацию MVC-концепции без фреймворков.

Поставленная задача:
1. Реализовать авторизацию пользователя.
2. Реализовать импорт xml файла в БД.
	- Страница импорта доступна только авторизованному ползователю.
	- Структура таблиц БД любая.
3. Реализовать вывод импортированных данных:
	- Вывести всех людей, у которых есть питомцы, старше 3 лет. 

Требования:
1. Приложение должно быть написано на PHP.
2. Приложение не должно быть написано с помощью какого-либо фреймворка.

Начальный дамп БД и файл XML для загрузки находятся в папке Data.

# Краткое описание решения

Все таблицы БД пустые, только одна запись сразу заполнена в таблице users, для авторизации пользователя.
Имя пользователя для входа user, пароль 123. 
Пароль в БД хранится в виде MD5-хеша. Не самый надежный способ на сегодня, но это сделано для упрощения.
 
Проект реализован в концепции MVC. 

Использованы PHP 7.4, БД MySQL 5.6.

Для оформления фронтовой части использована библиотека bootstrap.
