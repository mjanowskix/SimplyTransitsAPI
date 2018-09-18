<?php

$app->route(['GET','POST'], '/transits', App\Controllers\TransitsController::class)->setName('transits');
