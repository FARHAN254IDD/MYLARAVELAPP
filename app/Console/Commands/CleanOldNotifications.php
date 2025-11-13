<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Carbon\Carbon;

class CleanOldNotifications extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'notifications:clean';

    /**
     * The console command description.
     */
    protected $description = 'Delete blogger notifications older than 7 days';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $cutoff = Carbon::now()->subDays(7);

        $users = User::all();

        foreach ($users as $user) {
            if (isset($user->notifications) && is_array($user->notifications)) {
                $newNotifications = collect($user->notifications)
                    ->filter(function ($note) use ($cutoff) {
                        return Carbon::parse($note['time'])->greaterThanOrEqualTo($cutoff);
                    })
                    ->values()
                    ->toArray();

                if (count($newNotifications) !== count($user->notifications)) {
                    $user->notifications = $newNotifications;
                    $user->save();
                }
            }
        }

        $this->info('✅ Old notifications (older than 7 days) have been cleaned.');
    }
}
