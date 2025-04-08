<?php

declare(strict_types = 1);

use Illuminate\Database\Eloquent\Model;

arch()->preset()->php();
arch()->preset()->strict();
arch()->preset()->laravel();
arch()->preset()->security();

test('debug functions are not used')
    ->expect(['dd', 'ddd', 'die', 'dump', 'sleep'])
    ->toBeUsedInNothing();

test('models extends base model')
    ->expect('App\Models')
    ->toExtend(Model::class);
