# WP Kickstarter

Унифицированная тема WordPress для командной разработки. Tailwind CSS 4 + Vite.

## Требования

- Docker Desktop
- Git
- Node.js (для сборки стилей)

## Установка

### 1. Клонирование репозитория
```bash
git clone https://github.com/dmitridemenkov/wp-kickstarter.git
cd wp-kickstarter
```

### 2. Настройка базы данных

Скопируйте файл конфигурации:
```bash
cp .env.example .env
```

Откройте `.env` и заполните данные подключения к базе данных (получите у системного администратора):
```
DB_HOST=mysql.yourhosting.com
DB_USER=your_db_user
DB_PASSWORD=your_db_password
DB_NAME=your_db_name
```

Важно: на хостинге должен быть включен удаленный доступ к MySQL.

### 3. Запуск Docker
```bash
docker-compose up -d
```

Сайт будет доступен по адресу: http://localhost:8000

### 4. Установка зависимостей темы
```bash
cd themes/wp-kickstarter
npm install
```

### 5. Режим разработки

Для автоматической компиляции стилей при изменениях:
```bash
npm run dev
```

Для сборки продакшн-версии:
```bash
npm run build
```

## Остановка и запуск

Остановить контейнер:
```bash
docker-compose down
```

Запустить снова:
```bash
docker-compose up -d
```

## Возможные проблемы

### Error establishing a database connection

- Проверьте правильность данных в `.env`
- Убедитесь что на хостинге включен удаленный доступ к MySQL
- Проверьте что ваш IP разрешен для подключения к базе

### Контейнер не запускается

Проверьте логи:
```bash
docker-compose logs wordpress
```