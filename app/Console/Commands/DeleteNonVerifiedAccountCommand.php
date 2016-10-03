<?php

namespace App\Console\Commands;

use App\User;
use App\Repositories\UsersRepository;
use Illuminate\Console\Command;

class DeleteNonVerifiedAccountCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:delete-non-verified';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete non-verified account after 3 days';

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
     * @return mixed
     */
    public function handle()
    {
        $this->comment(UsersRepository::deleteNonVerified(3));
    }
}
