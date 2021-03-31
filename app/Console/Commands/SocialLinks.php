<?php

namespace App\Console\Commands;

use App\Singletons\SettingsManager;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;

class SocialLinks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:links';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command created links';

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
        $links = [
            [
                'option_name' => 'fb.link',
                'option_type' => 'string'
            ],
            [
                'option_name' => 'tw.link',
                'option_type' => 'string'
            ],
            [
                'option_name' => 'bs.link',
                'option_type' => 'string'
            ],
            [
                'option_name' => 'pa.link',
                'option_type' => 'string'
            ],
        ];
        /** @var SettingsManager $settingsManager */
        $settingsManager = app()->get(SettingsManager::SINGLETON_NAME);

        foreach ($links as $link) {
            $settingsManager->set($link['option_name'], '', $link['option_type']);
        }

        return 0;
    }
}
