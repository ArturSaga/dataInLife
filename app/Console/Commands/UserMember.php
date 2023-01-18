<?php

namespace App\Console\Commands;

use App\Http\Controllers\GroupController;
use Illuminate\Console\Command;

class UserMember extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:member';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Добавление пользователя в группу';

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
    public function handle(GroupController $groupController)
    {
        $user_id = $this->ask('Введите id пользователя');
        $group_id = $this->ask('Введите id группы');

        $groupController->addUser($user_id, $group_id);
    }
}
