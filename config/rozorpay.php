<?php

/*
 * This file is part of the Laravel Paystack package.
 *
 * (c) Prosper Otemuyiwa <prosperotemuyiwa@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [

    /**
     * Public Key From Rozor Pay Dashboard
     *
     */
    'razor_key' => getenv('RAZORPAY_KEY'),

    /**
     * Secret Key From Rozor Pay Dashboard
     *
     */
    'razor_secret' => getenv('RAZORPAY_SECRET'),

];
