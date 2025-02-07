# admin-filament-dev

## 安裝

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed
```
## 跑完 db:seed
- 登入
email: admin@admin.com
password: Qq123456

## API

### 相簿

```bash
GET /api/v1/albums
GET /api/v1/albums/{id}
```

### 最新消息

```bash
GET /api/v1/news
GET /api/v1/news/{id}
```

### 文章分類和文章

```bash
GET /api/v1/categories
GET /api/v1/categories/{categoryId}/posts
GET /api/v1/posts/{id}
```