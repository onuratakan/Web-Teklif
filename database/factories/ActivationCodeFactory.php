<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ActivationCodeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' => 'EbEMGKWsBBwi9CicUtKnzn6Vu1E577cZ',
            'email' => 'can@can.com',
            'status' => 'active',

        ];
    }
}
