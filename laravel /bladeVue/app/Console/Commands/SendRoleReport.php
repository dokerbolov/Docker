<?php

namespace App\Console\Commands;

use App\Http\Repositories\RoleRepository;
use App\Http\Services\RoleService;
use App\Models\User;
use App\Traits\MailTrait;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;

class SendRoleReport extends Command
{
    use MailTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sendRoleReport';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sending report of roles for users';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $roleRepository = new RoleRepository();
        $roleService = new RoleService($roleRepository);

        $user = User::where('email', '=', "adokerbolov@mail.ru")->first();
        $page = 1;

        $data = $roleService->get($page);
        try {
            $this->sendReportEmail([$user], [], $data, $page);
            Log::info('successfully executed role list command');
        } catch (\Exception $e) {
            Log::error($e);
        }
    }
}
