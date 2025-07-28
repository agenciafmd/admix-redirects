<?php

namespace Agenciafmd\Redirects\Database\Factories;

use Agenciafmd\Redirects\Models\Redirect;
use Illuminate\Database\Eloquent\Factories\Factory;

class RedirectFactory extends Factory
{
    protected $model = Redirect::class;

    public function definition(): array
    {

        return [
            'is_active' => $this->faker->optional(0.2, 1)
                ->randomElement([0]),
            'type' => $this->faker->randomElement(collect(config('admix-redirects.types'))->keys()),
            'from' => '/' . $this->faker->word(),
            'to' => $this->faker->url,
        ];
    }
}