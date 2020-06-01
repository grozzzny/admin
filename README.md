Admin panel - module for Yii2 
==============================

This module allows to [yiiframework](https://www.yiiframework.com) 
Dashboard Bootstrap 4. [Dashboard demo](https://www.bootstrapdash.com/demo/star-admin-free/jquery/src/demo_1/index.html#) 

![alt text](https://raw.githubusercontent.com/grozzzny/admin/master/assets/images/2020-06-01_20-41-05.png)

#### Live edit and admin navbar

![alt text](https://raw.githubusercontent.com/grozzzny/admin/master/assets/images/2020-06-01_20-49-59.png)

#### CRUD gii

![alt text](https://raw.githubusercontent.com/grozzzny/admin/master/assets/images/2020-06-01_20-55-25.png)

### Installation guide

```bash
$ php composer.phar require grozzzny/admin "dev-master"
```


### Configure

> **NOTE:** Make sure that you don't have `admin` component configuration in your config files.

Add following lines to your main configuration file:

```php
$config = [
    ...
    'bootstrap' => ['admin'],
    ...
    'controllerMap' => [
         'feedback' => [
             'class' => 'grozzzny\admin\modules\feedback\widgets\form\controllers\DefaultController',
             'on submit' => ['grozzzny\admin\modules\feedback\widgets\form\components\SubmitHandler', 'submit']
         ]
    ],
    ...
    'modules' => [
        ...
         // https://imperavi.com/redactor/docs/settings/
         'redactor' => [
             'class' => 'yii\redactor\RedactorModule',
              'as access' => [
                  'class' => 'grozzzny\admin\behaviors\AccessControl',
              ],
             'uploadDir' => '@webroot/uploads',
             'uploadUrl' => '@web/uploads',
             'imageAllowExtensions'=>['jpg','png','gif']
         ],
        'admin' => [
            'class' => 'grozzzny\admin\AdminModule',
             'as access' => [
                 'class' => 'grozzzny\admin\behaviors\AccessControl',
             ],
             'live_edit_role' => '@',
             'render_toolbar_role' => '@',
             'view_path_toolbar' => '@grozzzny/admin/views/layouts/_toolbar',
             'nav_items' => [
                 [
                     'label' => 'Начальная',
                     'url' => ['/admin/default']
                 ],
                 [
                     'label' => 'Страницы',
                     'url' => ['/admin/pages/default']
                 ],
                 [
                     'label' => 'Текстовые блоки',
                     'url' => ['/admin/text/default']
                 ],
                 [
                     'label' => 'Преимущества',
                     'url' => ['/admin/features/default']
                 ],
                 [
                     'label' => 'Отзывы',
                     'url' => ['/admin/testimonials/default']
                 ],
                 [
                     'label' => 'Обратный звонок',
                     'url' => ['/admin/feedback/default']
                 ],
                 [
                     'label' => 'Ссылки соц. сетей',
                     'url' => ['/admin/social_links/default']
                 ],
                 [
                     'label' => 'Dashboard demo',
                     'url' => 'https://www.bootstrapdash.com/demo/star-admin-free/jquery/src/demo_1/index.html',
                 ]
             ],
             'modules' => [
                 'text' => [
                     'class' => 'grozzzny\admin\modules\text\TextModule',
                 ],
                 'features' => [
                     'class' => 'grozzzny\admin\modules\features\FeaturesModule',
                 ],
                 'testimonials' => [
                     'class' => 'grozzzny\admin\modules\testimonials\TestimonialsModule',
                 ],
                 'feedback' => [
                     'class' => 'grozzzny\admin\modules\feedback\FeedbackModule',
                 ],
                 'social_links' => [
                     'class' => 'grozzzny\admin\modules\social_links\SocialLinksModule',
                 ],
                 'pages' => [
                     'class' => 'grozzzny\admin\modules\pages\PagesModule',
                 ],
             ],
        ],
        ...
    ],
    ...
    'params' => [
       'adminEmail' => 'admin@example.com',
       'senderEmail' => 'noreply@example.com',
       'senderName' => 'Example.com mailer',
       'noimage' => '/images/noimage.jpg',
    ],
    ...
];

$config['modules']['gii'] = [
    'class'      => 'yii\gii\Module',
    'generators' => [
        'crud'   => [
            'class'     => 'yii\gii\generators\crud\Generator',
            'templates' => [
                'admin' => '@grozzzny/admin/templates/crud'
            ]
        ]
    ]
];

```

Add following lines to your console configuration file:

```php
'controllerMap' => [
    'migrate' => [
        'class' => 'yii\console\controllers\MigrateController',
        'migrationPath' => [
            '@grozzzny/admin/migrations',
        ],
    ],
],
```


Run migrations
```bash
php yii migrate
```


#### Example module pages with SEO behavior (Polymorphic relationship)

![alt text](https://raw.githubusercontent.com/grozzzny/admin/master/assets/images/2020-06-01_20-59-21.png)