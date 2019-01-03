<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

   /*  'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],*/

    /*    'paypal' => [
    'client_id' => 'AbCSK8yuqkHe_JzMvQFMcuD8tNWRIWQ1d4hqUlWeEafnBswJPTUg5gNNY2wCml9KnSrcbeghG1Unc35i',
    'secret' => 'EOD-FPl8iRqlvYMP-47E3eF3KMgJ3pi41RX2Neor-iLAIXII_G99qAnayYhlUNyDNbRH_hXiqkeAy2L2',
],*/
    'paypal' => [
    'username' => 'AbCSK8yuqkHe_JzMvQFMcuD8tNWRIWQ1d4hqUlWeEafnBswJPTUg5gNNY2wCml9KnSrcbeghG1Unc35i',
    'password' => 'EOD-FPl8iRqlvYMP-47E3eF3KMgJ3pi41RX2Neor-iLAIXII_G99qAnayYhlUNyDNbRH_hXiqkeAy2L2',
    'signature'=>'',
    'sandbox'=> true
],
    'facebook'=>[
    'client_id'=>'1921330464776521',
    'client_secret'=>'462f0240c9709b6e95b891729c4ecf2a',
    'redirect'=>'http://localhost:8000/callback',
    ],


    'twitter'=>[
    'client_id'=>'If6rR0aXmrMcy98cnfoIDWVbK',
    'client_secret'=>'up6FeUmbEOQWOnZLIBtKS6BTEjA1poIhUHPeEkuTlVUJkySC34',
    'redirect'=>'http://127.0.0.1:8000/callback',
    ],

];
