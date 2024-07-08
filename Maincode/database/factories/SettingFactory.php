<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'logo' => '/storage/images/settings/logo.png',
            'email' => 'zquang.shop@gmail.com',
            'tel' => '+01 23.456.789',
            'address' => 'Hà Nội',
            'title' => 'Zquang.shop'
        ];
    }
}
