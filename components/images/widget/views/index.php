<?php

use yii\helpers\Html;
use yii\helpers\Url;

/**
 * @var \yii\web\View $this
 * @var \grozzzny\admin\components\images\AdminImages[] $images
 * @var \grozzzny\admin\components\images\widget\ImagesWidget $context
 */
$context = $this->context;

$linkParams = [
    'key' => $context->key,
    'item_id' => $context->model->primaryKey,
];

$photoTemplate = '<tr data-id="{{photo_id}}"><td>{{photo_id}}</td>\
    <td><a href="{{photo_image}}" class="plugin-box" title="{{photo_description}}" rel="easyii2-photos"><img class="photo-thumb" id="photo-{{photo_id}}" src="{{photo_thumb}}"></a></td>\
    <td>\
        <textarea class="form-control photo-description">{{photo_description}}</textarea>\
        <a href="' . Url::to(['/admin/photos/description/{{photo_id}}']) . '" class="btn btn-sm btn-primary disabled save-photo-description">'. Yii::t('app', 'Save') .'</a>\
    </td>\
    <td class="control vtop">\
        <div class="btn-group btn-group-sm" role="group">\
            <a href="' . Url::to(['/admin/photos/up/{{photo_id}}'] + $linkParams) . '" class="btn btn-default move-up" title="'. Yii::t('app', 'Move up') .'"><span class="glyphicon glyphicon-arrow-up"></span></a>\
            <a href="' . Url::to(['/admin/photos/down/{{photo_id}}'] + $linkParams) . '" class="btn btn-default move-down" title="'. Yii::t('app', 'Move down') .'"><span class="glyphicon glyphicon-arrow-down"></span></a>\
            <a href="' . Url::to(['/admin/photos/image/{{photo_id}}'] + $linkParams) . '" class="btn btn-default change-image-button" title="'. Yii::t('app', 'Change image') .'"><span class="glyphicon glyphicon-floppy-disk"></span></a>\
            <a href="' . Url::to(['/admin/photos/delete/{{photo_id}}']) . '" class="btn btn-default color-red delete-photo" title="'. Yii::t('app', 'Delete item') .'"><span class="glyphicon glyphicon-remove"></span></a>\
            <input type="file" name="Photo[image]" class="change-image-input hidden">\
        </div>\
    </td>\
</tr>';
$this->registerJs("
var photoTemplate = '{$photoTemplate}';
", \yii\web\View::POS_HEAD);
$photoTemplate = str_replace('>\\', '>', $photoTemplate);
?>
<button id="photo-upload" class="btn btn-success text-uppercase"><span class="glyphicon glyphicon-arrow-up"></span> <?= Yii::t('app', 'Upload')?></button>
<small id="uploading-text" class="smooth"><?= Yii::t('app', 'Uploading. Please wait')?><span></span></small>

<table id="photo-table" class="table table-hover" style="display: <?= count($images) ? 'table' : 'none' ?>;">
    <thead>
    <tr>
        <th width="50">#</th>
        <th width="150"><?= Yii::t('app', 'Image') ?></th>
        <th><?= Yii::t('app', 'Description') ?></th>
        <th width="150"></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($images as $photo) : ?>
        <?= str_replace(
            ['{{photo_id}}', '{{photo_thumb}}', '{{photo_image}}', '{{photo_description}}'],
            [$photo->primaryKey, \grozzzny\admin\helpers\Image::thumb($photo->file, 120, 90), $photo->file, $photo->description],
            $photoTemplate)
        ?>
    <?php endforeach; ?>
    </tbody>
</table>
<p class="empty" style="display: <?= count($images) ? 'none' : 'block' ?>;"><?= Yii::t('app', 'No photos uploaded yet') ?>.</p>

<?= Html::beginForm(Url::to(['/admin-images/upload'] + $linkParams), 'post', ['enctype' => 'multipart/form-data']) ?>
<?= Html::fileInput('', null, [
    'id' => 'photo-file',
    'class' => 'hidden',
    'multiple' => 'multiple',
])
?>
<?php Html::endForm() ?>