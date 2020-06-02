<?php

namespace grozzzny\admin\helpers;

use yii\base\InvalidArgumentException;

class ClassMapHelper
{
    protected $map = [];

    /**
     * ModelClassMapHelper constructor.
     *
     * @param array $map
     */
    public function __construct($map = [])
    {
        $this->map = $map;
    }

    /**
     * @param $key
     * @param $class
     */
    public function set($key, $class)
    {
        $this->map[$key] = $class;
    }

    /**
     * @param $key
     *
     * @throws \InvalidArgumentException
     * @return mixed
     *
     */
    public function get($key)
    {
        if (array_key_exists($key, $this->map)) {
            return $this->map[$key];
        }
        throw new InvalidArgumentException('Unknown model map key: ' . $key);
    }
}
