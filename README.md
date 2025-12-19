# Accela OGP Plugin

OGP (Open Graph Protocol) と Twitter Card のメタタグを自動生成するAccelaプラグイン。

## インストール

```bash
composer require accela-framework/ogp-plugin
```

## 設定

`init-accela.php` でプラグインを有効化する。
オプションで、デフォルト値を設定することができる。

```php
$accela = new Accela([
  "appDir" => __DIR__ . "/app",
  "url" => "https://example.com",
  "plugins" => [
    "ogp" => [
      "site-name" => "My Website",
      "default-image" => "/assets/images/ogp-default.png",
      "twitter-card" => "summary_large_image",
      "twitter-site" => "@myaccount",
      "locale" => "ja_JP"
    ]
  ]
]);
```

### 設定オプション

| オプション | 説明 | デフォルト |
|-----------|------|-----------|
| `site-name` | サイト名（og:site_name） | - |
| `default-image` | デフォルトOGP画像 | - |
| `twitter-card` | Twitter Cardタイプ | `summary_large_image` |
| `twitter-site` | Twitterアカウント | - |
| `locale` | ロケール | `ja_JP` |

## 使い方

### 基本

ページテンプレートの `<head>` 内で使用：

```html
<head>
  <title>ページタイトル - My Website</title>

  <accela-server-component use="ogp:ogp"
    title="ページタイトル"
    description="ページの説明文"
    image="/assets/images/page-ogp.png"
    url="/about/">
  </accela-server-component>
</head>
```

### Page Props と連携（動的ページ）

```html
<head>
  <title data-bind-text="title"></title>

  <accela-server-component use="ogp:ogp"
    @title="title"
    @description="description"
    @image="ogpImage"
    @url="url">
  </accela-server-component>
</head>
```

```php
$accela->pageProps("/blog/[slug]/", function($query) use ($db) {
  $post = $db->get($query["slug"]);
  return [
    "title" => $post->title,
    "description" => $post->excerpt,
    "ogpImage" => $post->thumbnail,
    "url" => "/blog/" . $post->slug . "/"
  ];
});
```

### 個別に設定を上書き

```html
<accela-server-component use="ogp:ogp"
  title="特別なページ"
  description="説明"
  twitter-card="summary"
  locale="en_US">
</accela-server-component>
```

## 出力例

```html
<meta property="og:title" content="ページタイトル">
<meta property="og:description" content="ページの説明文">
<meta property="og:image" content="https://example.com/assets/images/page-ogp.png">
<meta property="og:url" content="https://example.com/about/">
<meta property="og:type" content="website">
<meta property="og:site_name" content="My Website">
<meta property="og:locale" content="ja_JP">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="ページタイトル">
<meta name="twitter:description" content="ページの説明文">
<meta name="twitter:image" content="https://example.com/assets/images/page-ogp.png">
<meta name="twitter:site" content="@myaccount">
```

## Props 一覧

| Prop | 説明 | 必須 |
|------|------|------|
| `title` | ページタイトル | ○ |
| `description` | ページ説明 | - |
| `image` | OGP画像URL（相対/絶対） | - |
| `url` | ページURL（相対/絶対） | - |
| `type` | og:type | - (default: `website`) |
| `site-name` | サイト名（設定を上書き） | - |
| `twitter-card` | Twitter Cardタイプ（設定を上書き） | - |
| `twitter-site` | Twitterアカウント（設定を上書き） | - |
| `locale` | ロケール（設定を上書き） | - |

## ライセンス

MIT
