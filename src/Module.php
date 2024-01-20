<?php

namespace portalium\site;

use Yii;
use portalium\base\Event;
use portalium\user\Module as UserModule;
use portalium\site\components\TriggerActions;

class Module extends \portalium\base\Module
{
    const EVENT_ON_LOGIN = 'siteAfterLogin';
    const EVENT_ON_SIGNUP = 'siteAfterSignup';

    const EVENT_SETTING_UPDATE = 'siteSettingUpdate';

    public static $description = 'Site Management Module';
    public static $name = 'Site';
    public $apiRules = [
        [
            'class' => 'yii\rest\UrlRule',
            'controller' => [
                'site/auth',
                'site/setting',
            ]
        ],
    ];

    public static $tablePrefix = 'site_';

    public function getMenuItems(){
        $menuItems = [
            [
                [
                    'menu' => 'web',
                    'type' => 'widget',
                    'label' => 'portalium\site\widgets\LoginButton',
                    'name' => 'Login',
                ],
                [
                    'menu' => 'web',
                    'type' => 'widget',
                    'label' => 'portalium\site\widgets\Language',
                    'name' => 'Language',
                ],
                [
                    'menu' => 'web',
                    'type' => 'action',
                    'route' => '/site/setting/index',
                ]
            ],
        ];
        return $menuItems;
    }

    public static function moduleInit()
    {
        self::registerTranslation('site','@portalium/site/messages',[
            'site' => 'site.php',
        ]);
    }

    public function registerComponents()
    {
        return [
            'setting' => [
                'class' => 'portalium\site\components\Setting',
            ],
            'site' => [
                'class' => 'portalium\site\components\Site',
            ],
        ];
    }

    public static function t($message, array $params = [])
    {
        return parent::coreT('site', $message, $params);
    }

    public static function settingT($category, $message, array $params = [])
    {
        self::registerTranslation($category,'@portalium/'. $category .'/messages',[
            $category => $category.'.php',
        ]);

        return parent::coreT($category, $message, $params);
    }

    public function registerEvents()
    {
        Event::on($this::className(), UserModule::EVENT_USER_CREATE, [new TriggerActions(), 'onUserCreateBefore']);
    }

}
