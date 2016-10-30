<?php

use Carbon\Carbon;
use App\Project;
use App\ProjectMilestone;
use App\ProjectType;
use App\Permission;
use App\Role;
use App\Repositories\ProjectsRepository;
use App\Repositories\ProjectMilestonesRepository;
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
        DB::table('project_milestones')->truncate();
        DB::table('project_user')->truncate();
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
            ],
            'project-milestone' => [
                'index' => 'List all project milstones',
                'show' => 'View project milstone details',
                'create' => 'Create new project milstone',
                'update' => 'Update existing project milstone',
                'delete' => 'Delete existing project milstone',
                'activate' => 'Activate project milstone',
                'deactivate' => 'Deactivate project milstone',
                'revisions' => 'View project milstone revisions',
                'logs' => 'View project milstone logs',
                'organization' => 'Allow to manage project milstone with organization'
            ]
        ];

        foreach ($permissions as $group => $data) {
            foreach($data as $action => $description) {
                $perm = PermissionsRepository::create(new Permission(), [
                    'name'          => $group . ':' . $action,
                    'description'   => $description
                ]);
                if ($action != 'organization')
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
                'progress' => '20',
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

        $milestoneData = [
            [
                'name' => 'Milestone 1',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Praesentium, soluta, id. Consectetur itaque, dignissimos, enim et delectus eligendi. Quaerat dolor unde fugit quam animi repudiandae minus tempore saepe quos ipsum.',
                'baseline_start' => Carbon::now()->subDays(16),
                'baseline_end' => Carbon::now()->subDays(2),
                'baseline_duration' => 14,
                'actual_start' => Carbon::now()->subDays(12),
                'actual_end' => Carbon::today(),
                'actual_duration' => '12',
                'variance' => 0.00,
                'payment_milestone' =>  1,
                'cost' => '20000.00',
                'project_id' => 1,
                'status' =>  'completed'
            ],
            [
                'name' => 'Milestone 2',
                'description' => 'Lorem 2 ipsum dolor sit amet, consectetur adipisicing elit. Praesentium, soluta, id. Consectetur itaque, dignissimos, enim et delectus eligendi. Quaerat dolor unde fugit quam animi repudiandae minus tempore saepe quos ipsum.',
                'baseline_start' => Carbon::now()->subDay(),
                'baseline_end' => Carbon::now()->addDays(13),
                'baseline_duration' => 14,
                'actual_start' => null,
                'actual_end' => null,
                'actual_duration' => null,
                'variance' => null,
                'payment_milestone' =>  1,
                'cost' => '20000.00',
                'project_id' => 1,
                'user_id' => 1,
                'status' =>  'active'
            ]
        ];

        foreach ($milestoneData as $milestone) {
            $milestone = ProjectMilestonesRepository::create(new ProjectMilestone(), $milestone);
        }
    }
}
