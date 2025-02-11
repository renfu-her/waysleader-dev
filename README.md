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
  - email: admin@admin.com
  - password: Qq123456

## API

- URL: https://waysleader.dev-vue.com/api/v1

### 網站設定

```bash
GET /api/v1/setting
```

- 回傳資料

```json
{
  "status": "success",
  "data": {
    "id": 1,
    "site_name": "科普班長",
    "site_logo": "https://waysleader.dev-vue.com/storage/settings/01JKSTQYR6HAHMN96RPR499T3N.png",
    "site_favicon": "https://waysleader.dev-vue.com/storage/settings/01JKSTQYR8QTFH2V5SA5XHGP48.png",
    "seo_title": null,
    "seo_description": null,
    "seo_keywords": null,
    "contact_email": null,
    "contact_phone": null,
    "address": null,
    "facebook_url": null,
    "instagram_url": null,
    "line_url": null
  }
}
```

## 單頁

```bash
GET /api/v1/pages
```

- 回傳資料

```json
{
  "status": "success",
  "data": [
    {
      "id": 1,
      "slug": "about",
      "title": "簡介",
      "image": null,
      "content": "簡介內容",
      "meta_title": null,
      "meta_description": null,
      "meta_keywords": null
    },
    {
      "id": 2,
      "slug": "contact",
      "title": "與我聯繫",
      "image": null,
      "content": "聯繫內容",
      "meta_title": null,
      "meta_description": null,
      "meta_keywords": null
    },
    {
      "id": 3,
      "slug": "features",
      "title": "課程特色",
      "image": null,
      "content": "特色內容",
      "meta_title": null,
      "meta_description": null,
      "meta_keywords": null
    }
  ]
}
```

### 單頁詳情

```bash
GET /api/v1/pages/{slug}
```

- 回傳資料

```json
{
  "status": "success",
  "data": {
    "id": 1,
    "slug": "about",
    "title": "簡介",
    "image": null,
    "content": "簡介內容",
    "meta_title": null,
    "meta_description": null,
    "meta_keywords": null
  }
}
```

## 課程教學

```bash
GET /api/v1/courses
```

- 回傳資料

```json
{
  "status": "success",
  "data": [
    {
      "id": 1,
      "title": "第一階段",
      "image_url": "https://waysleader.dev-vue.com/storage/courses/0194f3d9-2e1c-72ce-b380-ac809f28c948.webp",
      "is_new": false
    }
  ]
}

```

### 課程教學詳情

```bash
GET /api/v1/courses/{id}
```

- 回傳資料

```json
{
  "status": "success",
  "data": {
    "id": 1,
    "title": "第一階段",
    "subtitle": null,
    "image_url": "https://waysleader.dev-vue.com/storage/courses/0194f3d9-2e1c-72ce-b380-ac809f28c948.webp",
    "content": "<p>內容</p>",
    "is_new": false,
    "meta": {
      "title": null,
      "description": null,
      "keywords": null
    },
    "images": [
      {
        "id": 1,
        "image_url": "https://waysleader.dev-vue.com/storage/course-images/0194f3e4-0006-728a-8824-869d9cc015cc.webp",
        "sort": 1
      }
    ]
  }
}

```


