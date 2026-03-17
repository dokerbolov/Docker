<?php

namespace App\Http\Controllers;

use App\Http\Services\RoleService;
use App\Models\User;
use App\Traits\MailTrait;
use Spatie\Permission\Models\Role;

class TestController extends Controller
{
    use MailTrait;

    public RoleService $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    public function test() {
        for($i = 10; $i < 1000; $i++) {
            Role::create([
                'name' => "asd:$i"
            ]);
        }

        dd('finish');
    }

    public function test2() {
        $user = User::where('email', '=', "adokerbolov@mail.ru")->first();
        $user2 = User::where('email', '=', "proface19@gmail.com")->first();
        $this->sendBitrhdayEmail($user, [$user2]);
    }

    public function test3() {
        $user = User::where('email', '=', "adokerbolov@mail.ru")->first();
        $page = 1;
        $data = $this->roleService->get($page);
        try {
            $this->sendReportEmail([$user], [], $data, $page);
            return response()->json('Successfully sended email');
        } catch (\Exception $e) {
            return response()->json("Something went wrong $e");
        }
    }
}
