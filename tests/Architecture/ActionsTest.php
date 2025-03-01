<?php

declare(strict_types=1);

use Symfony\Component\Finder\Finder;

test('all actions have a handle method', function () {
    $finder = new Finder();
    $finder->files()->in(app_path('Actions'))->name('*.php');

    foreach ($finder as $file) {
        $relativePath = $file->getRelativePathname();
        $class = 'App\\Actions\\' . str_replace(['/', '.php'], ['\\', ''], $relativePath);

        if (!class_exists($class)) {
            require_once $file->getRealPath();
        }

        $hasHandleMethod = (new ReflectionClass($class))->hasMethod('handle');
        expect($hasHandleMethod)
            ->toBeTrue("The class {$class} does not have a handle() method.");
    }
});
