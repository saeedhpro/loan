<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         \App\Models\User::factory(10)->create();

//        /** @var User $user */
//        $user = User::factory()->create([
//             'name' => 'مدیرکل',
//             'username' => 'admin',
//             'role' => 'admin',
//             'password' => Hash::make('password'),
//         ]);
//        $permissions = collect([]);
//        $permissionList = [
//            [
//                'permission' => 'index_employers',
//                'title' => 'مشاهده کارمندان',
//            ],
//            [
//                'permission' => 'create_employer',
//                'title' => 'افزودن کارمند',
//            ],
//            [
//                'permission' => 'delete_employer',
//                'title' => 'حذف کارمند',
//            ],
//            [
//                'permission' => 'edit_employer',
//                'title' => 'ویرایش کارمند',
//            ],
//            [
//                'permission' => 'request_loan',
//                'title' => 'درخواست وام',
//            ],
//            [
//                'permission' => 'index_request_loans',
//                'title' => 'مشاهده درخواست های وام',
//            ],
//            [
//                'permission' => 'accept_reject_loan',
//                'title' => 'تایید/رد درخواست وام',
//            ]
//        ];
//        foreach ($permissionList as $p) {
//            $permission = Permission::create([
//                'permission' => $p['permission'],
//                'title' => $p['title'],
//            ]);
//            $permissions->add($permission);
//        }
//
//         $user->permissions()->sync($permissions->pluck('id'));
    }
}
