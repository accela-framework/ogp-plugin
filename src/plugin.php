<?php

use Accela\Accela;

return function (Accela $accela, $args) {
  $defaults = [
    "site-name" => $args["site-name"] ?? "",
    "default-image" => $args["default-image"] ?? "",
    "twitter-card" => $args["twitter-card"] ?? "summary_large_image",
    "twitter-site" => $args["twitter-site"] ?? "",
    "locale" => $args["locale"] ?? "ja_JP",
  ];

  $accela->setData("ogp-defaults", $defaults);
};
