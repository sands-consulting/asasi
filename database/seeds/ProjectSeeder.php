<?php

use App\Project;
use App\ProjectType;
use App\Permission;
use App\Role;
use App\Repositories\ProjectsRepository;
use App\Repositories\ProjectTypesRepository;
use App\Repositories\PermissionsRepository;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('projects')->truncate();

        $permissions = [
            'project' => [
                'index' => 'List all projects',
                'show' => 'View project details',
                'create' => 'Create new project',
                'update' => 'Update existing project',
                'delete' => 'Delete existing project',
                'activate' => 'Activate project',
                'deactivate' => 'Deactivate project',
                'revisions' => 'View project revisions',
                'logs' => 'View project logs',
                'organization' => 'Allow to manage project with organization'
            ]
        ];

        foreach ($permissions as $group => $data) {
            foreach($data as $action => $description) {
                $perm = PermissionsRepository::create(new Permission(), [
                    'name'          => $group . ':' . $action,
                    'description'   => $description
                ]);
                if ($action != 'oraganization')
                    $perm->roles()->attach(Role::first());
            }
        }

        $projectData = [
            [
                'name' => 'CADANGAN KERJA-KERJA KUTIPAN SAMPAH DI SELURUH KAWASAN PERUMAHAN, KOMERSIAL, KILANG, TONG BERPUSAT DAN KAWASAN BERKAITAN DI TAMAN PUCHONG UTAMA DAN PERINDUSTRIAN PUCHONG UTAMA, SELANGOR DARUL EHSAN UNTUK MAJLIS PERBANDARAN SUBANG JAYA BAGI TEMPOH DUA (2) TAHUN + 1 TAHUN',
                'number' => 'MPSJ.KUB.400-10/3/69 (2016)',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Praesentium, soluta, id. Consectetur itaque, dignissimos, enim et delectus eligendi. Quaerat dolor unde fugit quam animi repudiandae minus tempore saepe quos ipsum.',
                'contact_name' => 'Sufian Bin Khalid',
                'contact_position' => 'Manager',
                'contact_email' => 'manager@project.com',
                'contact_phone' => '+60123456789',
                'contact_fax' => '+60345678912',
                'cost' => '100000.00',
                'notice_id' =>  1,
                'organization_id' => 1,
                'vendor_id' => 1,
                'status' =>  'active'
            ]
        ];

        foreach ($projectData as $project) {
            $project = ProjectsRepository::create(new Project(), $project);
            $project->allocations()->attach(1, ['status' => 'active']);
            $project->users()->attach(1, ['position' => 'manager', 'status' => 'active']);
        }
    }
}
