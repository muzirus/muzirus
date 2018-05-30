<?php declare(strict_types=1);

namespace App\Twig\Extension;

class InstanceOfExtension extends \Twig_Extension
{
    public function getTests(): array
    {
        return [
            new \Twig_SimpleTest('instanceOf', function ($var, $instance) {
                return $this->isInstanceOf($var, $instance);
            }),
        ];
    }

    public function isInstanceOf($var, $instance): bool
    {
        /** @noinspection PhpUnhandledExceptionInspection */
        $reflexionClass = new \ReflectionClass($instance);

        return $reflexionClass->isInstance($var);
    }
}
