<?php

declare(strict_types=1);

namespace DWenzel\Reporter;

/**
 * Trait for static method calls
 *
 * This is useful to make static method calls mock-able in tests.
 *
 * This trait must not be used more than once in a class hierarchy,
 * otherwise endless call loops occur for parent method calls.
 * See https://bugs.php.net/bug.php?id=48770 for details.
 */
trait CallStaticTrait
{
    /**
     * Performs a static method call
     *
     * Note that parent::class should be used instead of 'parent'
     * to refer to the actual parent class.
     */
    protected function callStatic(string $className, string $methodName, mixed ...$parameters): mixed
    {
        return $className::$methodName(...$parameters);
    }
}
