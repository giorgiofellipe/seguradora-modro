<?php

namespace Faderim\Core;

/**
 * Description of InstanceFactory
 *
 * @author Ricardo Schroeder
 */
class FaderimReflectionClass
{

    private $className;
    private $defaultMethod;
    private $reflectionClass;

    public function __construct($classDefault)
    {
        $positionMethod = strpos($classDefault, '.');
        if (false !== $positionMethod) {
            $this->defaultMethod = substr($classDefault, $positionMethod + 1);
            $classDefault = substr($classDefault, 0, $positionMethod);
        }
        $this->className = str_replace('::', '\\', $classDefault);
    }

    public function instance(Array $args = Array())
    {
        $instance = $this->getReflection()->newInstanceArgs($args);
        return $instance;
    }

    public static function callMethod($object, $methodName, Array $args = null)
    {
        if (is_null($args)) {
            return call_user_func(Array($object, $methodName));
        } else {
            return call_user_func_array(Array($object, $methodName), $args);
        }
    }

    public static function callProperty($object, $name, $type, $args = Array())
    {
        $match = null;
        if (preg_match('/(\w*)\/(.*)/', $name, $match)) {
            $objectNew = self::callProperty($object, $match[1], 'get');
            if ($objectNew !== null) {
                return self::callProperty($objectNew, $match[2], $type, $args);
            }
            return null;
        }
        return self::callMethod($object, $type . ucfirst($name), $args);
    }

    public static function callGetter($object, $name, Array $args = Array())
    {
        return self::callProperty($object, $name, 'get', $args);
    }

    public static function callSetter($object, $name, Array $args = Array())
    {
        return self::callProperty($object, $name, 'set', $args);
    }

    public function callDefaultMethod($object, Array $args = null)
    {
        return $this->callMethod($object, $this->defaultMethod, $args);
    }

    public function getDefaultMethod()
    {
        return $this->defaultMethod;
    }

    public function setDefaultMethod($defaultMethod)
    {
        $this->defaultMethod = $defaultMethod;
    }

    /**
     *
     * @return \ReflectionClass
     */
    private function getReflection()
    {
        if (!isset($this->reflectionClass)) {
            $this->reflectionClass = new \ReflectionClass($this->className);
        }
        return $this->reflectionClass;
    }

}
