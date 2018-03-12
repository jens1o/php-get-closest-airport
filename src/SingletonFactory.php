<?php
declare(strict_types=1);

namespace jens1o\airport;

class SingletonFactory {

    /**
     * The storage of singletons
     *
     * @var SingletonFactory[]
     */
    protected static $__singletonObjects = [];

    final protected function __construct() {
        $this->init();
    }

    protected function init(): void {
        // does nothing, override this if you need to setup something
    }

    /**
     * Object cloning is disallowed.
     */
    final protected function __clone() {
        // does nothing
    }

    /**
     * Serializing singletons is not allowed!
     */
    final public function __sleep(): void {
        throw new \RuntimeException('Serializing singletons is not allowed!');
    }

    final public static function getInstance(): SingletonFactory {
        $className = get_called_class();

        // `isset` is used for faster lookup
        if (!isset(self::$__singletonObjects[$className]) || !array_key_exists($className, self::$__singletonObjects)) {
            self::$__singletonObjects[$className] = null;
            self::$__singletonObjects[$className] = new $className();
        } else if (null === self::$__singletonObjects[$className]) {
            throw new \RuntimeException('Infinite loop detected while trying to receive object for "' . $className . '"');
        }

        return self::$__singletonObjects[$className];
    }

}