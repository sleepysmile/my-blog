<?php

namespace App\Console\Commands;

use App\Singletons\SettingsManager;
use Illuminate\Console\Command;

class SettingsAppend extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'settings:append';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        /** @var SettingsManager $settingsManager */
        $settingsManager = app()->get(SettingsManager::SINGLETON_NAME);
        $settings = [
            [
                'option_name' => 'about.text',
                'option_type' => 'string'
            ],
            [
                'option_name' => 'contact.text',
                'option_type' => 'string'
            ],
        ];

        foreach ($settings as $setting) {
            if (!$settingsManager->exist($setting['option_name'])) {
                $settingsManager->set($setting['option_name'], '', $setting['option_type']);
            }
        }

        return 0;
    }
}
