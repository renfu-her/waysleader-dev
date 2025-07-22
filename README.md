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

## 案件流程

### 1. 需求分析階段
- **客戶需求收集**
  - 與客戶進行初步溝通
  - 了解專案目標和功能需求
  - 收集技術規格和限制條件
  - 確定預算和時程

- **需求文件撰寫**
  - 功能需求規格書 (FRS)
  - 技術需求規格書 (TRS)
  - 使用者故事 (User Stories)
  - 驗收標準定義

### 2. 規劃設計階段
- **系統架構設計**
  - 資料庫設計
  - API 架構規劃
  - 前端架構設計
  - 安全性考量

- **UI/UX 設計**
  - 線框圖 (Wireframes)
  - 原型設計 (Prototypes)
  - 視覺設計稿
  - 響應式設計規劃

### 3. 開發階段
- **環境建置**
  - 開發環境設定
  - 版本控制系統建立
  - CI/CD 流程設定
  - 測試環境準備

- **功能開發**
  - 後端 API 開發
  - 前端介面開發
  - 資料庫實作
  - 第三方整合

### 4. 測試階段
- **單元測試**
  - 程式碼單元測試
  - API 端點測試
  - 資料庫操作測試

- **整合測試**
  - 系統整合測試
  - 端對端測試
  - 效能測試
  - 安全性測試

- **使用者驗收測試 (UAT)**
  - 功能驗收測試
  - 使用者介面測試
  - 跨瀏覽器測試
  - 行動裝置測試

### 5. 部署階段
- **生產環境準備**
  - 伺服器環境設定
  - 資料庫部署
  - SSL 憑證設定
  - 監控系統建置

- **正式上線**
  - 程式碼部署
  - 資料庫遷移
  - 功能驗證
  - 效能監控

### 6. 維護階段
- **系統監控**
  - 效能監控
  - 錯誤追蹤
  - 安全性監控
  - 備份管理

- **持續改善**
  - 功能優化
  - 效能調校
  - 安全性更新
  - 使用者回饋處理

### 7. 專案交付
- **文件交付**
  - 技術文件
  - 使用者手冊
  - 維護手冊
  - API 文件

- **教育訓練**
  - 系統操作訓練
  - 管理後台使用說明
  - 故障排除指導

### 8. 售後服務
- **技術支援**
  - 問題診斷
  - 故障排除
  - 功能調整
  - 系統升級

- **定期維護**
  - 系統更新
  - 安全性修補
  - 效能優化
  - 備份檢查

### 注意事項
- 每個階段都應有明確的里程碑和交付項目
- 定期與客戶溝通進度和問題
- 保持程式碼品質和文件完整性
- 建立有效的變更管理流程
- 確保資料安全和隱私保護


