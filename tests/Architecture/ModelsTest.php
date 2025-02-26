<?php

use Illuminate\Database\Eloquent\Model;

test('models extends base model')
    ->expect('App\Models')
    ->toExtend(Model::class);