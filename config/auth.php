<?php

return [

'guards' => [
    // ...
    'nasabah' => [
        'driver' => 'session',
        'provider' => 'nasabah_akuns',
    ],
],

'providers' => [
    // ...
    'nasabah_akuns' => [
        'driver' => 'eloquent',
        'model' => App\Models\NasabahAkun::class,
    ],
],


];
