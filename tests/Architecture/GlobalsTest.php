<?php

test('debug functions are not used')
    ->expect(['dd', 'ddd', 'die', 'dump', 'sleep'])
    ->toBeUsedInNothing();