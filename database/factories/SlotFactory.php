<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Slot>
 */
class SlotFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $date = $this->faker->dateTimeBetween('now', '+30 days');
        $startHour = $this->faker->numberBetween(6, 20); // 6 AM to 8 PM
        $startTime = Carbon::parse($date)->setTime($startHour, 0, 0);
        $endTime = $startTime->copy()->addHour();

        return [
            'date' => $date->format('Y-m-d'),
            'start_time' => $startTime->format('H:i:s'),
            'end_time' => $endTime->format('H:i:s'),
            'is_available' => $this->faker->boolean(80), // 80% chance of being available
        ];
    }
}
