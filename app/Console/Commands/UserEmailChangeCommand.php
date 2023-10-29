<?php

namespace App\Console\Commands;

use App\Interfaces\UserSettingsInterface;
use Illuminate\Console\Command;

class UserEmailChangeCommand extends Command
{
    protected UserSettingsInterface $userSettingsRepository;
    public function __construct(UserSettingsInterface $userSettingsRepository) {
        parent::__construct();
        $this->userSettingsRepository = $userSettingsRepository;
    }
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:change';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $expiredUserSettings = $this->userSettingsRepository->getExpiredEmailUsers();
        foreach ($expiredUserSettings as $userSettings) {
            $userSettings->update([
                'email_change_code' => null,
                'email_change_expire_date' => null,
                'preferred_email' => null,
            ]);
        }
        $this->info('Expired email change codes have been updated.');
    }
}
