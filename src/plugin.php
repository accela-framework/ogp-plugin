<?php

use Accela\Accela;

return function (Accela $accela, $args) {
  $defaults = [
    "site_name" => $args["site_name"] ?? "",
    "default_image" => $args["default_image"] ?? "",
    "twitter_card" => $args["twitter_card"] ?? "summary_large_image",
    "twitter_site" => $args["twitter_site"] ?? "",
    "locale" => $args["locale"] ?? "ja_JP",
  ];

  $accela->setData("ogp_defaults", $defaults);
};
