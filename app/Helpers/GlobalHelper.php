<?php

use App\Config;

if (!function_exists('getSiteTitle')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function getSiteTitle()
    {
      $title = Config::where('key', 'title')->first();
      return $title ? $title->value : '';
    }
}

if (!function_exists('getAvailableRoles')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function getAvailableRoles()
    {
      return ['user', 'moderator', 'admin'];
    }
}
