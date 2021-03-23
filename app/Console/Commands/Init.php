<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class Init extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Init command application';

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
        $admin = new User();
        $admin->name = 'Webmaster';
        $admin->email = 'webmaster@example.ru';
        $admin->email_verified_at = date('U');
        $admin->password ='webmaster';

        $user = new User();
        $user->name = 'User';
        $user->email = 'User@example.ru';
        $user->email_verified_at = date('U');
        $user->password ='user';

        return $admin->save() && $user->save();
    }
}
