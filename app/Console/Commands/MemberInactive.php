<?php

namespace App\Console\Commands;

use App\Library\Enum;
use App\Models\User;
use Illuminate\Console\Command;

class MemberInactive extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'member:inactive';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Member inactive after expire membership';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $today = now()->format('Y-m-d');
        $getUser = User::where('user_type', Enum::USER_TYPE_MEMBER)->where('membership_expired_at', '<', $today)->get();

        foreach($getUser as $data) {
            $data->update([
                'status' => (string) Enum::USER_STATUS_INACTIVE,
            ]);

            logger($data->status);
        }
    }
}
