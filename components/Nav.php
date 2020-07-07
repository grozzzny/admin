<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace grozzzny\admin\components;

use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
use Yii;
use yii\helpers\Html;

/**
 * Nav renders a nav HTML component.
 *
 * For example:
 *
 * ```php
 * echo Nav::widget([
 *     'items' => [
 *         [
 *             'label' => 'Home',
 *             'url' => ['site/index'],
 *             'linkOptions' => [...],
 *         ],
 *         [
 *             'label' => 'Dropdown',
 *             'items' => [
 *                  ['label' => 'Level 1 - Dropdown A', 'url' => '#'],
 *                  ['label' => 'Level 1 - Dropdown B', 'url' => '#'],
 *             ],
 *         ],
 *         [
 *             'label' => 'Login',
 *             'url' => ['site/login'],
 *             'visible' => Yii::$app->user->isGuest
 *         ],
 *     ],
 *     'options' => ['class' =>'nav-pills'], // set this to nav-tab to get tab-styled navigation
 * ]);
 * ```
 *
 */
class Nav extends \yii\bootstrap4\Nav
{
    /**
     * Renders widget items.
     * @throws InvalidConfigException
     */
    public function renderItems()
    {
        $items = [];
        foreach ($this->items as $i => $item) {
            if (isset($item['visible']) && !$item['visible']) {
                continue;
            }
            $items[] = $this->renderItemOne($item, $i);
        }

        return Html::tag('ul', implode("\n", $items), $this->options);
    }

    /**
     * Renders a widget's item.
     * @param string|array $item the item to render.
     * @return string the rendering result.
     * @throws InvalidConfigException
     * @throws \Exception
     */
    public function renderItemOne($item, $i)
    {
        if (is_string($item)) {
            return $item;
        }
        if (!isset($item['label'])) {
            throw new InvalidConfigException("The 'label' option is required.");
        }
        $encodeLabel = isset($item['encode']) ? $item['encode'] : $this->encodeLabels;
        $label = $encodeLabel ? Html::encode($item['label']) : Yii::t('app', $item['label']);
        $options = ArrayHelper::getValue($item, 'options', []);
        $items = ArrayHelper::getValue($item, 'items');
        $url = ArrayHelper::getValue($item, 'url', '#');
        $linkOptions = ArrayHelper::getValue($item, 'linkOptions', []);
        $disabled = ArrayHelper::getValue($item, 'disabled', false);
        $active = $this->isItemActive($item);

        if (empty($items)) {
            $items = '';
        } else {
            $linkOptions['data-toggle'] = 'collapse';
            $linkOptions['aria-expanded'] = $active ? 'true' : 'false';
            $label = '<i class="menu-icon typcn typcn-coffee"></i><span class="menu-title">'.$label.'</span><i class="menu-arrow"></i>';

            if (is_array($items)) {
                $url = '#' . $this->getIdItem($i);
                $items = $this->renderDropdownOneLevel($items, $item, $i);
            }
        }

        Html::addCssClass($options, 'nav-item');
        Html::addCssClass($linkOptions, 'nav-link');

        if ($disabled) {
            ArrayHelper::setValue($linkOptions, 'tabindex', '-1');
            ArrayHelper::setValue($linkOptions, 'aria-disabled', 'true');
            Html::addCssClass($linkOptions, 'disabled');
        } elseif ($this->activateItems && $active) {
            Html::addCssClass($linkOptions, 'active');
        }

        return Html::tag('li', Html::a($label, $url, $linkOptions) . $items, $options);
    }

    public function renderDropdownOneLevel($items, $parentItem, $i)
    {
        $active = $this->isItemActive($parentItem);

        $widget = self::widget([
            'options' => ['class' => 'nav flex-column sub-menu'],
            'items' => $items
        ]);

        $classes = ['collapse'];

        if($active) $classes[] = 'show';

        return Html::tag('div', $widget, [
            'class' => $classes,
            'id' => $this->getIdItem($i)
        ]);
    }

    protected function getIdItem($i)
    {
        return $this->id.'-menu-item-'.$i;
    }
}
