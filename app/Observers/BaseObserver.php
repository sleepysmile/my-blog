<?php


namespace App\Observers;


use App\Models\User;
use Illuminate\Support\Facades\Auth;

/**
 * Class BaseObserver
 * @package App\Observers
 *
 * @property null|User $user
 */
class BaseObserver
{
    /** @var User|null  */
    protected ?User $user;

    public function __construct()
    {
        $user = Auth::guard('web')->user() !== null
            ? Auth::guard('web')->user()
            : Auth::guard('backpack')->user();
        $this->user = $user;
    }

    /**
     * @return bool
     */
    protected function isUser()
    {
        return ($this->user !== null);
    }

}
