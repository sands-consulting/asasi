<?php

use App\Services\SubmissionItemService;
use App\Submission;
use App\SubmissionDetail;
use App\SubmissionItem;
use App\SubmissionRequirement;
use App\Services\SubmissionService;
use App\Services\SubmissionDetailService;
use App\Services\SubmissionRequirementService;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class SubmissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('submission_requirements')->truncate();
        DB::table('submissions')->truncate();
        DB::table('submission_details')->truncate();
        DB::table('submission_items')->truncate();


        $requirements = [
            [
                "id" => 1,
                "sequence" => 1,
                "title" => "Repairs and Maintenance Services Including Electrical Reticulation and Lighting, Air Conditioning Systems, Mechanical Maintenance, Plumbing and Drainage, Minor and Major Civil works, Building Maintenance, SeweragePlants, Water Treatment Plants, Shop-fitti",
                "field_required" => 1,
                "field_type" => "checkbox",
                "notice_id" => 1,
                "type_id" => 1,
                "status" => "active",
                "created_at" => "2016-10-19 17:26:17",
                "updated_at" => "2016-10-19 17:26:17",
                "deleted_at" => null
            ],
            [
                "id" => 2,
                "sequence" => 2,
                "title" => "Maintenance, Inspections, Edging, Watering, Topdressing, Replacement of Grass, Indoor Plants etc., Garden Services",
                "field_required" => 0,
                "field_type" => "file",
                "notice_id" => 1,
                "type_id" => 1,
                "status" => "active",
                "created_at" => "2016-10-19 18:33:24",
                "updated_at" => "2016-10-19 18:33:24",
                "deleted_at" => null
            ],
            [
                "id" => 3,
                "sequence" => 3,
                "title" => "Reception, Switch Board manning, Postal, Franking, and Printing, Office Services (Manning the Boardrooms, Audio Visual and Electronics, Handyman Services, Voicemail, Water Feature, Pest Control.",
                "field_required" => 1,
                "field_type" => "checkbox",
                "notice_id" => 1,
                "type_id" => 1,
                "status" => "active",
                "created_at" => "2016-10-19 18:34:37",
                "updated_at" => "2016-10-19 18:34:37",
                "deleted_at" => null
            ],
            [
                "id" => 4,
                "sequence" => 4,
                "title" => "General Cleaning Services, Offices, Passageways, Toilets, Reception Areas, Outside Cleaning Areas. Linen Rooms, Auditoriums, Domestic Waste Management, Deep Cleaning, Hygiene. Supply all consumables",
                "field_required" => 0,
                "field_type" => "checkbox",
                "notice_id" => 1,
                "type_id" => 1,
                "status" => "active",
                "created_at" => "2016-10-19 18:35:56",
                "updated_at" => "2016-10-19 18:35:56",
                "deleted_at" => null
            ],
            [
                "id" => 5,
                "sequence" => 5,
                "title" => "Manning of all the Call centers, includes the following services: Answering calls by call center operators in the employ of the contractor on the building maintenance services required by Eskom during the term of the contract. Includes receiving defaults ",
                "field_required" => 0,
                "field_type" => "checkbox",
                "notice_id" => 1,
                "type_id" => 1,
                "status" => "active",
                "created_at" => "2016-10-19 18:36:54",
                "updated_at" => "2016-10-19 18:37:07",
                "deleted_at" => null
            ],
            [
                "id" => 6,
                "sequence" => 1,
                "title" => "Repairs and Maintenance Services Including Electrical Reticulation and Lighting, Air Conditioning Systems, Mechanical Maintenance, Plumbing and Drainage, Minor and Major Civil works, Building Maintenance, SeweragePlants, Water Treatment Plants, Shop-fitti",
                "field_required" => 1,
                "field_type" => "checkbox",
                "notice_id" => 1,
                "type_id" => 2,
                "status" => "active",
                "created_at" => "2016-10-19 17:26:17",
                "updated_at" => "2016-10-19 17:26:17",
                "deleted_at" => null
            ],
            [
                "id" => 7,
                "sequence" => 2,
                "title" => "Maintenance, Inspections, Edging, Watering, Topdressing, Replacement of Grass, Indoor Plants etc., Garden Services",
                "field_required" => 0,
                "field_type" => "file",
                "notice_id" => 1,
                "type_id" => 2,
                "status" => "active",
                "created_at" => "2016-10-19 18:33:24",
                "updated_at" => "2016-10-19 18:33:24",
                "deleted_at" => null
            ],
            [
                "id" => 8,
                "sequence" => 3,
                "title" => "General Cleaning Services, Offices, Passageways, Toilets, Reception Areas, Outside Cleaning Areas. Linen Rooms, Auditoriums, Domestic Waste Management, Deep Cleaning, Hygiene. Supply all consumables",
                "field_required" => 0,
                "field_type" => "checkbox",
                "notice_id" => 1,
                "type_id" => 2,
                "status" => "active",
                "created_at" => "2016-10-19 18:35:56",
                "updated_at" => "2016-10-19 18:35:56",
                "deleted_at" => null
            ],
            [
                "id" => 9,
                "sequence" => 4,
                "title" => "Reception, Switch Board manning, Postal, Franking, and Printing, Office Services (Manning the Boardrooms, Audio Visual and Electronics, Handyman Services, Voicemail, Water Feature, Pest Control.",
                "field_required" => 0,
                "field_type" => "file",
                "notice_id" => 1,
                "type_id" => 2,
                "status" => "active",
                "created_at" => "2016-10-19 18:35:56",
                "updated_at" => "2016-10-19 18:35:56",
                "deleted_at" => null
            ],
            [
                "id" => 10,
                "sequence" => 5,
                "title" => "Manning of all the Call centers, includes the following services: Answering calls by call center operators in the employ of the contractor on the building maintenance services required by Eskom during the term of the contract. Includes receiving defaults ",
                "field_required" => 0,
                "field_type" => "checkbox",
                "notice_id" => 1,
                "type_id" => 2,
                "status" => "active",
                "created_at" => "2016-10-19 18:36:54",
                "updated_at" => "2016-10-19 18:37:07",
                "deleted_at" => null
            ],
        ];

        foreach ($requirements as $requirement) {
            SubmissionRequirementService::create(new SubmissionRequirement(), $requirement);
        }

        $submissions = [
            [
                'price'       => '500000',
                'purchase_id' =>  1,
                'vendor_id'   => 1,
                'status'      => 'pending',
            ]
        ];

        foreach ($submissions as $submission) {
            SubmissionService::create(new Submission(), $submission);
        }

        $details = [
            [
                'submission_id' => 1,
                'type_id'       =>  1,
                'status'        => 'completed',
                'completed_at'  => Carbon::now(),
            ],
            [
                'submission_id' => 1,
                'type_id'       => 2,
                'status'        => 'pending',
            ],
        ];

        foreach ($details as $detail) {
            SubmissionDetailService::create(new SubmissionDetail, $detail);
        }

        $items = [
            [
                'value'          => 1,
                'detail_id'      => 1,
                'requirement_id' =>  1,
            ],
            [
                'value'          => null,
                'detail_id'      => 1,
                'requirement_id' =>  2,
            ],
            [
                'value'          => 1,
                'detail_id'      => 1,
                'requirement_id' =>  3,
            ],
            [
                'value'          => 1,
                'detail_id'      => 1,
                'requirement_id' =>  4,
            ],
            [
                'value'          => null,
                'detail_id'      => 1,
                'requirement_id' =>  5,
            ],
            [
                'value'          => 1,
                'detail_id'      => 2,
                'requirement_id' =>  6,
            ],
            [
                'value'          => null,
                'detail_id'      => 2,
                'requirement_id' =>  7,
            ],
            [
                'value'          => 1,
                'detail_id'      => 2,
                'requirement_id' =>  8,
            ],
            [
                'value'          => null,
                'detail_id'      => 2,
                'requirement_id' =>  9,
            ],
            [
                'value'          => null,
                'detail_id'      => 2,
                'requirement_id' =>  10,
            ],
        ];

        foreach ($items as $item) {
            SubmissionItemService::create(new SubmissionItem, $item);
        }
    }
}
