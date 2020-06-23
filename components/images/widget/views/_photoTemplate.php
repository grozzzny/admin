<?php

use grozzzny\admin\components\images\widget\ImagesWidget;
use yii\web\View;

/**
 * @var View $this
 * @var ImagesWidget $widget
 */

?>

<div class="admin-images-photo" data-photo-id="{{photo_id}}">
    <div class="admin-images-photo-preview">
        <a href="{{photo_image}}" title="{{photo_description}}" target="_blank">
            <img id="photo-{{photo_id}}" src="{{photo_thumb}}">
        </a>
    </div>
    <div class="admin-images-photo-body">
        <input class="form-control photo-author <?=$widget->enable_author ? '' : 'hidden-block'?>" style="margin-bottom: 5px;" type="text" placeholder="<?=Yii::t('app', 'Author')?>" value="{{photo_author}}">
        <textarea class="form-control photo-description <?=$widget->enable_description ? '' : 'hidden-block'?>" placeholder="<?=Yii::t('app', 'Description')?>">{{photo_description}}</textarea>
        <a href="<?=$widget->url_data?>" class="btn btn-sm btn-primary disabled save-photo-description <?=$widget->enable_author || $widget->enable_description ? '' : 'hidden-block'?>"><?=Yii::t('app', 'Save')?></a>
        <a href="<?=$widget->url_change ?>" class="btn btn-success change-image-button" title="<?= Yii::t('app', 'Change image') ?>">
            <span class="glyphicon glyphicon-floppy-disk"></span>
        </a>
        <a href="<?=$widget->url_delete ?>" class="btn btn-success color-red delete-photo" title="<?= Yii::t('app', 'Delete item') ?>">
            <span class="glyphicon glyphicon-remove"></span>
        </a>
        <input type="file" name="AdminImages[file]" class="change-image-input hidden-block">
    </div>
</div>