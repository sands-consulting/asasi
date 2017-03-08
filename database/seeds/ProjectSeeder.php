<?php

use Carbon\Carbon;
use App\Project;
use App\ProjectMilestone;
use App\ProjectType;
use App\Permission;
use App\Role;
use App\Services\ProjectService;
use App\Services\ProjectMilestoneService;
use App\Services\ProjectTypeService;
use App\Services\PermissionService;
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

        $projectData = [
            [
                'name' => 'KERJA-KERJA KUTIPAN SAMPAH DI SELURUH KAWASAN PERUMAHAN, KOMERSIAL, KILANG, TONG BERPUSAT DAN KAWASAN BERKAITAN DI TAMAN PUCHONG UTAMA DAN PERINDUSTRIAN PUCHONG UTAMA, SELANGOR DARUL EHSAN UNTUK MAJLIS PERBANDARAN SUBANG JAYA BAGI TEMPOH DUA TAHUN',
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
            $project = ProjectService::create(new Project(), $project);
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
            $milestone = ProjectMilestoneService::create(new ProjectMilestone(), $milestone);
        }
    }
}
