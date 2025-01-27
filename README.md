## ТЗ выполнено на Laravel
## Используемые таблицы в бд (Была реализована полиморфная связь между images и paarmeters, прописаны необходимые traits. Таким образом, изображения можно прикреплять и к другим моделям (масштабируемость)). При этом, для достижения согласованности, было решено использовать таблицы-справочники 
- parameter_types
- parameters
- image_types
- images

## Интересные моменты
- Спроектированная мной система по принципу работы схожа с существующей библиотекой spatie\medialibrary
- При удалении параметра, удаляются и все изображения, как из бд, так и с носителя
- При обновлении параметра и загрузки новых изображений с тем же типом, что уже привязан к параметру, изображение заменяется
- Тип параметра нельзя менять, только title и изображения согласно типам в таблице

## Методы API и их параметры
- api/parameters - GET - Получение списка параметров (есть возможность фильтрации посредством необязательных параметров id, type, title (title при этом можно вписывать частично, поиск при помощи оператора like в бд))
- api/parameters/{id} - GET - Получение конкретного параметра по id
- api/parameters - POST - Создание нового параметра - (Обязательные параметры - type, title) (Необязательные параметры - icon, icon_gray)
- api/parameters/{id}/update - POST - Обновление параметра по id - (Необязательные параметры - title, icon, icon_gray)
- api/parameters/{id} - DELETE - удаление параметра по id
- api/parameters/{id}/images - DELETE - удаление изображения параметра по названию типа (параметр type в query (?type=icon/icon_gray)) и по id параметра

## Чтобы поднять контейнеры Docker для работы API (в системе нужен docker и docker-compose), нужно:
- Зайти в папку проекта
- Зайти в папку docker
- Прописать в консоли: docker-compose up -d
