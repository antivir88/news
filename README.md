# News portal sample, written on MicroPHP

На главной странице выводятся 3 новости (заголовок, краткий текст) отсортированных по дате добавления, с пагинатором и возможностью сортировки по дате в прямом и обратном порядке. Выводятся только активные новости.
В качестве меню реализовать список  категорий в которых есть новости. Вложенность категорий не ограничена.

## Features

Ссылка на страницу новости должна быть вида /news/news_title.
Страница /news/news_title должна отображать заголовок новости, текст новости, дату создания новости, а также форму с комментариями под новостью.
 
Страница /admin должна проверять авторизацию пользователя. Логин login, пароль password
 
Администратор может:
1) Просматривать список новостей, добавлять/редактировать/удалять новость.
2) Просматривать список категорий, добавлять/редактировать/удалять категорию.
 
При добавлении категории нужно указать:
1) Название
2) Родительская категория
 
При добавлении новости нужно указать:
1) заголовок
2) категорию 
3) анонс
4) подробный текст