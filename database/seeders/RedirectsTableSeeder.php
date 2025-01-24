<?php

namespace Agenciafmd\Redirects\Database\Seeders;

use Agenciafmd\Redirects\Models\Redirect;
use Illuminate\Database\Seeder;

class RedirectsTableSeeder extends Seeder
{
    protected int $total = 20;

    public function run(): void
    {
        Redirect::query()
            ->truncate();

        $this->command->getOutput()
            ->progressStart($this->total);

        Redirect::factory($this->total)
            ->create()
            ->each(function () {
                $this->command->getOutput()
                    ->progressAdvance();
            });

        $this->command->getOutput()
            ->progressFinish();
    }
}
