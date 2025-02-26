<?php

declare(strict_types = 1);

test('debug functions are not used')
    ->expect(['dd', 'ddd', 'die', 'dump', 'sleep'])
    ->toBeUsedInNothing();
