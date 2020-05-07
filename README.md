Admin module for Yii2 
==============================

This module allows to [yiiframework](https://www.yiiframework.com) 
Dashboard Bootstrap 4 [Dashboard](https://www.bootstrapdash.com/demo/star-admin-free/jquery/src/demo_1/index.html#) 

### Installation guide

```bash
$ php composer.phar require grozzzny/admin "dev-master"
```


### Configure

> **NOTE:** Make sure that you don't have `admin` component configuration in your config files.

Add following lines to your main configuration file:

```php
'modules' => [
    'admin' => [
        'class' => 'grozzzny\admin\AdminModule',
    ],
],
```


Run migrations
```bash
php yii migrate
```
