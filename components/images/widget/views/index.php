<?php

use grozzzny\admin\components\images\widget\ImagesWidget;
use grozzzny\admin\helpers\Image;
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
?>

<script id="photo-template" type="text/template">
    <?= $this->render('_photoTemplate', ['widget' => $context])?>
</script>

<button id="photo-upload" class="btn btn-success text-uppercase">
    <span class="glyphicon glyphicon-arrow-up"></span>
    <?= Yii::t('app', 'Upload')?>
</button>

<small id="uploading-text" class="smooth">
    <?= Yii::t('app', 'Uploading. Please wait')?>
    <span></span>
</small>

<div id="admin-images-container" class="admin-images-photos">
    <?php foreach($images as $photo) : ?>
        <?= strtr($this->render('_photoTemplate', ['widget' => $context]), [
            '{{photo_id}}' => $photo->primaryKey,
            '{{photo_thumb}}' => Image::thumb($photo->file, ImagesWidget::PHOTO_THUMB_WIDTH, ImagesWidget::PHOTO_THUMB_HEIGHT),
            '{{photo_image}}' => $photo->file,
            '{{photo_description}}' => $photo->description,
            '{{photo_author}}' => $photo->author,
        ])?>
    <?php endforeach; ?>
</div>

<?= Html::beginForm(Url::to($context->url_upload + $linkParams), 'post', ['enctype' => 'multipart/form-data']) ?>
<?= Html::fileInput('', null, [
    'id' => 'photo-file',
    'class' => 'hidden-block',
    'multiple' => 'multiple',
])?>
<?php Html::endForm() ?>