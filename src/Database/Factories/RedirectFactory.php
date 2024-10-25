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
            'star' => $this->faker->optional(0.2, 1)
                ->randomElement([0]),
            'from' => '/' . $this->faker->word(),
            'to' => $this->faker->url,
            'type' => $this->faker->randomElement(collect(config('admix-redirects.options.types'))->keys()),
            'sort' => null,
        ];
    }
}