<?php

use grozzzny\admin\assets\AdminAsset;
use yii\web\View;

/**
 * @var View $this
 */

$asset = AdminAsset::register($this);

?>

<li class="nav-item nav-profile">
    <a href="#" class="nav-link">
        <div class="profile-image">
            <img class="img-xs rounded-circle" src="<?=$asset->baseUrl?>/images/nophoto.jpeg" alt="profile image">
            <div class="dot-indicator bg-success"></div>
        </div>
        <div class="text-wrapper">
            <p class="profile-name"><?=Yii::$app->user->identity->username?></p>
        </div>
    </a>
</li>
