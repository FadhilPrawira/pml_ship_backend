<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Port;
use Illuminate\Support\Facades\Hash;

class PortSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // From https://vms.web.id/
        static $ports = array(
            array("name" => "ADARO KELANIS", "address" => "Barito Selatan, Kalimantan Tengah", "country_code" => "ID", "unlocode" => "", "latitude" => "-2.29361027", "longitude" => "114.87275817"),
            array("name" => "Anchorage Area PML 1", "address" => "", "country_code" => "ID", "unlocode" =>
            "", "latitude" => "-3.27366", "longitude" => "114.5573"),
            array("name" => "ASAM2 - KINTAP", "address" => "Tanah Laut, Kalimantan Selatan", "country_code" => "ID", "unlocode" =>
            "", "latitude" => "-3.93999", "longitude" => "115.1784"),
            array("name" => "BIRINGKASI", "address" => "Jeneponto, Sulawesi Selatan", "country_code" => "ID", "unlocode" =>
            "IDBIR", "latitude" => "-4.84282235", "longitude" => "119.50062795"),
            array("name" => "BONTANG", "address" => "Bontang, Kalimantan Timur", "country_code" => "ID", "unlocode" =>
            "IDBXT", "latitude" => "0.034444", "longitude" => "117.529902"),
            array("name" => "BUNATI", "address" => "Tanah Bumbu, Kalimantan Selatan", "country_code" => "ID", "unlocode" =>
            "IDBUT", "latitude" => "-3.762214", "longitude" => "115.639240"),
            array("name" => "CIREBON", "address" => "Cirebon, Jawa Barat", "country_code" => "ID", "unlocode" =>
            "IDCBN", "latitude" => "-6.70384262", "longitude" => "108.57921124"),
            array("name" => "Ciwandan - Cigading", "address" => "Cilegon, Banten", "country_code" => "ID", "unlocode" =>
            "", "latitude" => "-5.983339", "longitude" => "105.953865"),
            array("name" => "DUMAI", "address" => "", "country_code" => "ID", "unlocode" =>
            "IDDUM", "latitude" => "1.679981", "longitude" => "101.45874"),
            array("name" => "Garongkong", "address" => "Barru, Sulawesi Selatan", "country_code" => "ID", "unlocode" =>
            "", "latitude" => "-4.378737", "longitude" => "119.605664"),
            array("name" => "GIJ", "address" => "", "country_code" => "", "unlocode" =>
            "", "latitude" => "-2.670352", "longitude" => "114.41618"),
            array("name" => "GRESIK", "address" => "Gresik, Jawa Timur", "country_code" => "ID", "unlocode" =>
            "IDGRE", "latitude" => "-7.122356", "longitude" => "112.649689"),
            array("name" => "JETTY AMI - KABANEA", "address" => "", "country_code" => "ID", "unlocode" =>
            "", "latitude" => "-5.42796526", "longitude" => "122.04601407"),
            array("name" => "JETTY IMIP - MOROWALI", "address" => "", "country_code" => "ID", "unlocode" =>
            "", "latitude" => "-2.81591474", "longitude" => "122.16702461"),
            array("name" => "Kampot International", "address" => "", "country_code" => "", "unlocode" =>
            "", "latitude" => "10.415245", "longitude" => "103.820671"),
            array("name" => "KENDAWANGAN", "address" => "Kendawangan, Kalimantan Barat", "country_code" => "ID", "unlocode" =>
            "IDKDW", "latitude" => "-2.36730903", "longitude" => "110.1475837"),
            array("name" => "Koh Si Chang", "address" => "", "country_code" => "", "unlocode" =>
            "", "latitude" => "13.131976", "longitude" => "100.824966"),
            array("name" => "KUMAI", "address" => "Kotawaringin Barat, Kalimantan Tengah", "country_code" => "ID", "unlocode" =>
            "IDKUM", "latitude" => "-2.74144285", "longitude" => "111.72657576"),
            array("name" => "LAMONGAN", "address" => "Lamongan, Jawa Timur", "country_code" => "ID", "unlocode" =>
            "IDLAM", "latitude" => "-6.862051", "longitude" => "112.418118"),
            array("name" => "MALOY", "address" => "Kutai Timur, Kalimantan Timur", "country_code" => "ID", "unlocode" =>
            "", "latitude" => "0.92613", "longitude" => "117.985909"),
            array("name" => "MERAK/BOJANEGARA", "address" => "", "country_code" => "", "unlocode" =>
            "", "latitude" => "-5.88879486", "longitude" => "106.07524525"),
            array("name" => "MERAMO", "address" => "", "country_code" => "", "unlocode" =>
            "", "latitude" => "-4.08251103", "longitude" => "122.65462875"),
            array("name" => "Morosi", "address" => "", "country_code" => "", "unlocode" =>
            "", "latitude" => "-3.82252767", "longitude" => "122.49133587"),
            array("name" => "MTU HABCO", "address" => "", "country_code" => "", "unlocode" =>
            "", "latitude" => "-1.99420296", "longitude" => "114.89971583"),
            array("name" => "PALOPO", "address" => "", "country_code" => "", "unlocode" =>
            "", "latitude" => "-2.983739", "longitude" => "120.211487"),
            array("name" => "PARINGLAHUNG", "address" => "", "country_code" => "", "unlocode" =>
            "", "latitude" => "-1.215785", "longitude" => "114.807436"),
            array("name" => "PATRIA MARITIME PERKASA BATAM", "address" => "", "country_code" => "", "unlocode" =>
            "", "latitude" => "1.01416537", "longitude" => "103.93656492"),
            array("name" => "PERTAMINA BALIKPAPAN", "address" => "", "country_code" => "", "unlocode" =>
            "", "latitude" => "-1.24738028", "longitude" => "116.82070905"),
            array("name" => "PLTU BARRU", "address" => "", "country_code" => "", "unlocode" =>
            "", "latitude" => "-4.29989503", "longitude" => "119.62755203"),
            array("name" => "PLTU BATANG", "address" => "", "country_code" => "", "unlocode" =>
            "", "latitude" => "-6.89916069", "longitude" => "109.80869293"),
            array("name" => "PLTU CILACAP", "address" => "", "country_code" => "", "unlocode" =>
            "", "latitude" => "-7.70172061", "longitude" => "109.08634186"),
            array("name" => "PLTU INDRAMAYU", "address" => "", "country_code" => "", "unlocode" =>
            "", "latitude" => "-6.264963", "longitude" => "107.972946"),
            array("name" => "PLTU JAWA 7", "address" => "", "country_code" => "", "unlocode" =>
            "", "latitude" => "-5.9789", "longitude" => "106.12793"),
            array("name" => "PLTU JENEPONTO", "address" => "", "country_code" => "", "unlocode" =>
            "", "latitude" => "-5.61199248", "longitude" => "119.54176426"),
            array("name" => "PLTU LABUAN", "address" => "", "country_code" => "", "unlocode" =>
            "", "latitude" => "-6.398583", "longitude" => "105.818122"),
            array("name" => "PLTU LONTAR", "address" => "", "country_code" => "", "unlocode" =>
            "", "latitude" => "-6.031737", "longitude" => "106.470394"),
            array("name" => "PLTU PACITAN", "address" => "", "country_code" => "", "unlocode" =>
            "", "latitude" => "-8.26802099", "longitude" => "111.36789322"),
            array("name" => "PLTU PAITON", "address" => "Probolinggo, Jawa Timur", "country_code" => "ID", "unlocode" =>
            "IDPAI", "latitude" => "-7.71521343", "longitude" => "113.58674135"),
            array("name" => "PLTU Pangkalan Susu", "address" => "", "country_code" => "", "unlocode" =>
            "", "latitude" => "4.12022262", "longitude" => "98.25845718"),
            array("name" => "PLTU PELABUHAN RATU", "address" => "", "country_code" => "", "unlocode" =>
            "", "latitude" => "-7.02069592", "longitude" => "106.53081894"),
            array("name" => "PLTU SURALAYA", "address" => "", "country_code" => "", "unlocode" =>
            "", "latitude" => "-5.88356157", "longitude" => "106.0334301"),
            array("name" => "PROBOLINGGO", "address" => "Probolinggo, Jawa Timur", "country_code" => "ID", "unlocode" =>
            "IDPRO", "latitude" => "-7.72230376", "longitude" => "113.22029116"),
            array("name" => "PULANG PISAU", "address" => "Pulang Pisau, Kalimantan Tengah", "country_code" => "ID", "unlocode" =>
            "IDPPS", "latitude" => "-3.14829", "longitude" => "114.138539"),
            array("name" => "Pulau Gebe", "address" => "Halmahera Tengah, Maluku Utara", "country_code" => "ID", "unlocode" =>
            "IDGEB", "latitude" => "-0.06797789", "longitude" => "129.38598633"),
            array("name" => "REMBANG", "address" => "Rembang, Jawa Tengah", "country_code" => "ID", "unlocode" =>
            "IDREM", "latitude" => "-6.64746412", "longitude" => "111.49072473"),
            array("name" => "SANGATTA", "address" => "Kutai Timur, Kalimantan Timur", "country_code" => "ID", "unlocode" =>
            "IDSGQ", "latitude" => "0.533356", "longitude" => "117.661324"),
            array("name" => "SEBAKIS", "address" => "", "country_code" => "", "unlocode" =>
            "", "latitude" => "4.0848", "longitude" => "117.277548"),
            array("name" => "Siam City Cement Plant Jetty", "address" => "", "country_code" => "", "unlocode" =>
            "", "latitude" => "10.21061431", "longitude" => "104.58417892"),
            array("name" => "SUNGAI DANAU", "address" => "Tanah Bumbu, Kalimantan Selatan", "country_code" => "ID", "unlocode" =>
            "", "latitude" => "-3.819480,", "longitude" => "115.465165"),
            array("name" => "SUNGAI PUTING", "address" => "Tapin, Kalimantan Selatan", "country_code" => "ID", "unlocode" =>
            "", "latitude" => "-2.93258333", "longitude" => "114.87030029"),
            array("name" => "T. TIMBAU", "address" => "Barito Selatan, Kalimantan Tengah", "country_code" => "ID", "unlocode" =>
            "", "latitude" => "-2.105017", "longitude" => "114.867691"),
            array("name" => "TABONEO", "address" => "Banjarmasin, Kalimantan Selatan", "country_code" => "ID", "unlocode" =>
            "IDTAB", "latitude" => "-3.66719526", "longitude" => "114.4449578"),
            array("name" => "TANAH GROGOT", "address" => "Paser, Kalimantan Timur", "country_code" => "ID", "unlocode" =>
            "IDTNB", "latitude" => "-1.815734", "longitude" => "116.159284
"),
            array("name" => "TARAHAN", "address" => "Katibung, Lampung Selatan", "country_code" => "ID", "unlocode" =>
            "IDTRH", "latitude" => "-5.52441", "longitude" => "105.346001"),
            array("name" => "TG. BATU", "address" => "Karimun, Kepulauan Riau", "country_code" => "ID", "unlocode" =>
            "IDTBT", "latitude" => "2.337263", "longitude" => "118.066169"),
            array("name" => "TG. SELOR", "address" => "Bulungan, Kalimantan Utara", "country_code" => "ID", "unlocode" =>
            "IDTJS", "latitude" => "2.842738", "longitude" => "117.361158"),
            array("name" => "Tha Sala", "address" => "Tha Sala, Nakhon Si Thammarat", "country_code" => "TH", "unlocode" =>
            "THTHA", "latitude" => "8.663314", "longitude" => "99.949577"),
            array("name" => "Tha Thong", "address" => "", "country_code" => "TH", "unlocode" =>
            "", "latitude" => "9.177601", "longitude" => "99.376316"),
            array("name" => "TRISAKTI", "address" => "", "country_code" => "", "unlocode" =>
            "", "latitude" => "-3.31971343", "longitude" => "114.56100089"),
            array("name" => "TUBAN", "address" => "Tuban, Jawa Timur", "country_code" => "ID", "unlocode" =>
            "IDTBN", "latitude" => "-6.78813565", "longitude" => "111.89856095"),
            array("name" => "Vung Tau/HCM", "address" => "", "country_code" => "", "unlocode" =>
            "", "latitude" => "10.378414", "longitude" => "107.009583"),
        );

        foreach ($ports as $port) {
            Port::factory()->create([
                'name' => $port['name'],
                'address' => $port['address'],
                'country_code' => $port['country_code'],
                'unlocode' => $port['unlocode'],
                'latitude' => $port['latitude'],
                'longitude' => $port['longitude'],
            ]);
        }

        // Port::factory(10)->create();
    }
}
