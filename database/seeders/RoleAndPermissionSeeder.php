<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $user = User::create([
            'name' => 'Admin 1',
            'email' => 'user@gmail.com',
            'password' => bcrypt('password123'),
            'email_verified_at' => date('Y-m-d H:i:s'),
        ]);

        $arrayOfPermissionNames = [
            'kas-besar view',
            'kas-besar add', 
            'kas-besar update',
            'kas-besar delete',
            'pengajuan-dana view',
            'pengajuan-dana add', 
            'pengajuan-dana update',
            'pengajuan-dana delete',
            'realisasi-dana view',
            'realisasi-dana add', 
            'realisasi-dana update',
            'realisasi-dana delete',
            'kwitansi view',
            'kwitansi add', 
            'kwitansi update',
            'kwitansi delete',
            'jurnal-harian view', 
            'jurnal-harian add', 
            'jurnal-harian update',
            'jurnal-harian delete',
            'jurnal-keuangan view', 
            'progress-keuangan view', 
            'progress-keuangan add', 
            'progress-keuangan update', 
            'progress-keuangan delete', 
            'aset-perusahaan view',
            'aset-perusahaan add',
            'aset-perusahaan update',
            'aset-perusahaan delete',
            'inventori-perusahaan view',
            'inventori-perusahaan add',
            'inventori-perusahaan update',
            'inventori-perusahaan delete',
            'laporan-kegiatan view',
            'laporan-kegiatan add',
            'laporan-kegiatan update',
            'laporan-kegiatan delete',
            'legalitas-perusahaan view',
            'legalitas-perusahaan add',
            'legalitas-perusahaan update',
            'legalitas-perusahaan delete',
            'sdm-perusahaan view',
            'sdm-perusahaan add',
            'sdm-perusahaan update',
            'sdm-perusahaan delete',
        ];

        $permissions = collect($arrayOfPermissionNames)->map(function ($permission) {
            return ['name' => $permission, 'guard_name' => 'web'];
        });

        $admin_permissions = collect($arrayOfPermissionNames)->map(function ($permission) {
            return ['name' => $permission, 'guard_name' => 'admin'];
        });
    
        Permission::insert($permissions->toArray());
        Permission::insert($admin_permissions->toArray());
        $list_permission = Permission::where([['guard_name', '=', 'admin']])->get();
        // dd($list_permission);
        $role = Role::create(['name' => 'Super Admin', 'guard_name' => 'admin']);
        $role->syncPermissions($list_permission);

        // $user->givePermissionTo([$arrayOfPermissionNames]);
        // $user->assignRole(['jurnal harian']);

        // dump('user has permission [jurnal-harian view]: '.$user->hasPermissionTo('jurnal-harian view'));
        // dump('user has permission [jurnal-harian add]: '.$user->hasPermissionTo('jurnal-harian add'));
        // dump('user has permission [jurnal-harian update]: '.$user->hasPermissionTo('jurnal-harian update'));
        // dump('user has permission [jurnal-harian delete]: '.$user->hasPermissionTo('jurnal-harian delete'));
    }
}
