<?php

namespace Infotech\Data2Monthly;


class Monthly
{
    protected static function resolveFacade($name)
    {
        return app()[$name];
    }

    public static function __callStatic($method, $arguments)
    {
        return (self::resolveFacade('Monthly'))->$method(...$arguments);
    }
}
