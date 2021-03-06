<?php
/**
 * Tencent is pleased to support the open source community by making Biny available.
 * Copyright (C) 2017 THL A29 Limited, a Tencent company. All rights reserved.
 * Licensed under the BSD 3-Clause License (the "License"); you may not use this file except in compliance with the License. You may obtain a copy of the License at
 * https://opensource.org/licenses/BSD-3-Clause
 * Unless required by applicable law or agreed to in writing, software distributed under the License is distributed on an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the License for the specific language governing permissions and limitations under the License.
 * Created by PhpStorm.
 * User: billge
 * Date: 16-7-19
 * Time: 下午5:54
 */

namespace biny\lib;
use TXApp;

class TXLanguage
{
    private static $language = null;
    private static $contents = null;

    /**
     * 获取语言
     * @param $lang
     * @return null|string
     */
    public static function getLanguage($lang=null)
    {
        if (self::$language === null){
            self::$language = $lang ?: (isset($_COOKIE['biny_language']) ? $_COOKIE['biny_language'] : '');
        }
        return $lang ?: self::$language;
    }

    /**
     * 获取tpl内容
     * @param $lang
     */
    private static function getContents($lang)
    {
        if (self::$contents === null){
            $path = TXApp::$base_root . DS . 'language' . DS . $lang .'.php';
            self::$contents = is_readable($path) ? require($path) : [];
        }
    }

    /**
     * 获取翻译
     * @param $content
     * @return mixed
     */
    public static function getContent($content)
    {
        $lang = self::getLanguage();
        if ($lang){
            self::getContents($lang);
            $content = isset(self::$contents[$content]) ? self::$contents[$content] : $content;
        }
        return $content;
    }
}