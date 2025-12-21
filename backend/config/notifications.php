<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Notification Settings
    |--------------------------------------------------------------------------
    |
    | Here you may configure the settings for notifications such as email,
    | SMS, and push notifications. You can set default channels, templates,
    | and other related options.
    |
    */

    'channels' => ['database', 'email', 'sms', 'realtime'],


    'types' => [
        'order_created' => [
            'label' => 'Order Created',
            'channels' => ['database', 'email','realtime'],
            'template' => 'orders.created',
            'icon'     => 'fa fa-shopping-cart',
        ],
        'order_shipped' => [
            'label' => 'order Shipped',
            'channels' => ['database', 'email','realtime'],
            'template' => 'orders.shipped',
            'icon'     => 'fa fa-truck',
        ],
        'order_delivered' => [
            'label' => 'Order Delivered',
            'channels' => ['database', 'email','realtime'],
            'template' => 'orders.delivered',
            'icon'     => 'fa fa-box-open',
        ],
        'promotional_offer' => [
            'label' => 'Promotional Offer',
            'channels' => ['email', 'sms','realtime'],
            'template' => 'promotions.offer',
            'icon'     => 'fa fa-tags',
        ],
        'payment.failed' => [
            'label' => 'Payment Failed',
            'channels' => ['database', 'email','realtime'],
            'template' => 'payments.failed',
            'icon'     => 'fa fa-exclamation-triangle',
        ],
        'stock.available' => [
            'label' => 'Stock Available',
            'channels' => ['email','realtime'],
            'template' => 'stock.available',
            'icon'     => 'fa fa-boxes',
        ],
    ],

    'templates' => [
        'default_from' => 'noreply@ecommerce.local',
        'default_subject' => 'E-Commerce Store',
    ],

    'retry' => [
        'max_attempts' => 3,
        'delay' => 60, // in milliseconds
        'backoff' => true,
    ],

    'tracking' => [
        'enable' => true,
        'log_failed' => true,
        'retention_days' => 30,
    ]

];
