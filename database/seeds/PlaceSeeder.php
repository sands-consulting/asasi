<?php

use App\Place;
use App\Services\PlaceService;
use Illuminate\Database\Seeder;

class PlaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('places')->truncate();
        $places = [
            ['MALAYSIA', 'MY', 'MAS', 'country', null], #1

            ['JOHOR', null, 'JHR', 'state', 1], #2
            ['KEDAH', null, 'KDH', 'state', 1], #3
            ['KELANTAN', null, 'KEL', 'state', 1], #4
            ['WP KUALA LUMPUR', null, 'KUL', 'state', 1], #5
            ['WP LABUAN', null, 'LBN', 'state', 1], #6
            ['MELAKA', null, 'MEL', 'state', 1], #7
            ['NEGERI SEMBILAN', null, 'NEG', 'state', 1], #8
            ['PAHANG', null, 'PHG', 'state', 1], #9
            ['PULAU PINANG', null, 'PNG', 'state', 1], #10
            ['WP PUTRAJAYA', null, 'PUJ', 'state', 1], #11
            ['PERAK', null, 'PRK', 'state', 1], #12
            ['PERLIS', null, 'PER', 'state', 1], #13
            ['SABAH', null, 'SBH', 'state', 1], #14
            ['SARAWAK', null, 'SWK', 'state', 1], #15
            ['SELANGOR', null, 'SEL', 'state', 1], #16
            ['TERENGGANU', null, 'TRG', 'state', 1], #17

            /* perlis */
            ['ABI', null, null, 'city', '13'],
            ['ARAU', null, null, 'city', '13'],
            ['BERSERI', null, null, 'city', '13'],
            ['CHUPING', null, null, 'city', '13'],
            ['UTAN AJI', null, null, 'city', '13'],
            ['JEJAWI', null, null, 'city', '13'],
            ['KAYANG', null, null, 'city', '13'],
            ['KECHOR', null, null, 'city', '13'],
            ['KUALA PERLIS', null, null, 'city', '13'],
            ['KURONG ANAI', null, null, 'city', '13'],
            ['KURONG BATANG', null, null, 'city', '13'],
            ['NGOLANG', null, null, 'city', '13'],
            ['ORAN', null, null, 'city', '13'],
            ['PADANG PAUH', null, null, 'city', '13'],
            ['PADANG SIDING', null, null, 'city', '13'],
            ['PAYA', null, null, 'city', '13'],
            ['SANGLANG', null, null, 'city', '13'],
            ['SENA', null, null, 'city', '13'],
            ['SERIAP', null, null, 'city', '13'],
            ['SUNGAI ADAM', null, null, 'city', '13'],
            ['TITI TINGGI', null, null, 'city', '13'],
            ['WANG BINTONG', null, null, 'city', '13'],

            /*
             * kedah
             */
            /*
             * === KOTA SETAR
             */
            ['ALOR MALAI', null, null, 'city', '3'],
            ['ANAK BUKIT', null, null, 'city', '3'],
            ['DERGA', null, null, 'city', '3'],
            ['GUNONG', null, null, 'city', '3'],
            ['KANGKONG', null, null, 'city', '3'],
            ['KUBANG ROTAN', null, null, 'city', '3'],
            ['LANGGAR', null, null, 'city', '3'],
            ['LENGKUAS', null, null, 'city', '3'],
            ['LEPAI', null, null, 'city', '3'],
            ['LIMBONG', null, null, 'city', '3'],
            ['PADANG HANG', null, null, 'city', '3'],
            ['PADANG LALANG', null, null, 'city', '3'],
            ['PENGKALAN KUNDOR', null, null, 'city', '3'],
            ['SALA KECHIL', null, null, 'city', '3'],
            ['SUNGAI BAHARU', null, null, 'city', '3'],
            ['TAJAR', null, null, 'city', '3'],
            ['TEBENGAU', null, null, 'city', '3'],
            ['TELAGA MAS', null, null, 'city', '3'],
            ['TITI GAJAH', null, null, 'city', '3'],

            /*
             * === KUBANG PASU
             */
            ['AH', null, null, 'city', '3'],
            ['BINJAL', null, null, 'city', '3'],
            ['GELONG', null, null, 'city', '3'],
            ['BUKIT TINGGI', null, null, 'city', '3'],
            ['HUSBA', null, null, 'city', '3'],
            ['JERAM', null, null, 'city', '3'],
            ['JERLUN', null, null, 'city', '3'],
            ['JITRA', null, null, 'city', '3'],
            ['KEPELU', null, null, 'city', '3'],
            ['KUBANG PASU', null, null, 'city', '3'],
            ['MALAU', null, null, 'city', '3'],
            ['NAGA', null, null, 'city', '3'],
            ['PADANG PERAHU', null, null, 'city', '3'],
            ['PELUBANG', null, null, 'city', '3'],
            ['PERING', null, null, 'city', '3'],
            ['PUTAT', null, null, 'city', '3'],
            ['SANGLANG', null, null, 'city', '3'],
            ['SUNGAI LAKA', null, null, 'city', '3'],
            ['TEMIN', null, null, 'city', '3'],
            ['TUNJANG', null, null, 'city', '3'],
            ['WANG TEPUS', null, null, 'city', '3'],


            /*
             * === PADANG TERAP
             */
            ['BATANG TUNGGANG KANAN', null, null, 'city', '3'],
            ['BATANG TUNGGANG KIRI', null, null, 'city', '3'],
            ['BELIMBING KANAN', null, null, 'city', '3'],
            ['BELIMBING KIRI', null, null, 'city', '3'],
            ['KURONG HITAM', null, null, 'city', '3'],
            ['PADANG TERNAK', null, null, 'city', '3'],
            ['PADANG TERAP KANAN', null, null, 'city', '3'],
            ['PADANG TERAP KIRI', null, null, 'city', '3'],
            ['PEDU', null, null, 'city', '3'],
            ['TEKAI', null, null, 'city', '3'],
            ['TOLAK', null, null, 'city', '3'],


            /*
             * === LANGKAWI
             */
            ['AYER HANGAT', null, null, 'city', '3'],
            ['BOHOR', null, null, 'city', '3'],
            ['KEDAWANG', null, null, 'city', '3'],
            ['KUAH', null, null, 'city', '3'],
            ['PADANG MASIRAT', null, null, 'city', '3'],
            ['ULU MELAKA', null, null, 'city', '3'],


            /*
             * === KUALA MUDA - data tiada dalam sddsa. retrive from statistics.gov.my
             */
            ['BUJANG', null, null, 'city', '3'],
            ['BUKIT MERIAM', null, null, 'city', '3'],
            ['GURUN', null, null, 'city', '3'],
            ['HAJI KUDONG', null, null, 'city', '3'],
            ['KOTA', null, null, 'city', '3'],
            ['KUALA', null, null, 'city', '3'],
            ['MERBOK', null, null, 'city', '3'],
            ['PEKULA', null, null, 'city', '3'],
            ['PINANG TUNGGAL', null, null, 'city', '3'],
            ['RANTAU PANJANG', null, null, 'city', '3'],
            ['SEMELING', null, null, 'city', '3'],
            ['SIDAM KIRI', null, null, 'city', '3'],
            ['SIMPOR', null, null, 'city', '3'],
            ['SUNGAI PASIR', null, null, 'city', '3'],
            ['SUNGAI PETANI', null, null, 'city', '3'],
            ['TELOI KIRI', null, null, 'city', '3'],

            /*
             * === YAN
             */
            ['DULANG', null, null, 'city', '3'],
            ['SALA BESAR', null, null, 'city', '3'],
            ['SINGKIR', null, null, 'city', '3'],
            ['SUNGAI DAUN', null, null, 'city', '3'],
            ['YAN', null, null, 'city', '3'],


            /*
             * === SIK
             */
            ['JENERI', null, null, 'city', '3'],
            ['SIK', null, null, 'city', '3'],
            ['SOK', null, null, 'city', '3'],


            /*
             * === BALING
             */
            ['BAKAI', null, null, 'city', '3'],
            ['BALING', null, null, 'city', '3'],
            ['BONGOR', null, null, 'city', '3'],
            ['KUPANG', null, null, 'city', '3'],
            ['PULAI', null, null, 'city', '3'],
            ['SIONG', null, null, 'city', '3'],
            ['TAWAR', null, null, 'city', '3'],
            ['TELOI KANAN', null, null, 'city', '3'],


            /*
             * === KULIM
             */
            ['BAGAN SENA', null, null, 'city', '3'],
            ['JUNJONG', null, null, 'city', '3'],
            ['KARANGAN', null, null, 'city', '3'],
            // ['KELADI', null, null, 'city', '3'], // deprecated?
            ['KULIM', null, null, 'city', '3'],
            ['LUNAS', null, null, 'city', '3'],
            ['MAHANG', null, null, 'city', '3'],
            ['NAGA LILIT', null, null, 'city', '3'],
            ['PADANG CHINA', null, null, 'city', '3'],
            ['PADANG MEHA', null, null, 'city', '3'],
            ['SEDIM', null, null, 'city', '3'],
            ['SIDAM KANAN', null, null, 'city', '3'],
            ['SUNGAI SELUANG', null, null, 'city', '3'],
            ['SUNGAI ULAR', null, null, 'city', '3'],
            ['TERAP', null, null, 'city', '3'],


            /*
             * === BANDAR BAHARU
             */
            ['BAGAN SEMAK', null, null, 'city', '3'],
            ['KUALA SELAMA', null, null, 'city', '3'],
            ['PERMATANG PASIR', null, null, 'city', '3'],
            ['RELAU', null, null, 'city', '3'],
            ['SERDANG', null, null, 'city', '3'],
            ['SUNGAI BATU', null, null, 'city', '3'],
            ['SUNGAI KECHIL', null, null, 'city', '3'],


            /*
             * === PENDANG
             */
            ['AYER PUTEH', null, null, 'city', '3'],
            ['BUKIT RAYA', null, null, 'city', '3'],
            ['GUAR KEPAYANG', null, null, 'city', '3'],
            ['PADANG KERBAU', null, null, 'city', '3'],
            ['PADANG PELIANG', null, null, 'city', '3'],
            ['PADANG PUSING', null, null, 'city', '3'],
            // ['RAMBAI', null, null, 'city', '3'], // deprecated?
            ['TOBIAR', null, null, 'city', '3'],


            /*
             * === POKOK SENA
             */
            ['DERANG', null, null, 'city', '3'],
            ['LESONG', null, null, 'city', '3'],
            ['TUALANG', null, null, 'city', '3'],
            ['BUKIT LADA', null, null, 'city', '3'],


            /*
             * kelantan
             */
            /*
             * === BACHOK
             */
            // ['GUNONG (GUNONG TIMOR)', null, null, 'city', '4'], // via statistic.gov.my - 030107
            ['ALOR BAKAT', null, null, 'city', '4'],
            ['BACKHOK', null, null, 'city', '4'],
            // ['MAHLIGAI', null, null, 'city', '4'], // via statistic.gov.my
            ['BATOR', null, null, 'city', '4'],
            // ['PERUPOK', null, null, 'city', '4'], // via statistic.gov.my - 030119
            ['CHAP', null, null, 'city', '4'],
            // ['MELAWI (REPEK)', null, null, 'city', '4'], // via statistic.gov.my - pecah kepada 030114 & 030120
            ['CHERANG HANGUS', null, null, 'city', '4'],
            // ['TAWANG (MENTUAN)', null, null, 'city', '4'], // via statistic.gov.my
            ['GAJAH MATI', null, null, 'city', '4'],
            // ['TELONG', null, null, 'city', '4'], // via statistic.gov.my - 030129
            ['GUNONG', null, null, 'city', '4'],
            // ['TANJUNG PAUH', null, null, 'city', '4'], // via statistic.gov.my - 030127
            ['KUAU', null, null, 'city', '4'],
            ['KEMASIN', null, null, 'city', '4'],
            ['KUBANG TELAGA', null, null, 'city', '4'],
            ['KUCHELONG', null, null, 'city', '4'],
            ['LUBOK TEMBESU', null, null, 'city', '4'],
            ['MAK LIPAH', null, null, 'city', '4'],
            ['MELAWI', null, null, 'city', '4'],
            ['NIPAH', null, null, 'city', '4'],
            ['PAK PURA', null, null, 'city', '4'],
            ['PAUH SEMBILAN', null, null, 'city', '4'],
            ['PAYA MENGKUANG', null, null, 'city', '4'],
            ['PERUPOK', null, null, 'city', '4'],
            ['REPEK', null, null, 'city', '4'],
            ['RUSA', null, null, 'city', '4'],
            ['SENAK', null, null, 'city', '4'],
            ['SERDANG', null, null, 'city', '4'],
            ['TAKANG', null, null, 'city', '4'],
            ['TANJONG', null, null, 'city', '4'],
            ['TANJONG JERING', null, null, 'city', '4'],
            ['TANJONG PAUH', null, null, 'city', '4'],
            ['TELOK MESIRA', null, null, 'city', '4'],
            ['TELONG', null, null, 'city', '4'],
            ['TEMU RANGGAS', null, null, 'city', '4'],
            ['TEPUS', null, null, 'city', '4'],
            ['TUALANG SALAK', null, null, 'city', '4'],


            /*
             * === KOTA BHARU
             */
            // ['BANGGU', null, null, 'city', '4'], // via statistic.gov.my - 030205
            ['AUR DURI', null, null, 'city', '4'],
            // ['BADANG', null, null, 'city', '4'], // via statistic.gov.my - 030204
            ['BADAK MATI', null, null, 'city', '4'],
            // ['BETA', null, null, 'city', '4'], // via statistic.gov.my - 030210 & 030211
            ['BADAK', null, null, 'city', '4'],
            // ['KADOK', null, null, 'city', '4'], // via statistic.gov.my - 030227
            ['BADANG', null, null, 'city', '4'],
            // ['KEMUMIN', null, null, 'city', '4'], // via statistic.gov.my - 030233
            ['BANGGU', null, null, 'city', '4'],
            // ['KOTA', null, null, 'city', '4'], // via statistic.gov.my - 030238
            ['BANGGOL', null, null, 'city', '4'],
            // ['LIMBAT', null, null, 'city', '4'], // via statistic.gov.my - deprecated?
            ['BAUNG', null, null, 'city', '4'],
            // ['KUBANG KERIAN (LUNDANG)', null, null, 'city', '4'], // via statistic.gov.my - 030243 & 030291
            ['BAYANG', null, null, 'city', '4'],
            // ['KETEREH (PANGKAL KALONG)', null, null, 'city', '4'], // via statistic.gov.my - 030235 & 030236
            ['BECHAH MULONG', null, null, 'city', '4'],
            // ['PANJI', null, null, 'city', '4'], // via statistic.gov.my - deprecated?
            ['BETA HULU', null, null, 'city', '4'],
            // ['PENDEK', null, null, 'city', '4'], // via statistic.gov.my - 030264
            ['BETA HILIR', null, null, 'city', '4'],
            // ['PERINGAT', null, null, 'city', '4'], // via statistic.gov.my - 030266
            ['BETING', null, null, 'city', '4'],
            // ['SALOR', null, null, 'city', '4'], // via statistic.gov.my - 030276
            ['BIAH', null, null, 'city', '4'],
            // ['SERING', null, null, 'city', '4'], // via statistic.gov.my - 030278
            ['BINJAI', null, null, 'city', '4'],
            // ['KOTA BHARU', null, null, 'city', '4'], // via statistic.gov.my - 030290
            ['BULOH POH', null, null, 'city', '4'],
            ['BUNUT PAYONG', null, null, 'city', '4'],
            ['BUT', null, null, 'city', '4'],
            ['CHEKLI', null, null, 'city', '4'],
            ['CHEKOK', null, null, 'city', '4'],
            ['CHE LATIFF', null, null, 'city', '4'],
            ['CHICHA', null, null, 'city', '4'],
            ['DAL', null, null, 'city', '4'],
            ['DEMIT', null, null, 'city', '4'],
            ['DUSON RENDAH', null, null, 'city', '4'],
            ['GUNTONG', null, null, 'city', '4'],
            ['JELUTONG', null, null, 'city', '4'],
            ['KADOK', null, null, 'city', '4'],
            ['KARANG', null, null, 'city', '4'],
            ['KAMPONG SIREH', null, null, 'city', '4'],
            ['KEDAI BULOH', null, null, 'city', '4'],
            ['KIJANG', null, null, 'city', '4'],
            ['KEMUBU', null, null, 'city', '4'],
            ['KEMUMIN', null, null, 'city', '4'],
            ['KENALI', null, null, 'city', '4'],
            ['KETEREH BARAT', null, null, 'city', '4'],
            ['KETEREH TIMOR', null, null, 'city', '4'],
            ['KOH', null, null, 'city', '4'],
            ['KOTA', null, null, 'city', '4'],
            ['LANGGAR', null, null, 'city', '4'],
            ['TANGJONG CHAT', null, null, 'city', '4'],
            ['TAPANG', null, null, 'city', '4'],
            ['TEBING TINGGI', null, null, 'city', '4'],
            ['TELOK', null, null, 'city', '4'],
            ['TELOK BHARU', null, null, 'city', '4'],
            ['TELOK KITANG', null, null, 'city', '4'],
            ['TIONG', null, null, 'city', '4'],
            ['TOK KU', null, null, 'city', '4'],
            ['WAKAF STAN', null, null, 'city', '4'],
            ['WAKAF SIKU', null, null, 'city', '4'],

            ['BANDAR KOTA BHARU', null, null, 'city', '4'],
            ['BANDAR BARU KUBANG KERIAN', null, null, 'city', '4'],


            /*
             * === MACHANG
             */
            ['BAGAN', null, null, 'city', '4'],
            // ['LABOK', null, null, 'city', '4'], // via statistic.gov.my - 030311
            ['BAKAR', null, null, 'city', '4'],
            // ['PANYIT', null, null, 'city', '4'], // via statistic.gov.my - deprecated?
            ['DEWAN', null, null, 'city', '4'],
            // ['PULAI CHONDONG', null, null, 'city', '4'], // via statistic.gov.my - 030317
            ['GADING GALOH', null, null, 'city', '4'],
            // ['PANGKAL MELERET', null, null, 'city', '4'], // via statistic.gov.my - deprecated?
            ['JAKAR', null, null, 'city', '4'],
            // ['TEMANGAN', null, null, 'city', '4'], // via statistic.gov.my - 030319
            ['JOH', null, null, 'city', '4'],
            // ['ULU SAT', null, null, 'city', '4'], // via statistic.gov.my - 030322
            ['KELAWEH', null, null, 'city', '4'],
            ['KERAWANG', null, null, 'city', '4'],
            ['KERILLA', null, null, 'city', '4'],
            ['KUALA KERAK', null, null, 'city', '4'],
            ['LABOK', null, null, 'city', '4'],
            ['LIMAU HANTU', null, null, 'city', '4'],
            ['MACHANG', null, null, 'city', '4'],
            ['PADANG KEMUNCHUT', null, null, 'city', '4'],
            ['PEK', null, null, 'city', '4'],
            ['PEMANOK', null, null, 'city', '4'],
            ['PULAU CHONDONG', null, null, 'city', '4'],
            ['RAJA', null, null, 'city', '4'],
            // ['TEMANGAN', null, null, 'city', '4'], // duplicate dalam sddsa. remove dulu kalau tak akan ada masalah untuk seed
            ['TENGAH', null, null, 'city', '4'],
            ['TOK BOK', null, null, 'city', '4'],
            ['ULU SAT', null, null, 'city', '4'],


            /*
             * === PASIR MAS
             */
            ['ALOR BULOH', null, null, 'city', '4'],
            ['ALOR PASIR', null, null, 'city', '4'],
            // via statistic.gov.my
            // ['BUNUT SUSU', null, null, 'city', '4'], // via statistic.gov.my
            ['APA-APA', null, null, 'city', '4'],
            // ['CHETOK', null, null, 'city', '4'], // via statistic.gov.my - 030410
            ['APAM', null, null, 'city', '4'],
            // ['GUAL PERIOK', null, null, 'city', '4'], // via statistic.gov.my - 030414
            ['BAKONG', null, null, 'city', '4'],
            // ['KANGKONG', null, null, 'city', '4'], // via statistic.gov.my - 030417
            ['BECHAH MENERONG', null, null, 'city', '4'],
            // ['KUALA LEMAL', null, null, 'city', '4'], // via statistic.gov.my - 030424
            ['BECHAH PALAS', null, null, 'city', '4'],
            // ['KUBANG GADONG', null, null, 'city', '4'], // via statistic.gov.my - deprecated
            ['BECHAH SEMAK', null, null, 'city', '4'],
            // ['KUBANG SEPAT', null, null, 'city', '4'], // via statistic.gov.my - 030430
            ['BUKIT TUKU', null, null, 'city', '4'],
            // ['PASIR MAS', null, null, 'city', '4'], // via statistic.gov.my - 030450
            ['CHETOK', null, null, 'city', '4'],
            // ['RANTAU PANJANG', null, null, 'city', '4'], // via statistic.gov.my - 030441 & 030470
            ['GELAM', null, null, 'city', '4'],
            ['GUA', null, null, 'city', '4'],
            ['GUAL NERING', null, null, 'city', '4'],
            ['GUAL PERIOK', null, null, 'city', '4'],
            ['JABO', null, null, 'city', '4'],
            ['JEJAWI', null, null, 'city', '4'],
            ['KANGKONG', null, null, 'city', '4'],
            ['KALA', null, null, 'city', '4'],
            ['KASA', null, null, 'city', '4'],
            ['KEDONDONG', null, null, 'city', '4'],
            ['KENAK', null, null, 'city', '4'],
            ['KERASAK', null, null, 'city', '4'],
            ['KIAT', null, null, 'city', '4'],
            ['KUALA LEMAL', null, null, 'city', '4'],
            ['KUBANG BATANG', null, null, 'city', '4'],
            ['KUBANG BEMBAN', null, null, 'city', '4'],
            ['KUBANG GATAL', null, null, 'city', '4'],
            ['KUBANG GENDANG', null, null, 'city', '4'],
            ['KUBANG KETAM', null, null, 'city', '4'],
            ['KUBANG SEPAT', null, null, 'city', '4'],
            ['KUBANG TERAP', null, null, 'city', '4'],
            ['LALANG', null, null, 'city', '4'],
            ['LUBOK ANCHING', null, null, 'city', '4'],
            ['LUBOK GONG', null, null, 'city', '4'],
            ['LUBOK KAWAH', null, null, 'city', '4'],
            ['LUBOK TAPAH', null, null, 'city', '4'],
            ['LUBOK SETOL', null, null, 'city', '4'],
            ['MERANTI', null, null, 'city', '4'],
            ['PADANG EMBON', null, null, 'city', '4'],


            /*
             * === PASIR PUTEH
             */
            ['BANGGOL SETOL', null, null, 'city', '4'],
            // ['BUKIT ABAL', null, null, 'city', '4'], // via statistic.gov.my - 030504 & 030505
            ['BATU SEBUTIR', null, null, 'city', '4'],
            // ['PADANG PAK AMAT', null, null, 'city', '4'], // via statistic.gov.my - 030525
            ['BERANGAN', null, null, 'city', '4'],
            // ['BUKIT AWANG', null, null, 'city', '4'], // via statistic.gov.my
            ['BUKIT ABAL BARAT', null, null, 'city', '4'],
            // ['BUKIT JAWA', null, null, 'city', '4'], // via statistic.gov.my
            ['BUKIT ABAL TIMOR', null, null, 'city', '4'],
            // ['GONG DATOK', null, null, 'city', '4'], // via statistic.gov.my - 030510 & 030511
            ['BUKIT MERBAU', null, null, 'city', '4'],
            // ['JERAM', null, null, 'city', '4'], // via statistic.gov.my - 030518
            ['BUKIT TANAH', null, null, 'city', '4'],
            // ['LIMBONGAN', null, null, 'city', '4'], // via statistic.gov.my
            ['CHERANG RUKU', null, null, 'city', '4'],
            // ['SEMERAK', null, null, 'city', '4'], // via statistic.gov.my - 030531
            ['CHANGGAI', null, null, 'city', '4'],
            ['GONG DATOK BARAT', null, null, 'city', '4'],
            ['GONG DATOK TIMOR', null, null, 'city', '4'],
            ['GONG CHAPA', null, null, 'city', '4'],
            ['GONG CHENGAL', null, null, 'city', '4'],
            ['GONG GARU', null, null, 'city', '4'],
            ['GONG KULIM', null, null, 'city', '4'],
            ['GONG NANGKA', null, null, 'city', '4'],
            ['GONG PACHAT', null, null, 'city', '4'],
            ['JERAM', null, null, 'city', '4'],
            ['JERUS', null, null, 'city', '4'],
            ['KANDIS', null, null, 'city', '4'],
            ['KAMPONG WAKAF', null, null, 'city', '4'],
            ['KOLAM TEMBUSU', null, null, 'city', '4'],
            ['MERBOL', null, null, 'city', '4'],
            ['MERKANG', null, null, 'city', '4'],
            ['PADANG PAK AMAT', null, null, 'city', '4'],
            ['PASIR PUTEH', null, null, 'city', '4'],
            ['PANGKALAN', null, null, 'city', '4'],
            ['PERMATANG SUNGKAI', null, null, 'city', '4'],
            ['SELIGI', null, null, 'city', '4'],
            ['SELINSING', null, null, 'city', '4'],
            ['SEMERAK', null, null, 'city', '4'],
            ['TASIK', null, null, 'city', '4'],
            ['TELIPOK', null, null, 'city', '4'],


            /*
             * === TANAH MERAH
             */
            ['BATANG MERBAU', null, null, 'city', '4'],
            // ['JEDOK', null, null, 'city', '4'], // via statistic.gov.my - 030606
            // ['KUSIAL', null, null, 'city', '4'], // via statistic.gov.my - deprecated?
            ['BENDANG NYIOR', null, null, 'city', '4'],
            // ['ULU KUSIAL', null, null, 'city', '4'], // via statistic.gov.my - 030605
            ['BUKIT DURIAN', null, null, 'city', '4'],
            ['ULU KUSIAL', null, null, 'city', '4'],
            ['JEDOK', null, null, 'city', '4'],
            // ['??', null, null, 'city', '4'], - deprecated?
            // ['??', null, null, 'city', '4'], - deprecated?
            ['KUALA PAKU', null, null, 'city', '4'],
            ['LAWANG', null, null, 'city', '4'],
            ['MAKA', null, null, 'city', '4'],
            ['NIBONG', null, null, 'city', '4'],
            ['PASIR GANDA', null, null, 'city', '4'],
            ['RAMBAI', null, null, 'city', '4'],
            ['SOKOR', null, null, 'city', '4'],
            ['TANAH MERAH', null, null, 'city', '4'],
            ['TEBING TINGGI', null, null, 'city', '4'],


            /*
             * === TUMPAT
             */
            ['BECHAH RESAK', null, null, 'city', '4'],
            // ['KEBAKAT', null, null, 'city', '4'], // via statistic.gov.my
            ['BUNOHAN', null, null, 'city', '4'],
            // ['JAL BESAR', null, null, 'city', '4'], // via statistic.gov.my - 030707
            ['BUNUT SARANG BURONG', null, null, 'city', '4'],
            // ['PENGKALAN KUBOR', null, null, 'city', '4'], // via statistic.gov.my
            ['CHENDERONG BATU', null, null, 'city', '4'],
            // ['SUNGAI PINANG', null, null, 'city', '4'], // via statistic.gov.my - 030722
            ['CHERANG MELINTANG', null, null, 'city', '4'],
            // ['TERBOK', null, null, 'city', '4'], // via statistic.gov.my
            ['GETING', null, null, 'city', '4'],
            // ['TUMBAT', null, null, 'city', '4'], // via statistic.gov.my
            ['JAL', null, null, 'city', '4'],
            // ['WAKAF BHARU', null, null, 'city', '4'], // via statistic.gov.my - 030728
            ['KAMPONG LAUT', null, null, 'city', '4'],
            ['KELABORAN', null, null, 'city', '4'],
            ['KETIL', null, null, 'city', '4'],
            ['KOK KELI', null, null, 'city', '4'],
            ['KUTANG', null, null, 'city', '4'],
            ['MAK NERALANG', null, null, 'city', '4'],
            ['MORAK', null, null, 'city', '4'],
            ['PASIR PEKAN', null, null, 'city', '4'],
            ['PALEKBANG', null, null, 'city', '4'],
            ['PERIOK', null, null, 'city', '4'],
            ['PULAU BESAR', null, null, 'city', '4'],
            ['SELEHONG SELATAN', null, null, 'city', '4'],
            ['SELEHONG UTARA', null, null, 'city', '4'],
            ['SIMPANGAN', null, null, 'city', '4'],
            ['SUNGAI PINANG', null, null, 'city', '4'],
            ['TABAR', null, null, 'city', '4'],
            ['TALAK', null, null, 'city', '4'],
            ['TELOK REJUNA', null, null, 'city', '4'],
            ['TUJOH', null, null, 'city', '4'],
            ['TUMPAT', null, null, 'city', '4'],
            ['WAKAF BHARU', null, null, 'city', '4'],
            ['WAKAF DELIMA', null, null, 'city', '4'],


            /*
             * === GUA MUSANG
             */
            ['BATU PAPAN', null, null, 'city', '4'],
            // ['BERTAM', null, null, 'city', '4'], // via statistic.gov.my
            ['GUA MUSANG', null, null, 'city', '4'],
            // ['GALAS', null, null, 'city', '4'], // via statistic.gov.my
            ['ULU NENGGIRI', null, null, 'city', '4'],
            // ['CHIKU', null, null, 'city', '4'], // via statistic.gov.my
            ['KETIL', null, null, 'city', '4'],
            ['KUALA SUNGAI', null, null, 'city', '4'],
            ['LIMAU KASTURI', null, null, 'city', '4'],
            ['PULAI', null, null, 'city', '4'],
            ['RELAI', null, null, 'city', '4'],
            ['RENOK', null, null, 'city', '4'],


            /*
             * === 0309 MISSING SUBDISTRICT
             */
            /*
             * === KUALA KRAI
             */
            ['BATU MENGKEBANG', null, null, 'city', '4'],
            // ['OLAK JERAM', null, null, 'city', '4'], // via statistic.gov.my
            ['ENGGONG', null, null, 'city', '4'],
            // ['BATU MENGKEBANG', null, null, 'city', '4'], // via statistic.gov.my - 031001
            ['GAJAH', null, null, 'city', '4'],
            // ['DABONG', null, null, 'city', '4'], // via statistic.gov.my
            ['KANDEK', null, null, 'city', '4'],
            ['KENOR', null, null, 'city', '4'],
            ['KUALA GERIS', null, null, 'city', '4'],
            ['KUALA KRAI', null, null, 'city', '4'],
            ['KUALA NAL', null, null, 'city', '4'],
            ['KUALA PAHI', null, null, 'city', '4'],
            ['KUALA PERGAU', null, null, 'city', '4'],
            ['KUALA STONG', null, null, 'city', '4'],
            ['MAMBONG', null, null, 'city', '4'],
            ['MANEK URAI', null, null, 'city', '4'],
            ['MANJOR', null, null, 'city', '4'],
            ['TELEKONG', null, null, 'city', '4'],


            /*
             * === JELI
             */
            ['BELIMBING', null, null, 'city', '4'],
            // ['JELI', null, null, 'city', '4'], // via statistic.gov.my - 031103
            ['BUNGA TANJONG', null, null, 'city', '4'],
            // ['BATU MELINTANG (BELIMBING)', null, null, 'city', '4'], // via statistic.gov.my
            ['JELI', null, null, 'city', '4'],
            // ['KUALA BALAH', null, null, 'city', '4'], // via statistic.gov.my - 031106
            ['JELI TEPI SUNGAI', null, null, 'city', '4'],
            ['KALAI', null, null, 'city', '4'],
            ['KUALA BALAH', null, null, 'city', '4'],
            ['LUBOK BONGOR', null, null, 'city', '4'],

            /*
             * === KECIL LOJING
             */
            ['BALAR', null, null, 'city', '4'],
            ['KUALA BETIS', null, null, 'city', '4'],
            ['BLAU', null, null, 'city', '4'],
            ['HAU', null, null, 'city', '4'],
            ['HENDROP', null, null, 'city', '4'],
            ['SIGAR', null, null, 'city', '4'],
            ['TUEL', null, null, 'city', '4'],

            /*
             * terengganu
             */
            /*
             * === BESUT
             */
            ['BUKIT KENAK', null, null, 'city', '17'],
            ['BUKIT PUTERI', null, null, 'city', '17'],
            // ['??', null, null, 'city', '17'],
            // ['??', null, null, 'city', '17'],
            ['HULU BESUT', null, null, 'city', '17'],
            // ['??', null, null, 'city', '17'],
            // ['JABI', null, null, 'city', '17'], - 110107
            ['JABI', null, null, 'city', '17'],
            // ['KAMPONG RAJA', null, null, 'city', '17'], - 110108
            ['KAMPONG RAJA', null, null, 'city', '17'],
            // ['KELUANG', null, null, 'city', '17'], - 110109
            ['KELUANG', null, null, 'city', '17'],
            // ['KERANDANG', null, null, 'city', '17'], - 110110
            ['KERANDANG', null, null, 'city', '17'],
            // ['KUALA BESUT', null, null, 'city', '17'], - 110111
            ['KUALA BESUT', null, null, 'city', '17'],
            // ['KUBANG BEMBAN', null, null, 'city', '17'], - 110112
            ['KUBANG BEMBAN', null, null, 'city', '17'],
            // ['LUBOK KAWAH', null, null, 'city', '17'], - 110113
            ['LUBUK KAWAH', null, null, 'city', '17'],
            // ['PASIR AKAR', null, null, 'city', '17'], - 110115
            // ['??', null, null, 'city', '17'],
            ['PASIR AKAR', null, null, 'city', '17'],
            // ['PELAGAT', null, null, 'city', '17'], - 110116
            ['PELAGAT', null, null, 'city', '17'],
            // ['PENGKALAN NANGKA', null, null, 'city', '17'], - 110117
            ['PENGKALAN NANGKA', null, null, 'city', '17'],
            // ['PULAU PERHENTIAN', null, null, 'city', '17'], - 110118
            ['PULAU PERHENTIAN', null, null, 'city', '17'],
            // ['??', null, null, 'city', '17'],
            // ['TEMBILA', null, null, 'city', '17'], - 110120
            ['TEMBILA', null, null, 'city', '17'],
            // ['TENANG', null, null, 'city', '17'], - 110121
            ['TENANG', null, null, 'city', '17'],
            // ['HULU BESUT', null, null, 'city', '17'], - 110105


            /*
             * === DUNGUN
             */
            ['KUALA ABANG', null, null, 'city', '17'],
            ['BESUL', null, null, 'city', '17'],
            ['HULU PAKA', null, null, 'city', '17'],
            ['JENGAI', null, null, 'city', '17'],
            ['JERANGAU', null, null, 'city', '17'],
            ['KUALA DUNGUN', null, null, 'city', '17'],
            ['KUALA PAKA', null, null, 'city', '17'],
            ['KUMPAL', null, null, 'city', '17'],
            ['PASIR RAJA', null, null, 'city', '17'],
            ['RASAU', null, null, 'city', '17'],
            ['SURA', null, null, 'city', '17'],


            /*
             * === KEMAMAN
             */
            ['BANDI', null, null, 'city', '17'],
            ['BANGGUL', null, null, 'city', '17'],
            ['BINJAI', null, null, 'city', '17'],
            ['CUKAI', null, null, 'city', '17'],
            ['HULU CUKAI', null, null, 'city', '17'],
            ['HULU JABUR', null, null, 'city', '17'],
            ['KEMASIK', null, null, 'city', '17'],
            ['KERTEH', null, null, 'city', '17'],
            ['KIJAL', null, null, 'city', '17'],
            ['PASIR SEMUT', null, null, 'city', '17'],
            ['TEBAK', null, null, 'city', '17'],
            ['TELUK KALUNG', null, null, 'city', '17'],


            /*
             * === KUALA TERENGGANU
             */
            // ['??', null, null, 'city', '17'],
            ['ATAS TOL', null, null, 'city', '17'],
            ['BATU BURUK', null, null, 'city', '17'],
            ['BATU RAKIT', null, null, 'city', '17'],
            ['BELARA', null, null, 'city', '17'],
            ['BUKIT BESAR', null, null, 'city', '17'],
            ['CABANG TIGA', null, null, 'city', '17'],
            ['CENERIANG', null, null, 'city', '17'],
            ['GELUGUR KEDAI', null, null, 'city', '17'],
            ['GELUGUR RAJA', null, null, 'city', '17'],
            ['KEPUNG', null, null, 'city', '17'],

            ['KUALA IBAI', null, null, 'city', '17'],
            ['KUALA NERUS', null, null, 'city', '17'],
            ['KUBANG PARIT', null, null, 'city', '17'],
            ['LOSONG', null, null, 'city', '17'],
            ['MANIR', null, null, 'city', '17'],
            ['PALUH', null, null, 'city', '17'],
            ['PENGADANG BULUH', null, null, 'city', '17'],
            ['PULAU-PULAU', null, null, 'city', '17'],
            ['PULAU REDANG', null, null, 'city', '17'],
            ['RENGAS', null, null, 'city', '17'],
            ['SERADA', null, null, 'city', '17'],
            ['TOK JAMAL', null, null, 'city', '17'],


            /*
             * === HULU TERENGGANU
             */
            ['HULU BERANG', null, null, 'city', '17'],
            ['HULU TELEMUNG', null, null, 'city', '17'],
            ['HULU TERENGGANU', null, null, 'city', '17'],
            ['JENAGUR', null, null, 'city', '17'],
            ['KUALA BERANG', null, null, 'city', '17'],
            ['KUALA TELEMUNG', null, null, 'city', '17'],
            ['PENGHULU DIMAN', null, null, 'city', '17'],
            ['TANGGUL', null, null, 'city', '17'],
            ['TERSAT', null, null, 'city', '17'],


            /*
             * === MARANG
             */
            ['JERUNG', null, null, 'city', '17'],
            ['MERCANG', null, null, 'city', '17'],
            ['PULAU KERENGGA', null, null, 'city', '17'],
            ['RUSILA', null, null, 'city', '17'],
            ['ALUR LIMBAT', null, null, 'city', '17'],
            ['BUKIT PAYUNG', null, null, 'city', '17'],


            /*
             * === SETIU
             */
            // ['HULU SETIU', null, null, 'city', '17'],
            ['CALUK', null, null, 'city', '17'],
            // ['PANTAI', null, null, 'city', '17'],
            ['GUNTUNG', null, null, 'city', '17'],
            ['HULU NERUS', null, null, 'city', '17'],
            ['MERANG', null, null, 'city', '17'],
            // ['??', null, null, 'city', '17'],
            ['TASIK', null, null, 'city', '17'],

            /*
             * pulau pinang
             */
            /*
             * === SEBERANG PRAI TENGAH
             */
            ['BUKIT MERTAJAM', null, null, 'city', '10'],
            ['PRAI', null, null, 'city', '10'],

            /*
             * === SEBERANG PRAI UTARA
             */
            ['BUTTERWORTH', null, null, 'city', '10'],
            ['KEPALA BATAS', null, null, 'city', '10'],

            /*
             * === SEBERANG PRAI SELATAN
             */
            ['NIBONG TEBAL', null, null, 'city', '10'],
            ['SUNGAI BAKAP', null, null, 'city', '10'],

            /*
             * === TIMUR LAUT
             */
            ['AYER ITAM', null, null, 'city', '10'],
            ['BATU FERRINGGI', null, null, 'city', '10'],
            ['BUKIT BENDERA', null, null, 'city', '10'],
            ['GLUGOR', null, null, 'city', '10'],
            ['GEORGE TOWN', null, null, 'city', '10'],
            ['JELUTONG', null, null, 'city', '10'],
            ['TANJONG BUNGAH', null, null, 'city', '10'],
            ['TANJONG TOKONG', null, null, 'city', '10'],
            ['TANJONG PINANG', null, null, 'city', '10'],

            /*
             * === BARAT DAYA
             */
            ['BALIK PULAU', null, null, 'city', '10'],
            ['BAYAN LEPAS', null, null, 'city', '10'],

            /*
             * perak
             */
            /*
             * === BATANG PADANG
             */
            ['BATANG PADANG', null, null, 'city', '12'],
            ['BIDOR', null, null, 'city', '12'],
            ['CHENDERIANG', null, null, 'city', '12'],
            ['HULU BERNAM BARAT', null, null, 'city', '12'],
            ['HULU BERNAM TIMOR', null, null, 'city', '12'],
            ['SLIM', null, null, 'city', '12'],
            ['SUNGKAI', null, null, 'city', '12'],


            /*
             * === MANJUNG (DINDING)
             */
            ['BERUAS', null, null, 'city', '12'],
            ['LEKIR', null, null, 'city', '12'],
            ['LUMUT', null, null, 'city', '12'],
            ['PENGKALAN BAHARU', null, null, 'city', '12'],
            ['SITIAWAN', null, null, 'city', '12'],


            /*
             * === KINTA
             */
            ['BELANJA', null, null, 'city', '12'],
            ['HULU KINTA', null, null, 'city', '12'],
            ['SUNGAI RAIA', null, null, 'city', '12'],
            ['SUNGAI TERAP', null, null, 'city', '12'],
            ['TANJONG TUALANG', null, null, 'city', '12'],


            /*
             * === KERIAN
             */
            ['BAGAN SERAI', null, null, 'city', '12'],
            ['BAGAN TIANG', null, null, 'city', '12'],
            ['BERIAH', null, null, 'city', '12'],
            ['GUNONG SEMANGGOL', null, null, 'city', '12'],
            ['KUALA KURAU', null, null, 'city', '12'],
            ['PARIT BUNTAR', null, null, 'city', '12'],
            ['SELINSING', null, null, 'city', '12'],
            ['TANJONG PIANDANG', null, null, 'city', '12'],


            /*
             * === KUALA KANGSAR
             */
            ['CHENGAR GALAH', null, null, 'city', '12'],
            ['KAMPONG BUAYA', null, null, 'city', '12'],
            ['KOTA LAMA KANAN', null, null, 'city', '12'],
            ['KOTA LAMA KIRI', null, null, 'city', '12'],
            ['LUBOK MERBAU', null, null, 'city', '12'],
            ['PULAU KAMIRI', null, null, 'city', '12'],
            ['SAIONG', null, null, 'city', '12'],
            ['SENGGANG', null, null, 'city', '12'],
            ['SUNGAI SIPUT', null, null, 'city', '12'],


            /*
             * === LARUT DAN MATANG
             */
            ['ASAM KUMBANG', null, null, 'city', '12'],
            ['BATU KURAU', null, null, 'city', '12'],
            ['BUKIT GANTANG', null, null, 'city', '12'],
            // ['ULU IJOK', null, null, 'city', '12'],
            ['JEBONG', null, null, 'city', '12'],
            ['KAMUNTING', null, null, 'city', '12'],
            ['PENGKALAN AOR', null, null, 'city', '12'],
            // ['SELAMA', null, null, 'city', '12'],
            ['SIMPANG', null, null, 'city', '12'],
            ['SUNGAI LIMAU', null, null, 'city', '12'],
            ['SUNGAI TINGGI', null, null, 'city', '12'],
            ['TERONG', null, null, 'city', '12'],
            ['TUPAI', null, null, 'city', '12'],
            // ['ULU SELAMA', null, null, 'city', '12'],

            ['BANDAR KAMUNTING', null, null, 'city', '12'],
            ['BANDAR KUALA SEPETANG', null, null, 'city', '12'],
            ['BANDAR MATANG', null, null, 'city', '12'],
            ['BANDAR TAIPING', null, null, 'city', '12'],


            /*
             * === HILIR PERAK
             */
            ['BAGAN DATUK', null, null, 'city', '12'],
            ['CHANGKAT JONG', null, null, 'city', '12'],
            ['DURIAN SEBATANG', null, null, 'city', '12'],
            ['HUTAN MELINTANG', null, null, 'city', '12'],
            ['LABU KUBONG', null, null, 'city', '12'],
            ['RUNGKUP', null, null, 'city', '12'],
            ['SUNGAI DURIAN', null, null, 'city', '12'],
            ['SUNGAI MANIK', null, null, 'city', '12'],
            ['TELOK BARU', null, null, 'city', '12'],


            /*
             * === ULU PERAK
             */
            ['BELUKAR SEMANG', null, null, 'city', '12'],
            ['BELUM', null, null, 'city', '12'],
            ['DURIAN PIPIT', null, null, 'city', '12'],
            ['GRIK', null, null, 'city', '12'],
            ['KENERING', null, null, 'city', '12'],
            ['KERUNAI', null, null, 'city', '12'],
            ['PENGKALAN HULU', null, null, 'city', '12'],
            ['LENGGONG', null, null, 'city', '12'],
            ['TEMELONG', null, null, 'city', '12'],
            ['TEMENGOR', null, null, 'city', '12'],


            /*
             * === SELAMA
             */
            ['HULU IJOK', null, null, 'city', '12'],
            ['HULU SELAMA', null, null, 'city', '12'],
            ['SELAMA', null, null, 'city', '12'],


            /*
             * === PERAK TENGAH
             */
            ['BANDAR', null, null, 'city', '12'],
            ['BELANJA', null, null, 'city', '12'],
            ['BOTA', null, null, 'city', '12'],
            ['JAYA BARU', null, null, 'city', '12'],
            ['KAMPONG GAJAH', null, null, 'city', '12'],
            ['KOTA SETIA', null, null, 'city', '12'],
            ['LAMBOR KANAN', null, null, 'city', '12'],
            ['LAMBOR KIRI', null, null, 'city', '12'],
            ['LAYANG LAYANG', null, null, 'city', '12'],
            ['PASIR PANJANG HULU', null, null, 'city', '12'],
            ['PASIR SALAK', null, null, 'city', '12'],
            ['PULAU TIGA', null, null, 'city', '12'],


            /*
             * === KAMPAR
             */
            ['KAMPAR', null, null, 'city', '12'],
            ['TEJA', null, null, 'city', '12'],


            /*
             * === MUALLIM
             */

            /*
             * pahang
             */
            /*
             * === BENTONG
             */
            ['BENTONG', null, null, 'city', '9'],
            ['SABAI', null, null, 'city', '9'],
            ['PELANGAI', null, null, 'city', '9'],


            /*
             * === CAMERON HIGHLANDS
             */
            ['HULU TELOM', null, null, 'city', '9'],
            ['RINGLET', null, null, 'city', '9'],
            ['TANAH RATA', null, null, 'city', '9'],


            /*
             * === JERANTUT
             */
            ['BURAU', null, null, 'city', '9'],
            ['ULU CHEKA', null, null, 'city', '9'],
            ['ULU TEMBELING', null, null, 'city', '9'],
            ['KELOLA', null, null, 'city', '9'],
            ['KUALA TEMBELING', null, null, 'city', '9'],
            ['PEDAH', null, null, 'city', '9'],
            ['PULAU TAWAR', null, null, 'city', '9'],
            ['TEBING TINGGI', null, null, 'city', '9'],
            ['TEH', null, null, 'city', '9'],
            ['TEMBELING', null, null, 'city', '9'],


            /*
             * === KUANTAN
             */
            ['BESERAH', null, null, 'city', '9'],
            ['ULU LEPAR', null, null, 'city', '9'],
            ['ULU KUANTAN', null, null, 'city', '9'],
            ['KUALA KUANTAN', null, null, 'city', '9'],
            ['PENOR', null, null, 'city', '9'],
            ['SUNGAI KARANG', null, null, 'city', '9'],


            /*
             * === LIPIS
             */
            ['BATU YON', null, null, 'city', '9'],
            ['BUDU', null, null, 'city', '9'],
            ['CHEKA', null, null, 'city', '9'],
            ['GUA', null, null, 'city', '9'],
            ['ULU JELAI', null, null, 'city', '9'],
            ['KECHAU', null, null, 'city', '9'],
            ['KUALA LIPIS', null, null, 'city', '9'],
            ['PENJOM', null, null, 'city', '9'],
            ['TANJUNG BESAR', null, null, 'city', '9'],
            ['TELANG', null, null, 'city', '9'],


            /*
             * === PEKAN
             */
            ['BEBAR', null, null, 'city', '9'],
            ['GANCHONG', null, null, 'city', '9'],
            ['KUALA PAHANG', null, null, 'city', '9'],
            // ['LANGGAR', null, null, 'city', '9'],
            ['LEPAR', null, null, 'city', '9'],
            ['PAHANG TUA', null, null, 'city', '9'],
            ['PEKAN', null, null, 'city', '9'],
            ['PENYOR', null, null, 'city', '9'],
            ['PULAU MANIS', null, null, 'city', '9'],
            ['PULAU RUSA', null, null, 'city', '9'],
            ['TEMAI', null, null, 'city', '9'],


            /*
             * === RAUB
             */
            ['BATU TALAM', null, null, 'city', '9'],
            ['DONG', null, null, 'city', '9'],
            ['GALI', null, null, 'city', '9'],
            ['HULU DONG', null, null, 'city', '9'],
            ['SEGA', null, null, 'city', '9'],
            ['SEMANTAN ULU', null, null, 'city', '9'],
            ['TERAS', null, null, 'city', '9'],


            /*
             * === TEMERLOH
             */
            ['BANGAU', null, null, 'city', '9'],
            ['JENDERAK', null, null, 'city', '9'],
            ['KERDAU', null, null, 'city', '9'],
            ['LEBAK', null, null, 'city', '9'],
            ['LIPAT KIJANG', null, null, 'city', '9'],
            ['MENTAKAB', null, null, 'city', '9'],
            ['PERAK', null, null, 'city', '9'],
            ['SANGGANG', null, null, 'city', '9'],
            ['SEMANTAN', null, null, 'city', '9'],
            ['SONGSANG', null, null, 'city', '9'],


            /*
             * === ROMPIN
             */
            ['ENDAU', null, null, 'city', '9'],
            ['KERATONG', null, null, 'city', '9'],
            ['PONTIAN', null, null, 'city', '9'],
            ['ROMPIN', null, null, 'city', '9'],
            ['TIOMAN', null, null, 'city', '9'],


            /*
             * === MARAN
             */
            ['BUKIT SEGUMPAL', null, null, 'city', '9'],
            ['CHENOR', null, null, 'city', '9'],
            ['KERTAU', null, null, 'city', '9'],
            ['LUIT', null, null, 'city', '9'],


            /*
             * === BERA
             */
            ['BERA', null, null, 'city', '9'],
            ['TRIANG', null, null, 'city', '9'],


            /*
             * selangor
             */
            /*
             * === KLANG
             */
            ['KAPAR', null, null, 'city', '16'],
            ['KLANG', null, null, 'city', '16'],
            // ['BANDAR KLANG', null, null, 'city', '16'], // mv 100140


            /*
             * === KUALA LANGAT
             */
            ['BANDAR', null, null, 'city', '16'],
            ['BATU', null, null, 'city', '16'],
            ['JUGRA', null, null, 'city', '16'],
            ['KELANANG', null, null, 'city', '16'],
            ['MORIB', null, null, 'city', '16'],
            ['TANJONG DUABELAS', null, null, 'city', '16'],
            ['TELOK PANGLIMA GARANG', null, null, 'city', '16'],


            /*
             * === 1003 ??? // deprecated?
             */
            /*
             * === KUALA SELANGOR
             */
            ['API-API', null, null, 'city', '16'],
            // ['BATANG BERJUNTAI', null, null, 'city', '16'], // deprecated?
            ['IJOK', null, null, 'city', '16'],
            ['JERAM', null, null, 'city', '16'],
            ['KUALA SELANGOR', null, null, 'city', '16'],
            ['PASANGAN', null, null, 'city', '16'],
            ['TANJONG KARANG', null, null, 'city', '16'],
            // ['UJONG PERMATANG', null, null, 'city', '16'], // deprecated?
            // ['ULU TINGGI', null, null, 'city', '16'], // deprecated?
            ['BESTARI JAYA', null, null, 'city', '16'],


            // ['??', null, null, 'city', '16'], // deprecated?
            // ['??', null, null, 'city', '16'], // deprecated?

            /*
             * === SABAK BERNAM
             */
            ['BAGAN NAKHODA OMAR', null, null, 'city', '16'],
            ['PANCANG BEDENA', null, null, 'city', '16'],
            ['PASIR PANJANG', null, null, 'city', '16'],
            ['SABAK', null, null, 'city', '16'],
            ['SUNGAI PANJANG', null, null, 'city', '16'],


            /*
             * === ULU LANGAT
             */
            ['BERANANG', null, null, 'city', '16'],
            ['CHERAS', null, null, 'city', '16'],
            ['AMPANG', null, null, 'city', '16'],
            ['HULU LANGAT', null, null, 'city', '16'],
            ['HULU SEMENYIH', null, null, 'city', '16'],
            ['KAJANG', null, null, 'city', '16'],
            ['SEMENYIH', null, null, 'city', '16'],


            /*
             * === ULU SELANGOR
             */
            ['BATANG KALI', null, null, 'city', '16'],
            ['BULUH TELOR', null, null, 'city', '16'],
            ['AMPANG PECHAH', null, null, 'city', '16'],
            ['ULU BERNAM', null, null, 'city', '16'],
            ['ULU YAM', null, null, 'city', '16'],
            ['KALUMPANG', null, null, 'city', '16'],
            ['KERLING', null, null, 'city', '16'],
            ['KUALA KALUMPANG', null, null, 'city', '16'],
            ['PERETAK', null, null, 'city', '16'],
            ['RASA', null, null, 'city', '16'],
            ['SERENDAH', null, null, 'city', '16'],
            ['SUNGAI GUMUT', null, null, 'city', '16'],
            ['SUNGAI TINGGI', null, null, 'city', '16'],


            /*
             * === PETALING
             */
            ['BUKIT RAJA', null, null, 'city', '16'],
            ['DAMANSARA', null, null, 'city', '16'],
            ['PETALING', null, null, 'city', '16'],
            ['SUNGAI BULOH', null, null, 'city', '16'],
            // ['BANDAR PETALING JAYA', null, null, 'city', '16'], // mv 100840


            // ['??', null, null, 'city', '16'], // deprecated?

            /*
            /*
             * === GOMBAK
             */
            // ['BATU', null, null, 'city', '16'], // deprecated?
            ['ULU KELANG', null, null, 'city', '16'],
            ['RAWANG', null, null, 'city', '16'],
            ['SETAPAK', null, null, 'city', '16'],


            /*
             * === SEPANG
             */
            ['DENGKIL', null, null, 'city', '16'],
            // ['LABU', null, null, 'city', '16'], // deprecated?
            ['SEPANG', null, null, 'city', '16'],


            /*
             * KUALA LUMPUR
             */
            ['AMPANG', null, null, 'city', '5'],
            ['BATU', null, null, 'city', '5'],
            ['CHERAS', null, null, 'city', '5'],
            ['ULU KELANG', null, null, 'city', '5'],
            ['KUALA LUMPUR', null, null, 'city', '5'],
            ['PETALING', null, null, 'city', '5'],
            ['SETAPAK', null, null, 'city', '5'],


            /*
             * PUTRAJAYA
             */
            ['PUTRAJAYA', null, null, 'city', '11'],

            /*
             * negeri sembilan
             */
            /*
             * === JELEBU
             */
            ['GELAMI LEMI', null, null, 'city', '8'],
            ['KENABOI', null, null, 'city', '8'],
            ['KUALA KELAWANG', null, null, 'city', '8'],
            ['PERADONG', null, null, 'city', '8'],
            ['PERTANG', null, null, 'city', '8'],
            ['TERIANG HILIR', null, null, 'city', '8'],
            // ['HULU KELAWANG', null, null, 'city', '8'],
            // ['HULU TERIANG', null, null, 'city', '8'],


            /*
             * === KUALA PILAH
             */
            ['AMPANG TINGGI', null, null, 'city', '8'],
            ['ULU JEMPOL', null, null, 'city', '8'],
            ['ULU MUAR', null, null, 'city', '8'],
            ['JOHOL', null, null, 'city', '8'],
            ['JUASSEH', null, null, 'city', '8'],
            ['KEPIS', null, null, 'city', '8'],
            ['LANGKAP', null, null, 'city', '8'],
            ['PARIT TINGGI', null, null, 'city', '8'],
            ['PILAH', null, null, 'city', '8'],
            ['SRI MENANTI', null, null, 'city', '8'],
            ['TERACHI', null, null, 'city', '8'],

            // ['BANDAR TERACHI', null, null, 'city', '8'], // deprecated?


            /*
             * === PORT DICKSON
             */
            ['JIMAH', null, null, 'city', '8'],
            ['LINGGI', null, null, 'city', '8'],
            // ['PASIR PANJANG', null, null, 'city', '8'],
            ['PORT DICKSON', null, null, 'city', '8'],
            ['SI RUSA', null, null, 'city', '8'],


            /*
             * === REMBAU
             */
            ['BATU HAMPAR', null, null, 'city', '8'],
            ['BONGEK', null, null, 'city', '8'],
            ['CHEMBONG', null, null, 'city', '8'],
            ['CHENGKAU', null, null, 'city', '8'],
            ['GADONG', null, null, 'city', '8'],
            ['KUNDOR', null, null, 'city', '8'],
            ['LEGONG ILIR', null, null, 'city', '8'],
            ['LEGONG ULU', null, null, 'city', '8'],
            ['MIKU', null, null, 'city', '8'],
            ['NERASAU', null, null, 'city', '8'],
            ['PEDAS', null, null, 'city', '8'],
            ['PILIN', null, null, 'city', '8'],
            ['SELEMAK', null, null, 'city', '8'],
            ['SEMERBOK', null, null, 'city', '8'],
            ['SPRI', null, null, 'city', '8'],
            ['TANJONG KELING', null, null, 'city', '8'],
            ['TITIAN BINTANGOR', null, null, 'city', '8'],


            /*
             * === SEREMBAN
             */
            ['AMPANGAN', null, null, 'city', '8'],
            ['LABU', null, null, 'city', '8'],
            ['LENGGENG', null, null, 'city', '8'],
            ['PANTAI', null, null, 'city', '8'],
            ['RANTAU', null, null, 'city', '8'],
            ['RASAH', null, null, 'city', '8'],
            ['SEREMBAN', null, null, 'city', '8'],
            ['SETUL', null, null, 'city', '8'],

            /*
             * === TAMPIN
             */
            ['AYER KUNING', null, null, 'city', '8'],
            ['GEMAS', null, null, 'city', '8'],
            ['GEMENCHEH', null, null, 'city', '8'],
            ['KERU', null, null, 'city', '8'],
            ['REPAH', null, null, 'city', '8'],
            ['TAMPIN TENGAH', null, null, 'city', '8'],
            ['TEBONG', null, null, 'city', '8'],


            /*
             * === JEMPOL
             */
            ['JELAI', null, null, 'city', '8'],
            ['KUALA JEMPOL', null, null, 'city', '8'],
            ['ROMPIN', null, null, 'city', '8'],
            ['SERTING HILIR', null, null, 'city', '8'],
            ['SERTING ULU', null, null, 'city', '8'],


            /*
             * melaka
             */
            /*
             * === MELAKA TENGAH
             */
            ['ALAI', null, null, 'city', '7'],
            ['AYER MOLEK', null, null, 'city', '7'],
            ['BACHANG', null, null, 'city', '7'],
            ['BALAI PANJANG', null, null, 'city', '7'],
            ['BATU BERENDAM', null, null, 'city', '7'],
            ['BERTAM', null, null, 'city', '7'],
            ['BUKIT BARU', null, null, 'city', '7'],
            ['BUKIT KATIL', null, null, 'city', '7'],
            ['BUKIT LINTANG', null, null, 'city', '7'],
            ['BUKIT PIATU', null, null, 'city', '7'],
            ['BUKIT RAMBAI', null, null, 'city', '7'],
            ['CHENG', null, null, 'city', '7'],
            ['DUYONG', null, null, 'city', '7'],
            ['UJONG PASIR', null, null, 'city', '7'],
            ['KANDANG', null, null, 'city', '7'],
            ['KLEBANG BESAR', null, null, 'city', '7'],
            ['KLEBANG KECHIL', null, null, 'city', '7'],
            ['KRUBONG', null, null, 'city', '7'],
            ['PADANG SEMABOK', null, null, 'city', '7'],
            ['PADANG TEMU', null, null, 'city', '7'],
            ['PAYA RUMPUT', null, null, 'city', '7'],
            ['PRINGGIT', null, null, 'city', '7'],
            ['PERNU', null, null, 'city', '7'],
            ['SEMABOK', null, null, 'city', '7'],
            ['SUNGAI UDANG', null, null, 'city', '7'],
            ['TANGGA BATU', null, null, 'city', '7'],
            ['TANJONG KELING', null, null, 'city', '7'],
            ['TANJONG MINYAK', null, null, 'city', '7'],
            ['TELOK MAS', null, null, 'city', '7'],
            // ['BANDAR MELAKA', null, null, 'city', '7'],


            /*
             * === JASIN
             */
            ['AYER PANAS', null, null, 'city', '7'],
            ['BATANG MALAKA', null, null, 'city', '7'],
            ['BUKIT SENGGEH', null, null, 'city', '7'],
            ['CHABAU', null, null, 'city', '7'],
            ['CHIN CHIN', null, null, 'city', '7'],
            ['CHOHONG', null, null, 'city', '7'],
            ['JASIN', null, null, 'city', '7'],
            ['JUS', null, null, 'city', '7'],
            ['KESANG', null, null, 'city', '7'],
            ['MERLIMAU', null, null, 'city', '7'],
            ['NYALAS', null, null, 'city', '7'],
            ['RIM', null, null, 'city', '7'],
            ['SEBATU', null, null, 'city', '7'],
            ['SELANDAR', null, null, 'city', '7'],
            ['SEMPANG', null, null, 'city', '7'],
            ['SEMUJOK', null, null, 'city', '7'],
            ['SERKAM', null, null, 'city', '7'],
            ['SUNGEI RAMBAI', null, null, 'city', '7'],
            ['TEDONG', null, null, 'city', '7'],
            ['UMBAI', null, null, 'city', '7'],


            /*
             * === ALOR GAJAR
             */
            ["AYER PA'ABAS", null, null, 'city', '7'],
            ['BELIMBING', null, null, 'city', '7'],
            ['BERINGIN', null, null, 'city', '7'],
            ['BRISU', null, null, 'city', '7'],
            // ['TANJUNG TUAN (CAPE RACHADO)', null, null, 'city', '7'],
            ['DURIAN TUNGGAL', null, null, 'city', '7'],
            ['GADEK', null, null, 'city', '7'],
            ['KELEMAK', null, null, 'city', '7'],
            ['KEMUNING', null, null, 'city', '7'],
            ['KUALA LINGGI', null, null, 'city', '7'],
            ['KUALA SUNGEI BARU', null, null, 'city', '7'],
            ['LENDU', null, null, 'city', '7'],
            ['MACHAP', null, null, 'city', '7'],
            ['MASJID TANAH', null, null, 'city', '7'],
            ['MELAKA PINDAH', null, null, 'city', '7'],
            ['MELEKEK', null, null, 'city', '7'],
            ['PADANG SEBANG', null, null, 'city', '7'],
            ['PARIT MELANA', null, null, 'city', '7'],
            ['PEGOH', null, null, 'city', '7'],
            ['PULAU SEBANG', null, null, 'city', '7'],
            ['RAMUAN CHINA BESAR', null, null, 'city', '7'],
            ['RAMUAN CHINA KECHIL', null, null, 'city', '7'],
            ['REMBIA', null, null, 'city', '7'],
            ['SUNGEI BARU HILIR', null, null, 'city', '7'],
            ['SUNGEI BARU TENGAH', null, null, 'city', '7'],
            ['SUNGEI BARU ULU', null, null, 'city', '7'],
            ['SUNGEI BULOH', null, null, 'city', '7'],
            ['SUNGEI PETAI', null, null, 'city', '7'],
            ['SUNGEI SIPUT', null, null, 'city', '7'],
            ['TABOH NANING', null, null, 'city', '7'],
            ['TANJONG RIMAU', null, null, 'city', '7'],
            ['TEBONG', null, null, 'city', '7'],


            /*
             * johor
             */
            /*
             * === batu pahat
             */
            ['BAGAN', null, null, 'city', '2'],
            ['CHAAH BAHRU', null, null, 'city', '2'],
            ['KAMPONG BAHRU', null, null, 'city', '2'],
            ['LINAU', null, null, 'city', '2'],
            ['LUBOK', null, null, 'city', '2'],
            ['MINYAK BEKU', null, null, 'city', '2'],
            ['PESERAI', null, null, 'city', '2'],
            ['SIMPANG KANAN', null, null, 'city', '2'],
            ['SIMPANG KIRI', null, null, 'city', '2'],
            ['SRI GADING', null, null, 'city', '2'],
            ['SRI MEDAN', null, null, 'city', '2'],
            ['SUNGAI KLUANG', null, null, 'city', '2'],
            ['SUNGAI PUNGGOR', null, null, 'city', '2'],
            ['TANJONG SEMBRONG', null, null, 'city', '2'],


            /*
             * === johor bahru
             */
            ['JELUTONG', null, null, 'city', '2'],
            ['PLENTONG', null, null, 'city', '2'],
            ['PULAI', null, null, 'city', '2'],
            // ['SEDENAK', null, null, 'city', '2'], //change to kulaijaya since 2008
            // ['SENAI / KULAI', null, null, 'city', '2'], //change to kulaijaya since 2008
            ['SUNGAI TIRAM', null, null, 'city', '2'],
            ['TANJUNG KUPANG', null, null, 'city', '2'],
            ['TEMBRAU', null, null, 'city', '2'],
            // ['BANDAR JOHOR BAHRU', null, null, 'city', '2'],


            /*
             * === kluang
             */
            ['ULU BENUT', null, null, 'city', '2'],
            ['KAHANG', null, null, 'city', '2'],
            ['KLUANG', null, null, 'city', '2'],
            ['LAYANG-LAYANG', null, null, 'city', '2'],
            ['MACHAP', null, null, 'city', '2'],
            ['NIYOR', null, null, 'city', '2'],
            ['PALOH', null, null, 'city', '2'],
            ['RENGAM', null, null, 'city', '2'],


            /*
             * === kota tinggi
             */
            ['ULU SUNGAI JOHOR', null, null, 'city', '2'],
            ['ULU SUNGAI SELIDI BESAR', null, null, 'city', '2'],
            ['JOHOR LAMA', null, null, 'city', '2'],
            ['KAMBAU', null, null, 'city', '2'],
            ['KOTA TINGGI', null, null, 'city', '2'],
            ['PANTAI TIMUR', null, null, 'city', '2'],
            ['PENGGERANG', null, null, 'city', '2'],
            ['SELIDI BESAR', null, null, 'city', '2'],
            ['SELIDI KECHIL', null, null, 'city', '2'],
            ['TANJUNG SURAT', null, null, 'city', '2'],


            /*
             * === mersing
             */
            ['JEMALUANG', null, null, 'city', '2'],
            ['LENGGOR', null, null, 'city', '2'],
            ['MERSING', null, null, 'city', '2'],
            ['PADANG ENDAU', null, null, 'city', '2'],
            ['PENYABONG', null, null, 'city', '2'],
            ['PULAU AUR', null, null, 'city', '2'],
            ['PULAU BABI', null, null, 'city', '2'],
            ['PULAU PEMANGGIL', null, null, 'city', '2'],
            ['PULAU SIBU', null, null, 'city', '2'],
            ['PULAU TINGGI', null, null, 'city', '2'],
            ['SEMBRONG', null, null, 'city', '2'],
            ['TENGGAROH', null, null, 'city', '2'],
            ['TENGLU', null, null, 'city', '2'],
            ['TRIANG', null, null, 'city', '2'],


            /*
             * === muar
             */
            ['AYER HITAM', null, null, 'city', '2'],
            ['BANDAR', null, null, 'city', '2'],
            ['BUKIT KEPONG', null, null, 'city', '2'],
            // ['BUKIT SERAMPANG', null, null, 'city', '2'], //ledang since 2008
            // ['GRISEK', null, null, 'city', '2'], //ledang since 2008
            ['JALAN BAKRI', null, null, 'city', '2'],
            ['JORAK', null, null, 'city', '2'],
            // ['KESANG', null, null, 'city', '2'], //ledang since 2008
            // ['KUNDANG', null, null, 'city', '2'], //ledang since 2008
            ['LENGA', null, null, 'city', '2'],
            ['PARIT BAKAR', null, null, 'city', '2'],
            ['PARIT JAWA', null, null, 'city', '2'],
            // ['SEROM', null, null, 'city', '2'], //ledang since 2008
            ['SRI MERANTI', null, null, 'city', '2'],
            ['SUNGAI BALANG', null, null, 'city', '2'],
            ['SUNGAI RAYA & KAMPUNG BUKIT PASIR', null, null, 'city', '2'],
            ['SUNGAI TERAP', null, null, 'city', '2'],
            // ['TANGKAK', null, null, 'city', '2'], //ledang since 2008


            /*
             * === pontian
             */
            ['AYER BALOI', null, null, 'city', '2'],
            ['AIR MASIN', null, null, 'city', '2'],
            ['API-API', null, null, 'city', '2'],
            ['BENUT', null, null, 'city', '2'],
            ['JERAM BATU', null, null, 'city', '2'],
            ['PENGKALAN RAJA', null, null, 'city', '2'],
            ['PONTIAN', null, null, 'city', '2'],
            ['RIMBA TERJUN', null, null, 'city', '2'],
            ['SERKAT', null, null, 'city', '2'],
            ['SUNGAI KARANG', null, null, 'city', '2'],
            ['SUNGEI PINGGAN', null, null, 'city', '2'],


            /*
             * === segamat
             */
            ['BEKOK', null, null, 'city', '2'],
            ['BULOH KASAP', null, null, 'city', '2'],
            ['CHAAH', null, null, 'city', '2'],
            ['GEMAS', null, null, 'city', '2'],
            ['GEMEREH', null, null, 'city', '2'],
            ['JABI', null, null, 'city', '2'],
            ['JEMENTAH', null, null, 'city', '2'],
            ['LABIS', null, null, 'city', '2'],
            ['POGOH', null, null, 'city', '2'],
            ['SERMIN', null, null, 'city', '2'],
            ['SUNGAI SEGAMAT', null, null, 'city', '2'],
            // ['BANDAR SEGAMAT', null, null, 'city', '2'],


            /*
             * === kulaijaya // upgrade from kulai since 2008 - http://www.utusan.com.my/utusan/info.asp?y=2008&dt=0622&pub=Utusan_Malaysia&sec=Johor&pg=wj_01.htm
             */
            ['KULAI', null, null, 'city', '2'],
            ['SENAI', null, null, 'city', '2'],
            ['SEDENAK', null, null, 'city', '2'],
            ['BUKIT BATU', null, null, 'city', '2'],


            /*
             * === ledang // upgrade since 2008
             */
            ['TANGKAK', null, null, 'city', '2'],
            ['BUKIT SERAMPANG', null, null, 'city', '2'],
            ['GERSIK', null, null, 'city', '2'],
            ['SEROM', null, null, 'city', '2'],
            ['KUNDANG', null, null, 'city', '2'],
            ['KESANG', null, null, 'city', '2'],


            /*
             * 0112: MISSING DAERAH
             */
            // ['JABI', null, null, 'city', '1'],

            /*
             * labuan
             */
            ['LABUAN', null, null, 'city', '6'],

            /*
             * sabah http://www.sabah.gov.my/pd.trn/mukim.html
             */
            /*
             * === KOTA KINABALU
             */
            ['INANAM', null, null, 'city', '14'],
            ['KEPAYAN', null, null, 'city', '14'],
            ['LIKAS', null, null, 'city', '14'],
            ['LOK KAWI', null, null, 'city', '14'],
            ['MENGGATAL', null, null, 'city', '14'],
            ['SEPANGGAR', null, null, 'city', '14'],
            ['TANJUNG ARU', null, null, 'city', '14'],
            ['TELIPOK', null, null, 'city', '14'],

            /*
             * === PAPAR
             */
            // ['', null, null, 'city', '14'],

            /*
             * === KOTA BELUD
             */
            // ['', null, null, 'city', '14'],

            /*
             * === TUARAN
             */
            ['BERUNGIS', null, null, 'city', '14'],
            ['INDAI', null, null, 'city', '14'],
            ['LEMBAH', null, null, 'city', '14'],
            ['MENGKABONG', null, null, 'city', '14'],
            ['NABALU', null, null, 'city', '14'],
            ['PANTAI', null, null, 'city', '14'],
            ['PEKAN', null, null, 'city', '14'],
            ['SERUSOP', null, null, 'city', '14'],
            ['TAMBALANG', null, null, 'city', '14'],
            ['TENGAH', null, null, 'city', '14'],
            ['ULU', null, null, 'city', '14'],
            ['MANGKALADOI', null, null, 'city', '14'],
            ['TENGHILAN', null, null, 'city', '14'],
            ['TOPOKON', null, null, 'city', '14'],
            ['TUARAN BANDAR', null, null, 'city', '14'],
            ['TAMPARULI', null, null, 'city', '14'],

            /*
             * === KUDAT
             */
            // ['', null, null, 'city', '0203'],

            /*
             * === RANAU
             */
            // ['', null, null, 'city', '0203'],

            /*
             * === SANDAKAN
             */
            // ['', null, null, 'city', '0203'],

            /*
             * === LABUK & SUGUT
             */
            // ['', null, null, 'city', '0203'],

            /*
             * === KINABATANGAN
             */
            // ['', null, null, 'city', '0203'],

            /*
             * === TAWAU
             */
            // ['', null, null, 'city', '0203'],

            /*
             * === LAHAD DATU
             */
            // ['', null, null, 'city', '0203'],

            /*
             * === SEMPORNA
             */
            // ['', null, null, 'city', '0203'],

            /*
             * === KENINGAU
             */
            // ['', null, null, 'city', '0203'],

            /*
             * === TAMBUNAN
             */
            // ['', null, null, 'city', '0203'],

            /*
             * === PENSIANGAN
             */
            // ['', null, null, 'city', '0203'],

            /*
             * === TENOM
             */
            // ['', null, null, 'city', '0203'],

            /*
             * === BEAUFORT
             */
            // ['MEMBAKUT', null, null, 'city', '14'],

            /*
             * === KUALA PENYU
             */
            // ['', null, null, 'city', '14'],

            /*
             * === SIPITANG
             */
            // ['', null, null, 'city', '14'],

            /*
             * === PENAMPANG
             */
            ['DONGGONGON', null, null, 'city', '14'],
            //?
            /*
             * === KOTA MARUDU
             */
            // ['', null, null, 'city', '14'],

            /*
             * === KUNAK
             */
            // ['', null, null, 'city', '14'],

            /*
             * === TONGOD
             */
            // ['', null, null, 'city', '14'],

            /*
             * === PUTATAN
             */
            // ['', null, null, 'city', '14'],

            /*
             * sarawak
             */
            /*
             * === KUCHING
             */
            ['PUEH LAND', null, null, 'city', '15'],
            ['GADING LUNDU', null, null, 'city', '15'],
            ['STUNGKOR', null, null, 'city', '15'],
            ['SAMPADI', null, null, 'city', '15'],
            ['JAGOI', null, null, 'city', '15'],
            ['SENGGI POAK', null, null, 'city', '15'],
            ['MATANG', null, null, 'city', '15'],
            ['SALAK', null, null, 'city', '15'],
            ['PANGKALAN AMPAT', null, null, 'city', '15'],
            ['KUCHING UTARA', null, null, 'city', '15'],
            ['KUCHING TENGAH', null, null, 'city', '15'],
            ['BANDAR KUCHING', null, null, 'city', '15'],
            ['SENTAH-SEGU', null, null, 'city', '15'],
            ['MUARA TEBAS', null, null, 'city', '15'],
            ['BANDAR BATU KAWA', null, null, 'city', '15'],
            ['BATU 8, JALAN MATANG', null, null, 'city', '15'],
            ['BANDAR SUNGAI TENGAH', null, null, 'city', '15'],
            ['BANDAR BATU KITANG', null, null, 'city', '15'],
            ['BATU 15, JALAN SENGGANG', null, null, 'city', '15'],
            ['175, JALAN SENGGANG', null, null, 'city', '15'],
            ['BANDAR JALAN BATU 19, JALAN SENGGANG', null, null, 'city', '15'],
            ['BANDAR BATU 24, JALAN SENGGANG', null, null, 'city', '15'],
            ['BANDAR PANGKALAN KUT', null, null, 'city', '15'],

            /*
             * === SRI AMAN
             */
            ['UNDUP', null, null, 'city', '15'],
            ['KLAUH', null, null, 'city', '15'],
            ['BIJAT', null, null, 'city', '15'],
            ['SKARANG', null, null, 'city', '15'],
            ['KERANGGAS', null, null, 'city', '15'],
            ['MARUP', null, null, 'city', '15'],
            ['LAMANAK', null, null, 'city', '15'],
            ['BUKIT BESAI', null, null, 'city', '15'],
            ['AI ENGKARI', null, null, 'city', '15'],
            ['LESONG', null, null, 'city', '15'],
            ['SELANJANG', null, null, 'city', '15'],
            ['SILANTEK', null, null, 'city', '15'],
            ['SIRNANGGANG', null, null, 'city', '15'],
            ['BANDAR LINGGA', null, null, 'city', '15'],
            ['BANDAR LUBOK ANTU', null, null, 'city', '15'],
            ['BANDAR ENGKILILI', null, null, 'city', '15'],
            ['BANDAR BATU LINTANG', null, null, 'city', '15'],

            /*
             * === SIBU
             */
            ['SEDUAN', null, null, 'city', '15'],
            ['ENGKILO', null, null, 'city', '15'],
            ['PASAI-SIONG', null, null, 'city', '15'],
            ['ASSAN', null, null, 'city', '15'],
            ['MENYAN', null, null, 'city', '15'],
            ['KABANG', null, null, 'city', '15'],
            ['LUKUT', null, null, 'city', '15'],
            ['MAPAI', null, null, 'city', '15'],
            ['MAROH', null, null, 'city', '15'],
            ['SPALI', null, null, 'city', '15'],
            ['QYA-DALAT', null, null, 'city', '15'],
            ['SPAPA', null, null, 'city', '15'],
            ['PAKU', null, null, 'city', '15'],
            ['BANDAR SIBINTEK', null, null, 'city', '15'],

            /*
             * === MIRI
             */
            ['KONSESI MIRI', null, null, 'city', '15'],
            ['BANDAR LUTONG', null, null, 'city', '15'],
            ['BANDAR BAZAR JALAN RIAM', null, null, 'city', '15'],
            ['KUALA BARAM', null, null, 'city', '15'],
            ['LAMBIR', null, null, 'city', '15'],

            /*
             * === LIMBANG
             */
            ['DANAU', null, null, 'city', '15'],
            ['PANARUAN', null, null, 'city', '15'],
            ['TRUSAN', null, null, 'city', '15'],
            ['LAWAS', null, null, 'city', '15'],
            ['MERAPOK', null, null, 'city', '15'],
            ['LIMBANG', null, null, 'city', '15'],
            ['DANAU', null, null, 'city', '15'],
            ['NANGA MEDAMIT', null, null, 'city', '15'],
            ['TRUSAN', null, null, 'city', '15'],
            ['LAWAS', null, null, 'city', '15'],
            ['MERAPOK', null, null, 'city', '15'],
            ['UKONG', null, null, 'city', '15'],
            ['BANDAR SUNDAR', null, null, 'city', '15'],
            ['SUNGAI ADANG', null, null, 'city', '15'],
            ['LONG NAPIR', null, null, 'city', '15'],
            ['SUNGAI ADDANG', null, null, 'city', '15'],
            ['TENGOA-SUKANG', null, null, 'city', '15'],
            ['LONG NERAPAP', null, null, 'city', '15'],
            ['LONG SEMADO', null, null, 'city', '15'],
            ['BAKALALAN', null, null, 'city', '15'],
            ['BATU LAWI', null, null, 'city', '15'],

            /*
             * === SARIKEI
             */
            ['SERENDANG', null, null, 'city', '15'],
            ['MARADONG', null, null, 'city', '15'],
            ['TULAI', null, null, 'city', '15'],
            ['SARIKEI', null, null, 'city', '15'],
            ['BUAN', null, null, 'city', '15'],
            ['SARE', null, null, 'city', '15'],
            ['PEDANUM', null, null, 'city', '15'],
            ['MELURUN', null, null, 'city', '15'],
            ['JIKANG', null, null, 'city', '15'],
            ['BINATANG', null, null, 'city', '15'],

            /*
             * === KAPIT
             */
            ['KATIBAS', null, null, 'city', '15'],
            ['IBAU', null, null, 'city', '15'],
            ['MENUAN', null, null, 'city', '15'],
            ['SUAU', null, null, 'city', '15'],
            ['OYAN', null, null, 'city', '15'],
            ['BANING', null, null, 'city', '15'],
            ['MAJAU', null, null, 'city', '15'],
            ['MENRAL', null, null, 'city', '15'],
            ['METAH', null, null, 'city', '15'],
            ['RIRONG', null, null, 'city', '15'],
            ['MAMU', null, null, 'city', '15'],
            ['ANGKUAH', null, null, 'city', '15'],
            ['PELAGUS', null, null, 'city', '15'],
            ['BANGKIT', null, null, 'city', '15'],
            ['BATU LAGA', null, null, 'city', '15'],
            ['PELANDUK', null, null, 'city', '15'],
            ['ENTEMU', null, null, 'city', '15'],
            ['MENGIONG', null, null, 'city', '15'],
            ['SERANI', null, null, 'city', '15'],
            ['BALUI', null, null, 'city', '15'],
            ['KUMBONG', null, null, 'city', '15'],
            ['MURUM', null, null, 'city', '15'],
            ['PUNAN', null, null, 'city', '15'],
            ['DANUM', null, null, 'city', '15'],

            /*
             * === SAMARAHAN
             */
            ['LESONG', null, null, 'city', '15'],
            ['MENUKU', null, null, 'city', '15'],
            ['KAYAN', null, null, 'city', '15'],
            ['SAMARAHAN', null, null, 'city', '15'],
            ['MUARA TUANG', null, null, 'city', '15'],
            ['BUKAR-SADONG', null, null, 'city', '15'],
            ['SUNGAI KEDUP', null, null, 'city', '15'],
            ['MELIKIN LAND', null, null, 'city', '15'],
            ['SEDILU-GEDONG', null, null, 'city', '15'],
            ['SADONG', null, null, 'city', '15'],
            ['SEBANGAN-KEPAYAN', null, null, 'city', '15'],
            ['PUNDA-SABAL', null, null, 'city', '15'],
            ['BANDAR SEBUYAU', null, null, 'city', '15'],
            ['BANDAR SUNGAI MERAH', null, null, 'city', '15'],
            ['BANDAR SUNAGAI MERANG', null, null, 'city', '15'],
            ['BANDAR SUNGAI PALAH', null, null, 'city', '15'],
            ['BATU 29, JALAN SIMANGGANG', null, null, 'city', '15'],

            /*
             * === BINTULU
             */
            ['BINTULU', null, null, 'city', '15'],
            ['KEMENA', null, null, 'city', '15'],
            ['SEBAUH', null, null, 'city', '15'],
            ['BANDAR LANANG', null, null, 'city', '15'],
            ['BANDAR PANDAN', null, null, 'city', '15'],
            ['BANDAR TUBAU', null, null, 'city', '15'],
            ['SELEZU', null, null, 'city', '15'],
            ['BATU KAPAL', null, null, 'city', '15'],

            /*
             * === MUKAH
             */
            /*
             * === BETONG
             */

            /*
             * LUAR NEGARA
             */
            // ['-', null, null, 'city', '9801']
        ];

        foreach ($places as $place) {
            PlaceService::create(new Place, [
                'name'      => $place[0],
                'code_2'    => $place[1],
                'code_3'    => $place[2],
                'type'      => $place[3],
                'parent_id' => $place[4],
            ]);
        }
    }
}
