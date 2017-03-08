<?php

use App\Notice;
use App\Permission;
use App\Subscription;
use App\Services\NoticeService;
use App\Services\PermissionService;
use Illuminate\Database\Seeder;

class NoticeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('notices')->truncate();

        $noticeData = [
            [
                'name' => 'SEBUT HARGA MEMBEKAL DAN MENGHANTAR BAHAN BINAAN, PERALATAN MENTERNAK, BAKA TERNAKAN, MAKANAN TERNAKAN DAN PELBAGAI BAGI PESERTA GENERASI MUDA (AGROGEMS) TAHUN 2016 DI BAWAH JABATAN PERKHIDMATAN VETERINAR NEGERI SELANGOR',
                'number' => 'JPV-SEL(S)400/61/73',
                'description' =>  'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam eveniet aspernatur cum voluptas ipsam nostrum explicabo! Sunt dignissimos architecto numquam modi. Deserunt, impedit, recusandae. Quod itaque necessitatibus fugit quas veritatis.',
                'rules' =>  'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam eveniet aspernatur cum voluptas ipsam nostrum explicabo! Sunt dignissimos architecto numquam modi. Deserunt, impedit, recusandae. Quod itaque necessitatibus fugit quas veritatis.',
                'price' =>  '250.00',
                'published_at' => '2016-08-01',
                'expired_at' => '2017-08-01',
                'purchased_at' => '2016-10-01',
                'submission_at' => '2016-12-01',
                'submission_address' => 'Address 1',
                'notice_type_id' => '1',
                'organization_id' => '1',
                'status' => 'published'
            ],
            [
                'name' => 'KERJA-KERJA PENSTABILAN TEBING DI PEJABAT JURUTERA DAERAH KUALA LANGAT SELANGOR DARUL EHSAN',
                'number' => 'JKR/K.LGT/BIL001/2016',
                'description' =>  'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam eveniet aspernatur cum voluptas ipsam nostrum explicabo! Sunt dignissimos architecto numquam modi. Deserunt, impedit, recusandae. Quod itaque necessitatibus fugit quas veritatis.',
                'rules' =>  'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam eveniet aspernatur cum voluptas ipsam nostrum explicabo! Sunt dignissimos architecto numquam modi. Deserunt, impedit, recusandae. Quod itaque necessitatibus fugit quas veritatis.',
                'price' =>  '150.00',
                'published_at' => '2016-08-01',
                'expired_at' => '2017-08-01',
                'purchased_at' => '2016-10-01',
                'submission_at' => '2016-12-01',
                'submission_address' => 'Address 2',
                'notice_type_id' => '2',
                'organization_id' => '1',
                'status' => 'draft'
            ],
        ];

        foreach ($noticeData as $notice) {
            NoticeService::create(new Notice(), $notice);
        }
    }
}
