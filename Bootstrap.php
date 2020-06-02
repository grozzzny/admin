<?php

namespace grozzzny\admin;

use grozzzny\admin\helpers\ClassMapHelper;
use grozzzny\admin\components\seo\AdminSeo;
use grozzzny\admin\modules\features\models\AdminFeatures;
use grozzzny\admin\modules\features\models\AdminFeaturesSearch;
use grozzzny\admin\modules\feedback\models\AdminFeedback;
use grozzzny\admin\modules\feedback\models\AdminFeedbackSearch;
use grozzzny\admin\modules\pages\models\AdminPages;
use grozzzny\admin\modules\pages\models\AdminPagesSearch;
use grozzzny\admin\modules\social_links\models\AdminSocialLinks;
use grozzzny\admin\modules\social_links\models\AdminSocialLinksSearch;
use grozzzny\admin\modules\testimonials\models\AdminTestimonials;
use grozzzny\admin\modules\testimonials\models\AdminTestimonialsSearch;
use grozzzny\admin\modules\text\models\AdminText;
use grozzzny\admin\modules\text\models\AdminTextSearch;
use Yii;
use yii\base\BootstrapInterface;
use yii\base\Exception;
use yii\base\InvalidConfigException;
use yii\base\Module;

/**
 * Bootstrap class of the yii2-usuario extension. Configures container services, initializes translations,
 * builds class map, and does the other setup actions participating in the application bootstrap process.
 */
class Bootstrap implements BootstrapInterface
{
    /**
     * {@inheritdoc}
     *
     * @throws InvalidConfigException
     */
    public function bootstrap($app)
    {
        if ($app->hasModule('admin') && $app->getModule('admin') instanceof Module) {
            $map = $this->buildClassMap($app->getModule('admin')->classMap);
            $this->initContainer($app, $map);
        }
    }

    /**
     * Initialize container with module classes.
     *
     * @param \yii\base\Application $app
     * @param array                 $map the previously built class map list
     */
    protected function initContainer($app, $map)
    {
        $cn = Yii::$container;

        try {
            $cn->set(AdminSeo::class);

            // features
            $cn->set(AdminFeatures::class);
            $cn->set(AdminFeaturesSearch::class);

            // feedback
            $cn->set(AdminFeedback::class);
            $cn->set(AdminFeedbackSearch::class);

            // pages
            $cn->set(AdminPages::class);
            $cn->set(AdminPagesSearch::class);

            // social_links
            $cn->set(AdminSocialLinks::class);
            $cn->set(AdminSocialLinksSearch::class);

            // testimonials
            $cn->set(AdminTestimonials::class);
            $cn->set(AdminTestimonialsSearch::class);

            // text
            $cn->set(AdminText::class);
            $cn->set(AdminTextSearch::class);

            // class map models + query classes
            $modelClassMap = [];
            foreach ($map as $class => $definition) {
                $cn->set($class, $definition);
                $model = is_array($definition) ? $definition['class'] : $definition;
                $modelClassMap[$class] = $model;
            }
            $cn->setSingleton(ClassMapHelper::class, ClassMapHelper::class, [$modelClassMap]);

        } catch (Exception $e) {
            die($e);
        }
    }

    /**
     * Builds class map according to user configuration.
     *
     * @param array $userClassMap user configuration on the module
     *
     * @throws Exception
     * @return array
     */
    protected function buildClassMap(array $userClassMap)
    {
        $map = [];

        $defaults = [
            'AdminSeo' => 'grozzzny\admin\components\seo\AdminSeo',

            'AdminFeatures' => 'grozzzny\admin\modules\features\models\AdminFeatures',
            'AdminFeaturesSearch' => 'grozzzny\admin\modules\features\models\AdminFeaturesSearch',

            'AdminFeedback' => 'grozzzny\admin\modules\feedback\models\AdminFeedback',
            'AdminFeedbackSearch' => 'grozzzny\admin\modules\feedback\models\AdminFeedbackSearch',

            'AdminPages' => 'grozzzny\admin\modules\pages\models\AdminPages',
            'AdminPagesSearch' => 'grozzzny\admin\modules\pages\models\AdminPagesSearch',

            'AdminSocialLinks' => 'grozzzny\admin\modules\social_links\models\AdminSocialLinks',
            'AdminSocialLinksSearch' => 'grozzzny\admin\modules\social_links\models\AdminSocialLinksSearch',

            'AdminTestimonials' => 'grozzzny\admin\modules\testimonials\models\AdminTestimonials',
            'AdminTestimonialsSearch' => 'grozzzny\admin\modules\testimonials\models\AdminTestimonialsSearch',

            'AdminText' => 'grozzzny\admin\modules\text\models\AdminText',
            'AdminTextSearch' => 'grozzzny\admin\modules\text\models\AdminTextSearch',
        ];

        $routes = [
            'grozzzny\admin\components\seo' => [
                'AdminSeo',
            ],
            'grozzzny\admin\modules\features\models' => [
                'AdminFeatures',
                'AdminFeaturesSearch',
            ],
            'grozzzny\admin\modules\feedback\models' => [
                'AdminFeedback',
                'AdminFeedbackSearch',
            ],
            'grozzzny\admin\modules\pages\models' => [
                'AdminPages',
                'AdminPagesSearch',
            ],
            'grozzzny\admin\modules\social_links\models' => [
                'AdminSocialLinks',
                'AdminSocialLinksSearch',
            ],
            'grozzzny\admin\modules\testimonials\models' => [
                'AdminTestimonials',
                'AdminTestimonialsSearch',
            ],
            'grozzzny\admin\modules\text\models' => [
                'AdminText',
                'AdminTextSearch',
            ],
        ];

        $mapping = array_merge($defaults, $userClassMap);

        foreach ($mapping as $name => $definition) {
            $map[$this->getRoute($routes, $name) . "\\$name"] = $definition;
        }

        return $map;
    }

    /**
     * Returns the parent class name route of a short class name.
     *
     * @param array  $routes class name routes
     * @param string $name
     *
     * @throws Exception
     * @return int|string
     *
     */
    protected function getRoute(array $routes, $name)
    {
        foreach ($routes as $route => $names) {
            if (in_array($name, $names, false)) {
                return $route;
            }
        }
        throw new Exception("Unknown configuration class name '{$name}'");
    }
}
