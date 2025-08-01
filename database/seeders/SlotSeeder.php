<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Slot;
use Carbon\Carbon;

class SlotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $startDate = Carbon::today();
        $endDate = Carbon::today()->addDays(30);
        
        // Operating hours: 6 AM to 10 PM
        $startHour = 6;
        $endHour = 22;
        
        $currentDate = $startDate->copy();
        
        while ($currentDate <= $endDate) {
            for ($hour = $startHour; $hour < $endHour; $hour++) {
                $startTime = $currentDate->copy()->setTime($hour, 0, 0);
                $endTime = $currentDate->copy()->setTime($hour + 1, 0, 0);
                
                Slot::create([
                    'date' => $currentDate->format('Y-m-d'),
                    'start_time' => $startTime->format('H:i:s'),
                    'end_time' => $endTime->format('H:i:s'),
                    'is_available' => true,
                ]);
            }
            
            $currentDate->addDay();
        }
        
        // Create some additional random slots using factory
        Slot::factory(50)->create();
        
        $this->command->info('Slots created successfully for the next 30 days!');
        $this->command->info('Created structured hourly slots + 50 random slots');
    }
}
