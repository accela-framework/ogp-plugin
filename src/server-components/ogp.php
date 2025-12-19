<?php
/**
 * OGP Server Component
 * 
 * @var Accela\Accela $accela
 * @var array $props
 * @var string $content
 * 
 * Props:
 *   - title: ページタイトル（必須）
 *   - description: ページ説明
 *   - image: OGP画像URL
 *   - url: ページURL
 *   - type: og:type (default: "website")
 *   - site-name: サイト名
 *   - twitter-card: summary / summary_large_image / player
 *   - twitter-site: @username
 *   - locale: ロケール
 */

$defaults = $accela->getData("ogp-defaults") ?? [];

$title = $props["title"] ?? "";
$description = $props["description"] ?? "";
$image = $props["image"] ?? $defaults["default-image"] ?? "";
$url = $props["url"] ?? "";
$type = $props["type"] ?? "website";
$siteName = $props["site-name"] ?? $defaults["site-name"] ?? "";
$twitterCard = $props["twitter-card"] ?? $defaults["twitter-card"] ?? "summary_large_image";
$twitterSite = $props["twitter-site"] ?? $defaults["twitter-site"] ?? "";
$locale = $props["locale"] ?? $defaults["locale"] ?? "ja_JP";

// URLが相対パスの場合、絶対URLに変換
if ($image && !preg_match('@^https?://@', $image)) {
  $baseUrl = $accela->url ?: "";
  $image = rtrim($baseUrl, "/") . "/" . ltrim($image, "/");
}

if ($url && !preg_match('@^https?://@', $url)) {
  $baseUrl = $accela->url ?: "";
  $url = rtrim($baseUrl, "/") . "/" . ltrim($url, "/");
}

// OGP
if ($title): ?>
<meta property="og:title" content="<?php echo htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?>">
<?php endif;

if ($description): ?>
<meta property="og:description" content="<?php echo htmlspecialchars($description, ENT_QUOTES, 'UTF-8'); ?>">
<?php endif;

if ($image): ?>
<meta property="og:image" content="<?php echo htmlspecialchars($image, ENT_QUOTES, 'UTF-8'); ?>">
<?php endif;

if ($url): ?>
<meta property="og:url" content="<?php echo htmlspecialchars($url, ENT_QUOTES, 'UTF-8'); ?>">
<?php endif;
?>
<meta property="og:type" content="<?php echo htmlspecialchars($type, ENT_QUOTES, 'UTF-8'); ?>">
<?php if ($siteName): ?>
<meta property="og:site_name" content="<?php echo htmlspecialchars($siteName, ENT_QUOTES, 'UTF-8'); ?>">
<?php endif;

if ($locale): ?>
<meta property="og:locale" content="<?php echo htmlspecialchars($locale, ENT_QUOTES, 'UTF-8'); ?>">
<?php endif;

// Twitter Card
?>
<meta name="twitter:card" content="<?php echo htmlspecialchars($twitterCard, ENT_QUOTES, 'UTF-8'); ?>">
<?php if ($title): ?>
<meta name="twitter:title" content="<?php echo htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?>">
<?php endif;

if ($description): ?>
<meta name="twitter:description" content="<?php echo htmlspecialchars($description, ENT_QUOTES, 'UTF-8'); ?>">
<?php endif;

if ($image): ?>
<meta name="twitter:image" content="<?php echo htmlspecialchars($image, ENT_QUOTES, 'UTF-8'); ?>">
<?php endif;

if ($twitterSite): ?>
<meta name="twitter:site" content="<?php echo htmlspecialchars($twitterSite, ENT_QUOTES, 'UTF-8'); ?>">
<?php endif;
