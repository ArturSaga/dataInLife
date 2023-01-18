<?php

namespace App\Console\Commands;

use App\Http\Controllers\GroupController;
use Illuminate\Console\Command;

class UserCheckExpiration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:check_expiration';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Проверка времени нахождения пользователя в группе';

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
        $groupController->checkExpiration();
    }
}
