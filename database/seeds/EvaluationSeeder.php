<?php

use App\Permission;
use App\EvaluationType;
use App\EvaluationRequirement;
use App\Role;
use App\User;
use App\Repositories\EvaluationTypesRepository;
use App\Repositories\EvaluationRequirementsRepository;
use App\Repositories\RolesRepository;
use App\Repositories\UsersRepository;
use App\Repositories\PermissionsRepository;
use Illuminate\Database\Seeder;

class EvaluationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('evaluation_scores')->truncate();
        DB::table('evaluation_requirements')->truncate();
        DB::table('evaluation_types')->truncate();

        $role = RolesRepository::create(new Role(), [
            'name'          => 'evaluator',
            'display_name'  => 'Evaluator',
            'description'   => 'Evaluator.',
        ]);

        $user = UsersRepository::create(new User(), [
            'name'      => 'Evaluator',
            'email'     => 'evaluator@example.com',
            'password'  => app()->make('hash')->make('evaluator123'),
            'status'    => 'active',
        ]);

        // assign user to role
        $user->roles()->attach($role);

        $permissions = [
            ['evaluation:index', 'List of evaluator\'s notices.'],
            ['evaluation:evaluate', 'Evaluate submisssion.'],
            ['evaluation:settings', 'Evaluation Settings.']
        ];

        foreach ($permissions as $permissionData) {
            $perm = PermissionsRepository::create(new Permission(), [
                'name'        => $permissionData[0],
                'description' => $permissionData[1],
            ]);

            // assign all permission to admin role
            $perm->roles()->attach(Role::first());
        }

        // assign role to permission
        $role->permissions()->attach(Permission::whereGroup('evaluation')->lists('id')->toArray());
        $role->permissions()->attach(Permission::whereName('access:admin')->lists('id')->toArray());

        // Evaluation Type Data
        $evaluationTypeData = [
            [
                'name'   => 'Commercials',
            ],
            [
                'name'   => 'Technicals',
            ],
        ];

        foreach ($evaluationTypeData as $evaluationType) {
            EvaluationTypesRepository::create(new EvaluationType(), $evaluationType);
        }

        $evaluationRequirementData = [
            [
                "id" => 1,
                "sequence" => 1,
                "title" => "The Company has been in operation for at least 2 years.",
                "full_score" => 100,
                "mandatory" => 1,
                "evaluation_type_id" => 1,
                "notice_id" => 1,
                "status" => "active",
                "created_at" => "2016-10-19 19:18:36",
                "updated_at" => "2016-10-19 19:18:36",
                "deleted_at" => null
            ],
            [
                "id" => 2,
                "sequence" => 2,
                "title" => "The Company has a paid up capital of minimum RM 50,000",
                "full_score" => 100,
                "mandatory" => 1,
                "evaluation_type_id" => 1,
                "notice_id" => 1,
                "status" => "active",
                "created_at" => "2016-10-19 19:19:24",
                "updated_at" => "2016-10-19 19:19:24",
                "deleted_at" => null
            ],
            [
                "id" => 3,
                "sequence" => 3,
                "title" => "The Company has track record in developing or providing online application system.",
                "full_score" => 100,
                "mandatory" => 1,
                "evaluation_type_id" => 1,
                "notice_id" => 1,
                "status" => "active",
                "created_at" => "2016-10-19 19:20:14",
                "updated_at" => "2016-10-19 19:20:14",
                "deleted_at" => null
            ],
            [
                "id" => 4,
                "sequence" => 1,
                "title" => "The system should be able to process application and monthly claims of the following benefits:

    a) Travelling
    b) Medical
    c) Housing/Car/Personal Loan Interest Subsidy
    d) Overtime/Shift Allowance
    e) Advance payments
    f) Other benefits",
                "full_score" => 100,
                "mandatory" => 0,
                "evaluation_type_id" => 2,
                "notice_id" => 1,
                "status" => "active",
                "created_at" => "2016-10-19 19:23:52",
                "updated_at" => "2016-10-19 19:23:52",
                "deleted_at" => null
            ],
            [
                "id" => 5,
                "sequence" => 2,
                "title" => "The system must be a web based that is accesible from anywhere through internet browsers such as Google Chrome, Internet Explorer and Mozilla Firefox with internet access.",
                "full_score" => 100,
                "mandatory" => 0,
                "evaluation_type_id" => 2,
                "notice_id" => 1,
                "status" => "active",
                "created_at" => "2016-10-19 19:25:29",
                "updated_at" => "2016-10-19 19:25:29",
                "deleted_at" => null
            ],
            [
                "id" => 6,
                "sequence" => 3,
                "title" => "The system should be able to provide different levels of approval process based on HR and Finance requirement, where supervisors/Head of Department can recommend or not recommend applications/claims.",
                "full_score" => 80,
                "mandatory" => 0,
                "evaluation_type_id" => 2,
                "notice_id" => 1,
                "status" => "active",
                "created_at" => "2016-10-19 19:27:11",
                "updated_at" => "2016-10-19 19:27:11",
                "deleted_at" => null
            ],
            [
                "id" => 7,
                "sequence" => 4,
                "title" => "The system should be able to store and maintain database of employees and dependants.",
                "full_score" => 90,
                "mandatory" => 0,
                "evaluation_type_id" => 2,
                "notice_id" => 1,
                "status" => "active",
                "created_at" => "2016-10-19 19:28:10",
                "updated_at" => "2016-10-19 19:28:10",
                "deleted_at" => null
            ],
            [
                "id" => 8,
                "sequence" => 5,
                "title" => "The system should be designed to suit all user requirement with multiple configuration options.",
                "full_score" => 50,
                "mandatory" => 0,
                "evaluation_type_id" => 2,
                "notice_id" => 1,
                "status" => "active",
                "created_at" => "2016-10-19 19:28:59",
                "updated_at" => "2016-10-19 19:28:59",
                "deleted_at" => null
            ],
            [
                "id" => 9,
                "sequence" => 6,
                "title" => "The system should be able to track benefits usage made by each staff and produce reports.",
                "full_score" => 100,
                "mandatory" => 0,
                "evaluation_type_id" => 2,
                "notice_id" => 1,
                "status" => "active",
                "created_at" => "2016-10-19 19:29:48",
                "updated_at" => "2016-10-19 19:29:48",
                "deleted_at" => null
            ],
            [
                "id" => 10,
                "sequence" => 7,
                "title" => "The system must be integrated with ST's current in-house finacial system (Standard Accounting for Government Agencies - SAGA) and attendance system.",
                "full_score" => 100,
                "mandatory" => 0,
                "evaluation_type_id" => 2,
                "notice_id" => 1,
                "status" => "active",
                "created_at" => "2016-10-19 19:31:13",
                "updated_at" => "2016-10-19 19:31:13",
                "deleted_at" => null
            ],
            [
                "id" => 11,
                "sequence" => 4,
                "title" => "The system should be able to process application and monthly claims of the following benefits:

    a) Travelling
    b) Medical
    c) Housing/Car/Personal Loan Interest Subsidy
    d) Overtime/Shift Allowance
    e) Advance payments
    f) Other benefits",
                "full_score" => 100,
                "mandatory" => 0,
                "evaluation_type_id" => 1,
                "notice_id" => 1,
                "status" => "active",
                "created_at" => "2016-10-19 19:23:52",
                "updated_at" => "2016-10-19 19:23:52",
                "deleted_at" => null
            ],
            [
                "id" => 12,
                "sequence" => 5,
                "title" => "The system must be a web based that is accesible from anywhere through internet browsers such as Google Chrome, Internet Explorer and Mozilla Firefox with internet access.",
                "full_score" => 100,
                "mandatory" => 0,
                "evaluation_type_id" => 1,
                "notice_id" => 1,
                "status" => "active",
                "created_at" => "2016-10-19 19:25:29",
                "updated_at" => "2016-10-19 19:25:29",
                "deleted_at" => null
            ],
            [
                "id" => 13,
                "sequence" => 6,
                "title" => "The system should be able to provide different levels of approval process based on HR and Finance requirement, where supervisors/Head of Department can recommend or not recommend applications/claims.",
                "full_score" => 80,
                "mandatory" => 0,
                "evaluation_type_id" => 1,
                "notice_id" => 1,
                "status" => "active",
                "created_at" => "2016-10-19 19:27:11",
                "updated_at" => "2016-10-19 19:27:11",
                "deleted_at" => null
            ],
            [
                "id" => 14,
                "sequence" => 7,
                "title" => "The system should be able to store and maintain database of employees and dependants.",
                "full_score" => 90,
                "mandatory" => 0,
                "evaluation_type_id" => 1,
                "notice_id" => 1,
                "status" => "active",
                "created_at" => "2016-10-19 19:28:10",
                "updated_at" => "2016-10-19 19:28:10",
                "deleted_at" => null
            ],
            [
                "id" => 15,
                "sequence" => 8,
                "title" => "The system should be designed to suit all user requirement with multiple configuration options.",
                "full_score" => 50,
                "mandatory" => 0,
                "evaluation_type_id" => 1,
                "notice_id" => 1,
                "status" => "active",
                "created_at" => "2016-10-19 19:28:59",
                "updated_at" => "2016-10-19 19:28:59",
                "deleted_at" => null
            ],
            [
                "id" => 16,
                "sequence" => 9,
                "title" => "The system should be able to track benefits usage made by each staff and produce reports.",
                "full_score" => 100,
                "mandatory" => 0,
                "evaluation_type_id" => 1,
                "notice_id" => 1,
                "status" => "active",
                "created_at" => "2016-10-19 19:29:48",
                "updated_at" => "2016-10-19 19:29:48",
                "deleted_at" => null
            ],
            [
                "id" => 17,
                "sequence" => 10,
                "title" => "The system must be integrated with ST's current in-house finacial system (Standard Accounting for Government Agencies - SAGA) and attendance system.",
                "full_score" => 100,
                "mandatory" => 0,
                "evaluation_type_id" => 1,
                "notice_id" => 1,
                "status" => "active",
                "created_at" => "2016-10-19 19:31:13",
                "updated_at" => "2016-10-19 19:31:13",
                "deleted_at" => null
            ]
        ];

        foreach ($evaluationRequirementData as $evaluationRequirement) {
            EvaluationRequirementsRepository::create(new EvaluationRequirement(), $evaluationRequirement);
        }
    }
}
