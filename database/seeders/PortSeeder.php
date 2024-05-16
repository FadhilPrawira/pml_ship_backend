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
            array("name" => "ADARO KELANIS", "address" => "Barito Selatan, Kalimantan Tengah", "country_code" => "ID", "unlocode" => "", "latitude" => "
-2.29226,", "longitude" => "114.8693"),
            array("name" => "Anchorage Area PML 1", "address" => "", "country_code" => "ID", "unlocode" =>
            "", "latitude" => "-3.27366", "longitude" => "114.5573"),
            array("name" => "ASAM2 - KINTAP", "address" => "Tanah Laut, Kalimantan Selatan", "country_code" => "ID", "unlocode" =>
            "", "latitude" => "-3.93999", "longitude" => "115.1784"),
            array("name" => "BIRINGKASI", "address" => "Jeneponto, Sulawesi Selatan", "country_code" => "ID", "unlocode" =>
            "IDBIR", "latitude" => "-4.84256", "longitude" => "119.50051"),
            array("name" => "BONTANG", "address" => "Bontang, Kalimantan Timur", "country_code" => "ID", "unlocode" =>
            "IDBXT", "latitude" => "", "longitude" => ""),
            array("name" => "BUNATI", "address" => "Tanah Bumbu, Kalimantan Selatan", "country_code" => "ID", "unlocode" =>
            "IDBUT", "latitude" => "", "longitude" => ""),
            array("name" => "CIREBON", "address" => "Cirebon, Jawa Barat", "country_code" => "ID", "unlocode" =>
            "IDCBN", "latitude" => "", "longitude" => ""),
            array("name" => "Ciwandan - Cigading", "address" => "Cilegon, Banten", "country_code" => "ID", "unlocode" =>
            "", "latitude" => "", "longitude" => ""),
            array("name" => "DUMAI", "address" => "", "country_code" => "ID", "unlocode" =>
            "IDDUM", "latitude" => "", "longitude" => ""),
            array("name" => "Garongkong", "address" => "Barru, Sulawesi Selatan", "country_code" => "ID", "unlocode" =>
            "", "latitude" => "", "longitude" => ""),
            array("name" => "GIJ", "address" => "", "country_code" => "", "unlocode" =>
            "", "latitude" => "", "longitude" => ""),
            array("name" => "GRESIK", "address" => "Gresik, Jawa Timur", "country_code" => "ID", "unlocode" =>
            "IDGRE", "latitude" => "", "longitude" => ""),
            array("name" => "JETTY AMI - KABANEA", "address" => "", "country_code" => "ID", "unlocode" =>
            "", "latitude" => "", "longitude" => ""),
            array("name" => "JETTY IMIP - MOROWALI", "address" => "", "country_code" => "ID", "unlocode" =>
            "", "latitude" => "", "longitude" => ""),
            array("name" => "Kampot International", "address" => "", "country_code" => "", "unlocode" =>
            "", "latitude" => "", "longitude" => ""),
            array("name" => "KENDAWANGAN", "address" => "Kendawangan, Kalimantan Barat", "country_code" => "ID", "unlocode" =>
            "IDKDW", "latitude" => "", "longitude" => ""),
            array("name" => "Koh Si Chang", "address" => "", "country_code" => "", "unlocode" =>
            "", "latitude" => "", "longitude" => ""),
            array("name" => "KUMAI", "address" => "Kotawaringin Barat, Kalimantan Tengah", "country_code" => "ID", "unlocode" =>
            "IDKUM", "latitude" => "", "longitude" => ""),
            array("name" => "LAMONGAN", "address" => "Lamongan, Jawa Timur", "country_code" => "ID", "unlocode" =>
            "IDLAM", "latitude" => "", "longitude" => ""),
            array("name" => "MALOY", "address" => "Kutai Timur, Kalimantan Timur", "country_code" => "ID", "unlocode" =>
            "", "latitude" => "", "longitude" => ""),
            array("name" => "MERAK/BOJANEGARA", "address" => "", "country_code" => "", "unlocode" =>
            "", "latitude" => "", "longitude" => ""),
            array("name" => "MERAMO", "address" => "", "country_code" => "", "unlocode" =>
            "", "latitude" => "", "longitude" => ""),
            array("name" => "Morosi", "address" => "", "country_code" => "", "unlocode" =>
            "", "latitude" => "", "longitude" => ""),
            array("name" => "MTU HABCO", "address" => "", "country_code" => "", "unlocode" =>
            "", "latitude" => "", "longitude" => ""),
            array("name" => "PALOPO", "address" => "", "country_code" => "", "unlocode" =>
            "", "latitude" => "", "longitude" => ""),
            array("name" => "PARINGLAHUNG", "address" => "", "country_code" => "", "unlocode" =>
            "", "latitude" => "", "longitude" => ""),
            array("name" => "PATRIA MARITIME PERKASA BATAM", "address" => "", "country_code" => "", "unlocode" =>
            "", "latitude" => "", "longitude" => ""),
            array("name" => "PERTAMINA BALIKPAPAN", "address" => "", "country_code" => "", "unlocode" =>
            "", "latitude" => "", "longitude" => ""),
            array("name" => "PLTU BARRU", "address" => "", "country_code" => "", "unlocode" =>
            "", "latitude" => "", "longitude" => ""),
            array("name" => "PLTU BATANG", "address" => "", "country_code" => "", "unlocode" =>
            "", "latitude" => "", "longitude" => ""),
            array("name" => "PLTU CILACAP", "address" => "", "country_code" => "", "unlocode" =>
            "", "latitude" => "", "longitude" => ""),
            array("name" => "PLTU INDRAMAYU", "address" => "", "country_code" => "", "unlocode" =>
            "", "latitude" => "", "longitude" => ""),
            array("name" => "PLTU JAWA 7", "address" => "", "country_code" => "", "unlocode" =>
            "", "latitude" => "", "longitude" => ""),
            array("name" => "PLTU JENEPONTO", "address" => "", "country_code" => "", "unlocode" =>
            "", "latitude" => "", "longitude" => ""),
            array("name" => "PLTU LABUAN", "address" => "", "country_code" => "", "unlocode" =>
            "", "latitude" => "", "longitude" => ""),
            array("name" => "PLTU LONTAR", "address" => "", "country_code" => "", "unlocode" =>
            "", "latitude" => "", "longitude" => ""),
            array("name" => "PLTU PACITAN", "address" => "", "country_code" => "", "unlocode" =>
            "", "latitude" => "", "longitude" => ""),
            array("name" => "PLTU PAITON", "address" => "Probolinggo, Jawa Timur", "country_code" => "ID", "unlocode" =>
            "IDPAI", "latitude" => "", "longitude" => ""),
            array("name" => "PLTU Pangkalan Susu", "address" => "", "country_code" => "", "unlocode" =>
            "", "latitude" => "", "longitude" => ""),
            array("name" => "PLTU PELABUHAN RATU", "address" => "", "country_code" => "", "unlocode" =>
            "", "latitude" => "", "longitude" => ""),
            array("name" => "PLTU SURALAYA", "address" => "", "country_code" => "", "unlocode" =>
            "", "latitude" => "", "longitude" => ""),
            array("name" => "PROBOLINGGO", "address" => "Probolinggo, Jawa Timur", "country_code" => "ID", "unlocode" =>
            "IDPRO", "latitude" => "", "longitude" => ""),
            array("name" => "PULANG PISAU", "address" => "Pulang Pisau, Kalimantan Tengah", "country_code" => "ID", "unlocode" =>
            "IDPPS", "latitude" => "", "longitude" => ""),
            array("name" => "Pulau Gebe", "address" => "Halmahera Tengah, Maluku Utara", "country_code" => "ID", "unlocode" =>
            "IDGEB", "latitude" => "", "longitude" => ""),
            array("name" => "REMBANG", "address" => "Rembang, Jawa Tengah", "country_code" => "ID", "unlocode" =>
            "IDREM", "latitude" => "", "longitude" => ""),
            array("name" => "SANGATTA", "address" => "Kutai Timur, Kalimantan Timur", "country_code" => "ID", "unlocode" =>
            "IDSGQ", "latitude" => "", "longitude" => ""),
            array("name" => "SEBAKIS", "address" => "", "country_code" => "", "unlocode" =>
            "", "latitude" => "", "longitude" => ""),
            array("name" => "Siam City Cement Plant Jetty", "address" => "", "country_code" => "", "unlocode" =>
            "", "latitude" => "", "longitude" => ""),
            array("name" => "SUNGAI DANAU", "address" => "Tanah Bumbu, Kalimantan Selatan", "country_code" => "ID", "unlocode" =>
            "", "latitude" => "", "longitude" => ""),
            array("name" => "SUNGAI PUTING", "address" => "Tapin, Kalimantan Selatan", "country_code" => "ID", "unlocode" =>
            "", "latitude" => "", "longitude" => ""),
            array("name" => "T. TIMBAU", "address" => "Barito Selatan, Kalimantan Tengah", "country_code" => "ID", "unlocode" =>
            "", "latitude" => "", "longitude" => ""),
            array("name" => "TABONEO", "address" => "Banjarmasin, Kalimantan Selatan", "country_code" => "ID", "unlocode" =>
            "IDTAB", "latitude" => "", "longitude" => ""),
            array("name" => "TANAH GROGOT", "address" => "Paser, Kalimantan Timur", "country_code" => "ID", "unlocode" =>
            "IDTNB", "latitude" => "", "longitude" => ""),
            array("name" => "TARAHAN", "address" => "Katibung, Lampung Selatan", "country_code" => "ID", "unlocode" =>
            "IDTRH", "latitude" => "", "longitude" => ""),
            array("name" => "TG. BATU", "address" => "Karimun, Kepulauan Riau", "country_code" => "ID", "unlocode" =>
            "IDTBT", "latitude" => "", "longitude" => ""),
            array("name" => "TG. SELOR", "address" => "Bulungan, Kalimantan Utara", "country_code" => "ID", "unlocode" =>
            "IDTJS", "latitude" => "", "longitude" => ""),
            array("name" => "Tha Sala", "address" => "Tha Sala, Nakhon Si Thammarat", "country_code" => "TH", "unlocode" =>
            "THTHA", "latitude" => "", "longitude" => ""),
            array("name" => "Tha Thong", "address" => "", "country_code" => "TH", "unlocode" =>
            "", "latitude" => "", "longitude" => ""),
            array("name" => "TRISAKTI", "address" => "", "country_code" => "", "unlocode" =>
            "", "latitude" => "", "longitude" => ""),
            array("name" => "TUBAN", "address" => "Tuban, Jawa Timur", "country_code" => "ID", "unlocode" =>
            "IDTBN", "latitude" => "", "longitude" => ""),
            array("name" => "Vung Tau/HCM", "address" => "", "country_code" => "", "unlocode" =>
            "", "latitude" => "", "longitude" => ""),
        );

        foreach ($ports as $port) {
            Port::factory()->create([
                'name' => $port['name'],
                'address' => $port['address'],
                'country_code' => $port['country_code'],
                'unlocode' => $port['unlocode'],
            ]);
        }

        // Port::factory(10)->create();
    }
}
