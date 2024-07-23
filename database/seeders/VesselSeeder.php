<?php

namespace Database\Seeders;

use App\Models\Vessel;
use Carbon\Carbon;
use DateTime;
use GuzzleHttp\Client;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VesselSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Current time
        $currentDateTime = Carbon::now();

        static $vessels = array(
            array('pml_internal_vessel_id' => '1699', 'vessel_name' => 'MV PATRIA NAWASENA 1', 'vessel_tx_id' => '518883', 'vessel_lat' => '-6.867798811083504', 'vessel_lon' => '110.37628806965394', 'vessel_vts_speed_knot' => '3', 'vessel_calc_speed_knot' => '3', 'vessel_heading_degree' => '135', 'pml_last_updated_at' => $currentDateTime),
            array('pml_internal_vessel_id' => '1670', 'vessel_name' => 'SAMASTA NINGRUM', 'vessel_tx_id' => '706688', 'vessel_lat' => '-6.867798811083504', 'vessel_lon' => '110.37628806965394', 'vessel_vts_speed_knot' => '3', 'vessel_calc_speed_knot' => '3', 'vessel_heading_degree' => '135', 'pml_last_updated_at' => $currentDateTime),
            array('pml_internal_vessel_id' => '1463', 'vessel_name' => 'TB BENGKALIS 1', 'vessel_tx_id' => '501442', 'vessel_lat' => '-6.867798811083504', 'vessel_lon' => '110.37628806965394', 'vessel_vts_speed_knot' => '3', 'vessel_calc_speed_knot' => '3', 'vessel_heading_degree' => '135', 'pml_last_updated_at' => $currentDateTime),
            array('pml_internal_vessel_id' => '1238', 'vessel_name' => 'TB BRAHMA 1', 'vessel_tx_id' => '501327', 'vessel_lat' => '-6.867798811083504', 'vessel_lon' => '110.37628806965394', 'vessel_vts_speed_knot' => '3', 'vessel_calc_speed_knot' => '3', 'vessel_heading_degree' => '135', 'pml_last_updated_at' => $currentDateTime),
            array('pml_internal_vessel_id' => '1298', 'vessel_name' => 'TB BRAHMA 10', 'vessel_tx_id' => '501319', 'vessel_lat' => '-6.867798811083504', 'vessel_lon' => '110.37628806965394', 'vessel_vts_speed_knot' => '3', 'vessel_calc_speed_knot' => '3', 'vessel_heading_degree' => '135', 'pml_last_updated_at' => $currentDateTime),
            array('pml_internal_vessel_id' => '1328', 'vessel_name' => 'TB BRAHMA 11', 'vessel_tx_id' => '541433', 'vessel_lat' => '-6.867798811083504', 'vessel_lon' => '110.37628806965394', 'vessel_vts_speed_knot' => '3', 'vessel_calc_speed_knot' => '3', 'vessel_heading_degree' => '135', 'pml_last_updated_at' => $currentDateTime),
            array('pml_internal_vessel_id' => '1296', 'vessel_name' => 'TB BRAHMA 12', 'vessel_tx_id' => '501449', 'vessel_lat' => '-6.867798811083504', 'vessel_lon' => '110.37628806965394', 'vessel_vts_speed_knot' => '3', 'vessel_calc_speed_knot' => '3', 'vessel_heading_degree' => '135', 'pml_last_updated_at' => $currentDateTime),
            array('pml_internal_vessel_id' => '1241', 'vessel_name' => 'TB BRAHMA 15', 'vessel_tx_id' => '501318', 'vessel_lat' => '-6.867798811083504', 'vessel_lon' => '110.37628806965394', 'vessel_vts_speed_knot' => '3', 'vessel_calc_speed_knot' => '3', 'vessel_heading_degree' => '135', 'pml_last_updated_at' => $currentDateTime),
            array('pml_internal_vessel_id' => '1240', 'vessel_name' => 'TB BRAHMA 2', 'vessel_tx_id' => '501345', 'vessel_lat' => '-6.867798811083504', 'vessel_lon' => '110.37628806965394', 'vessel_vts_speed_knot' => '3', 'vessel_calc_speed_knot' => '3', 'vessel_heading_degree' => '135', 'pml_last_updated_at' => $currentDateTime),
            array('pml_internal_vessel_id' => '1324', 'vessel_name' => 'TB BRAHMA 3', 'vessel_tx_id' => '543373', 'vessel_lat' => '-6.867798811083504', 'vessel_lon' => '110.37628806965394', 'vessel_vts_speed_knot' => '3', 'vessel_calc_speed_knot' => '3', 'vessel_heading_degree' => '135', 'pml_last_updated_at' => $currentDateTime),
            array('pml_internal_vessel_id' => '1293', 'vessel_name' => 'TB BRAHMA 5', 'vessel_tx_id' => '501328', 'vessel_lat' => '-6.867798811083504', 'vessel_lon' => '110.37628806965394', 'vessel_vts_speed_knot' => '3', 'vessel_calc_speed_knot' => '3', 'vessel_heading_degree' => '135', 'pml_last_updated_at' => $currentDateTime),
            array('pml_internal_vessel_id' => '1237', 'vessel_name' => 'TB BRAHMA 6', 'vessel_tx_id' => '501336', 'vessel_lat' => '-6.867798811083504', 'vessel_lon' => '110.37628806965394', 'vessel_vts_speed_knot' => '3', 'vessel_calc_speed_knot' => '3', 'vessel_heading_degree' => '135', 'pml_last_updated_at' => $currentDateTime),
            array('pml_internal_vessel_id' => '622', 'vessel_name' => 'TB BRAHMA 7', 'vessel_tx_id' => '541435', 'vessel_lat' => '-6.867798811083504', 'vessel_lon' => '110.37628806965394', 'vessel_vts_speed_knot' => '3', 'vessel_calc_speed_knot' => '3', 'vessel_heading_degree' => '135', 'pml_last_updated_at' => $currentDateTime),
            array('pml_internal_vessel_id' => '1297', 'vessel_name' => 'TB BRAHMA 8', 'vessel_tx_id' => '501360', 'vessel_lat' => '-6.867798811083504', 'vessel_lon' => '110.37628806965394', 'vessel_vts_speed_knot' => '3', 'vessel_calc_speed_knot' => '3', 'vessel_heading_degree' => '135', 'pml_last_updated_at' => $currentDateTime),
            array('pml_internal_vessel_id' => '1236', 'vessel_name' => 'TB BRAHMA 9', 'vessel_tx_id' => '501335', 'vessel_lat' => '-6.867798811083504', 'vessel_lon' => '110.37628806965394', 'vessel_vts_speed_knot' => '3', 'vessel_calc_speed_knot' => '3', 'vessel_heading_degree' => '135', 'pml_last_updated_at' => $currentDateTime),
            array('pml_internal_vessel_id' => '1466', 'vessel_name' => 'TB BSP 01', 'vessel_tx_id' => '501508', 'vessel_lat' => '-6.867798811083504', 'vessel_lon' => '110.37628806965394', 'vessel_vts_speed_knot' => '3', 'vessel_calc_speed_knot' => '3', 'vessel_heading_degree' => '135', 'pml_last_updated_at' => $currentDateTime),
            array('pml_internal_vessel_id' => '1570', 'vessel_name' => 'TB EKA MARIS', 'vessel_tx_id' => '501424', 'vessel_lat' => '-6.867798811083504', 'vessel_lon' => '110.37628806965394', 'vessel_vts_speed_knot' => '3', 'vessel_calc_speed_knot' => '3', 'vessel_heading_degree' => '135', 'pml_last_updated_at' => $currentDateTime),
            array('pml_internal_vessel_id' => '1358', 'vessel_name' => 'TB EKA MARIS 10', 'vessel_tx_id' => '502621', 'vessel_lat' => '-6.867798811083504', 'vessel_lon' => '110.37628806965394', 'vessel_vts_speed_knot' => '3', 'vessel_calc_speed_knot' => '3', 'vessel_heading_degree' => '135', 'pml_last_updated_at' => $currentDateTime),
            array('pml_internal_vessel_id' => '1467', 'vessel_name' => 'TB EKA MARIS 8', 'vessel_tx_id' => '501339', 'vessel_lat' => '-6.867798811083504', 'vessel_lon' => '110.37628806965394', 'vessel_vts_speed_knot' => '3', 'vessel_calc_speed_knot' => '3', 'vessel_heading_degree' => '135', 'pml_last_updated_at' => $currentDateTime),
            array('pml_internal_vessel_id' => '1373', 'vessel_name' => 'TB EKA MARIS 9', 'vessel_tx_id' => '501423', 'vessel_lat' => '-6.867798811083504', 'vessel_lon' => '110.37628806965394', 'vessel_vts_speed_knot' => '3', 'vessel_calc_speed_knot' => '3', 'vessel_heading_degree' => '135', 'pml_last_updated_at' => $currentDateTime),
            array('pml_internal_vessel_id' => '1684', 'vessel_name' => 'TB FERY XXI', 'vessel_tx_id' => '502620', 'vessel_lat' => '-6.867798811083504', 'vessel_lon' => '110.37628806965394', 'vessel_vts_speed_knot' => '3', 'vessel_calc_speed_knot' => '3', 'vessel_heading_degree' => '135', 'pml_last_updated_at' => $currentDateTime),
            array('pml_internal_vessel_id' => '1687', 'vessel_name' => 'TB FERY XXIV', 'vessel_tx_id' => '501451', 'vessel_lat' => '-6.867798811083504', 'vessel_lon' => '110.37628806965394', 'vessel_vts_speed_knot' => '3', 'vessel_calc_speed_knot' => '3', 'vessel_heading_degree' => '135', 'pml_last_updated_at' => $currentDateTime),
            array('pml_internal_vessel_id' => '1696', 'vessel_name' => 'TB FERY XXVI', 'vessel_tx_id' => '502564', 'vessel_lat' => '-6.867798811083504', 'vessel_lon' => '110.37628806965394', 'vessel_vts_speed_knot' => '3', 'vessel_calc_speed_knot' => '3', 'vessel_heading_degree' => '135', 'pml_last_updated_at' => $currentDateTime),
            array('pml_internal_vessel_id' => '1697', 'vessel_name' => 'TB GONAYA', 'vessel_tx_id' => '501331', 'vessel_lat' => '-6.867798811083504', 'vessel_lon' => '110.37628806965394', 'vessel_vts_speed_knot' => '3', 'vessel_calc_speed_knot' => '3', 'vessel_heading_degree' => '135', 'pml_last_updated_at' => $currentDateTime),
            array('pml_internal_vessel_id' => '1480', 'vessel_name' => 'TB GONAYA X', 'vessel_tx_id' => '510028', 'vessel_lat' => '-6.867798811083504', 'vessel_lon' => '110.37628806965394', 'vessel_vts_speed_knot' => '3', 'vessel_calc_speed_knot' => '3', 'vessel_heading_degree' => '135', 'pml_last_updated_at' => $currentDateTime),
            array('pml_internal_vessel_id' => '1357', 'vessel_name' => 'TB GONAYA XIV', 'vessel_tx_id' => '-', 'vessel_lat' => '-6.867798811083504', 'vessel_lon' => '110.37628806965394', 'vessel_vts_speed_knot' => '3', 'vessel_calc_speed_knot' => '3', 'vessel_heading_degree' => '135', 'pml_last_updated_at' => $currentDateTime),
            array('pml_internal_vessel_id' => '1685', 'vessel_name' => 'TB GONAYA XXII', 'vessel_tx_id' => '510032', 'vessel_lat' => '-6.867798811083504', 'vessel_lon' => '110.37628806965394', 'vessel_vts_speed_knot' => '3', 'vessel_calc_speed_knot' => '3', 'vessel_heading_degree' => '135', 'pml_last_updated_at' => $currentDateTime),
            array('pml_internal_vessel_id' => '1481', 'vessel_name' => 'TB ISMAIL 01', 'vessel_tx_id' => '501492', 'vessel_lat' => '-6.867798811083504', 'vessel_lon' => '110.37628806965394', 'vessel_vts_speed_knot' => '3', 'vessel_calc_speed_knot' => '3', 'vessel_heading_degree' => '135', 'pml_last_updated_at' => $currentDateTime),
            array('pml_internal_vessel_id' => '1462', 'vessel_name' => 'TB KARYA ABADI 2', 'vessel_tx_id' => '502623', 'vessel_lat' => '-6.867798811083504', 'vessel_lon' => '110.37628806965394', 'vessel_vts_speed_knot' => '3', 'vessel_calc_speed_knot' => '3', 'vessel_heading_degree' => '135', 'pml_last_updated_at' => $currentDateTime),
            array('pml_internal_vessel_id' => '1465', 'vessel_name' => 'TB MARINO 178', 'vessel_tx_id' => '502548', 'vessel_lat' => '-6.867798811083504', 'vessel_lon' => '110.37628806965394', 'vessel_vts_speed_knot' => '3', 'vessel_calc_speed_knot' => '3', 'vessel_heading_degree' => '135', 'pml_last_updated_at' => $currentDateTime),
            array('pml_internal_vessel_id' => '1578', 'vessel_name' => 'TB MARINO 188', 'vessel_tx_id' => '501456', 'vessel_lat' => '-6.867798811083504', 'vessel_lon' => '110.37628806965394', 'vessel_vts_speed_knot' => '3', 'vessel_calc_speed_knot' => '3', 'vessel_heading_degree' => '135', 'pml_last_updated_at' => $currentDateTime),
            array('pml_internal_vessel_id' => '1643', 'vessel_name' => 'TB MARINO 189', 'vessel_tx_id' => '501502', 'vessel_lat' => '-6.867798811083504', 'vessel_lon' => '110.37628806965394', 'vessel_vts_speed_knot' => '3', 'vessel_calc_speed_knot' => '3', 'vessel_heading_degree' => '135', 'pml_last_updated_at' => $currentDateTime),
            array('pml_internal_vessel_id' => '1727', 'vessel_name' => 'TB MASADA 09', 'vessel_tx_id' => '501403', 'vessel_lat' => '-6.867798811083504', 'vessel_lon' => '110.37628806965394', 'vessel_vts_speed_knot' => '3', 'vessel_calc_speed_knot' => '3', 'vessel_heading_degree' => '135', 'pml_last_updated_at' => $currentDateTime),
            array('pml_internal_vessel_id' => '1644', 'vessel_name' => 'TB MEDELIN 1', 'vessel_tx_id' => '501444', 'vessel_lat' => '-6.867798811083504', 'vessel_lon' => '110.37628806965394', 'vessel_vts_speed_knot' => '3', 'vessel_calc_speed_knot' => '3', 'vessel_heading_degree' => '135', 'pml_last_updated_at' => $currentDateTime),
            array('pml_internal_vessel_id' => '1471', 'vessel_name' => 'TB MEDELIN OCEAN', 'vessel_tx_id' => '501496', 'vessel_lat' => '-6.867798811083504', 'vessel_lon' => '110.37628806965394', 'vessel_vts_speed_knot' => '3', 'vessel_calc_speed_knot' => '3', 'vessel_heading_degree' => '135', 'pml_last_updated_at' => $currentDateTime),
            array('pml_internal_vessel_id' => '1573', 'vessel_name' => 'TB MICHELLE 219-03', 'vessel_tx_id' => '510039', 'vessel_lat' => '-6.867798811083504', 'vessel_lon' => '110.37628806965394', 'vessel_vts_speed_knot' => '3', 'vessel_calc_speed_knot' => '3', 'vessel_heading_degree' => '135', 'pml_last_updated_at' => $currentDateTime),
            array('pml_internal_vessel_id' => '1464', 'vessel_name' => 'TB MITRA PASIFIK 2', 'vessel_tx_id' => '502549', 'vessel_lat' => '-6.867798811083504', 'vessel_lon' => '110.37628806965394', 'vessel_vts_speed_knot' => '3', 'vessel_calc_speed_knot' => '3', 'vessel_heading_degree' => '135', 'pml_last_updated_at' => $currentDateTime),
            array('pml_internal_vessel_id' => '1329', 'vessel_name' => 'TB PATRIA 1', 'vessel_tx_id' => '502550', 'vessel_lat' => '-6.867798811083504', 'vessel_lon' => '110.37628806965394', 'vessel_vts_speed_knot' => '3', 'vessel_calc_speed_knot' => '3', 'vessel_heading_degree' => '135', 'pml_last_updated_at' => $currentDateTime),
            array('pml_internal_vessel_id' => '1327', 'vessel_name' => 'TB PATRIA 10', 'vessel_tx_id' => '501433', 'vessel_lat' => '-6.867798811083504', 'vessel_lon' => '110.37628806965394', 'vessel_vts_speed_knot' => '3', 'vessel_calc_speed_knot' => '3', 'vessel_heading_degree' => '135', 'pml_last_updated_at' => $currentDateTime),
            array('pml_internal_vessel_id' => '623', 'vessel_name' => 'TB PATRIA 11', 'vessel_tx_id' => '501317', 'vessel_lat' => '-6.867798811083504', 'vessel_lon' => '110.37628806965394', 'vessel_vts_speed_knot' => '3', 'vessel_calc_speed_knot' => '3', 'vessel_heading_degree' => '135', 'pml_last_updated_at' => $currentDateTime),
            array('pml_internal_vessel_id' => '812', 'vessel_name' => 'TB PATRIA 15', 'vessel_tx_id' => '541434', 'vessel_lat' => '-6.867798811083504', 'vessel_lon' => '110.37628806965394', 'vessel_vts_speed_knot' => '3', 'vessel_calc_speed_knot' => '3', 'vessel_heading_degree' => '135', 'pml_last_updated_at' => $currentDateTime),
            array('pml_internal_vessel_id' => '634', 'vessel_name' => 'TB PATRIA 16', 'vessel_tx_id' => '501493', 'vessel_lat' => '-6.867798811083504', 'vessel_lon' => '110.37628806965394', 'vessel_vts_speed_knot' => '3', 'vessel_calc_speed_knot' => '3', 'vessel_heading_degree' => '135', 'pml_last_updated_at' => $currentDateTime),
            array('pml_internal_vessel_id' => '635', 'vessel_name' => 'TB PATRIA 17', 'vessel_tx_id' => '500135', 'vessel_lat' => '-6.867798811083504', 'vessel_lon' => '110.37628806965394', 'vessel_vts_speed_knot' => '3', 'vessel_calc_speed_knot' => '3', 'vessel_heading_degree' => '135', 'pml_last_updated_at' => $currentDateTime),
            array('pml_internal_vessel_id' => '753', 'vessel_name' => 'TB PATRIA 18', 'vessel_tx_id' => '508813', 'vessel_lat' => '-6.867798811083504', 'vessel_lon' => '110.37628806965394', 'vessel_vts_speed_knot' => '3', 'vessel_calc_speed_knot' => '3', 'vessel_heading_degree' => '135', 'pml_last_updated_at' => $currentDateTime),
            array('pml_internal_vessel_id' => '844', 'vessel_name' => 'TB PATRIA 19', 'vessel_tx_id' => '509092', 'vessel_lat' => '-6.867798811083504', 'vessel_lon' => '110.37628806965394', 'vessel_vts_speed_knot' => '3', 'vessel_calc_speed_knot' => '3', 'vessel_heading_degree' => '135', 'pml_last_updated_at' => $currentDateTime),
            array('pml_internal_vessel_id' => '754', 'vessel_name' => 'TB PATRIA 2', 'vessel_tx_id' => '501430', 'vessel_lat' => '-6.867798811083504', 'vessel_lon' => '110.37628806965394', 'vessel_vts_speed_knot' => '3', 'vessel_calc_speed_knot' => '3', 'vessel_heading_degree' => '135', 'pml_last_updated_at' => $currentDateTime),
            array('pml_internal_vessel_id' => '758', 'vessel_name' => 'TB PATRIA 20', 'vessel_tx_id' => '513108', 'vessel_lat' => '-6.867798811083504', 'vessel_lon' => '110.37628806965394', 'vessel_vts_speed_knot' => '3', 'vessel_calc_speed_knot' => '3', 'vessel_heading_degree' => '135', 'pml_last_updated_at' => $currentDateTime),
            array('pml_internal_vessel_id' => '1150', 'vessel_name' => 'TB PATRIA 22', 'vessel_tx_id' => '501313', 'vessel_lat' => '-6.867798811083504', 'vessel_lon' => '110.37628806965394', 'vessel_vts_speed_knot' => '3', 'vessel_calc_speed_knot' => '3', 'vessel_heading_degree' => '135', 'pml_last_updated_at' => $currentDateTime),
            array('pml_internal_vessel_id' => '1348', 'vessel_name' => 'TB PATRIA 23', 'vessel_tx_id' => '500991', 'vessel_lat' => '-6.867798811083504', 'vessel_lon' => '110.37628806965394', 'vessel_vts_speed_knot' => '3', 'vessel_calc_speed_knot' => '3', 'vessel_heading_degree' => '135', 'pml_last_updated_at' => $currentDateTime),
            array('pml_internal_vessel_id' => '1349', 'vessel_name' => 'TB PATRIA 24', 'vessel_tx_id' => '501320', 'vessel_lat' => '-6.867798811083504', 'vessel_lon' => '110.37628806965394', 'vessel_vts_speed_knot' => '3', 'vessel_calc_speed_knot' => '3', 'vessel_heading_degree' => '135', 'pml_last_updated_at' => $currentDateTime),
            array('pml_internal_vessel_id' => '1695', 'vessel_name' => 'TB PATRIA 25', 'vessel_tx_id' => '502562', 'vessel_lat' => '-6.867798811083504', 'vessel_lon' => '110.37628806965394', 'vessel_vts_speed_knot' => '3', 'vessel_calc_speed_knot' => '3', 'vessel_heading_degree' => '135', 'pml_last_updated_at' => $currentDateTime),
            array('pml_internal_vessel_id' => '1455', 'vessel_name' => 'TB PATRIA 26', 'vessel_tx_id' => '502612', 'vessel_lat' => '-6.867798811083504', 'vessel_lon' => '110.37628806965394', 'vessel_vts_speed_knot' => '3', 'vessel_calc_speed_knot' => '3', 'vessel_heading_degree' => '135', 'pml_last_updated_at' => $currentDateTime),
            array('pml_internal_vessel_id' => '1456', 'vessel_name' => 'TB PATRIA 27', 'vessel_tx_id' => '501386', 'vessel_lat' => '-6.867798811083504', 'vessel_lon' => '110.37628806965394', 'vessel_vts_speed_knot' => '3', 'vessel_calc_speed_knot' => '3', 'vessel_heading_degree' => '135', 'pml_last_updated_at' => $currentDateTime),
            array('pml_internal_vessel_id' => '1672', 'vessel_name' => 'TB PATRIA 29', 'vessel_tx_id' => '501504', 'vessel_lat' => '-6.867798811083504', 'vessel_lon' => '110.37628806965394', 'vessel_vts_speed_knot' => '3', 'vessel_calc_speed_knot' => '3', 'vessel_heading_degree' => '135', 'pml_last_updated_at' => $currentDateTime),
            array('pml_internal_vessel_id' => '1330', 'vessel_name' => 'TB PATRIA 3', 'vessel_tx_id' => '510045', 'vessel_lat' => '-6.867798811083504', 'vessel_lon' => '110.37628806965394', 'vessel_vts_speed_knot' => '3', 'vessel_calc_speed_knot' => '3', 'vessel_heading_degree' => '135', 'pml_last_updated_at' => $currentDateTime),
            array('pml_internal_vessel_id' => '1613', 'vessel_name' => 'TB PATRIA 30', 'vessel_tx_id' => '541225', 'vessel_lat' => '-6.867798811083504', 'vessel_lon' => '110.37628806965394', 'vessel_vts_speed_knot' => '3', 'vessel_calc_speed_knot' => '3', 'vessel_heading_degree' => '135', 'pml_last_updated_at' => $currentDateTime),
            array('pml_internal_vessel_id' => '1671', 'vessel_name' => 'TB PATRIA 31', 'vessel_tx_id' => '501498', 'vessel_lat' => '-6.867798811083504', 'vessel_lon' => '110.37628806965394', 'vessel_vts_speed_knot' => '3', 'vessel_calc_speed_knot' => '3', 'vessel_heading_degree' => '135', 'pml_last_updated_at' => $currentDateTime),
            array('pml_internal_vessel_id' => '1614', 'vessel_name' => 'TB PATRIA 32', 'vessel_tx_id' => '541229', 'vessel_lat' => '-6.867798811083504', 'vessel_lon' => '110.37628806965394', 'vessel_vts_speed_knot' => '3', 'vessel_calc_speed_knot' => '3', 'vessel_heading_degree' => '135', 'pml_last_updated_at' => $currentDateTime),
            array('pml_internal_vessel_id' => '1608', 'vessel_name' => 'TB PATRIA 34', 'vessel_tx_id' => '502558', 'vessel_lat' => '-6.867798811083504', 'vessel_lon' => '110.37628806965394', 'vessel_vts_speed_knot' => '3', 'vessel_calc_speed_knot' => '3', 'vessel_heading_degree' => '135', 'pml_last_updated_at' => $currentDateTime),
            array('pml_internal_vessel_id' => '1700', 'vessel_name' => 'TB PATRIA 35', 'vessel_tx_id' => '525521', 'vessel_lat' => '-6.867798811083504', 'vessel_lon' => '110.37628806965394', 'vessel_vts_speed_knot' => '3', 'vessel_calc_speed_knot' => '3', 'vessel_heading_degree' => '135', 'pml_last_updated_at' => $currentDateTime),
            array('pml_internal_vessel_id' => '1728', 'vessel_name' => 'TB PATRIA 36', 'vessel_tx_id' => '541420', 'vessel_lat' => '-6.867798811083504', 'vessel_lon' => '110.37628806965394', 'vessel_vts_speed_knot' => '3', 'vessel_calc_speed_knot' => '3', 'vessel_heading_degree' => '135', 'pml_last_updated_at' => $currentDateTime),
            array('pml_internal_vessel_id' => '1690', 'vessel_name' => 'TB PATRIA 37', 'vessel_tx_id' => '502572', 'vessel_lat' => '-6.867798811083504', 'vessel_lon' => '110.37628806965394', 'vessel_vts_speed_knot' => '3', 'vessel_calc_speed_knot' => '3', 'vessel_heading_degree' => '135', 'pml_last_updated_at' => $currentDateTime),
            array('pml_internal_vessel_id' => '1294', 'vessel_name' => 'TB PATRIA 4', 'vessel_tx_id' => '543430', 'vessel_lat' => '-6.867798811083504', 'vessel_lon' => '110.37628806965394', 'vessel_vts_speed_knot' => '3', 'vessel_calc_speed_knot' => '3', 'vessel_heading_degree' => '135', 'pml_last_updated_at' => $currentDateTime),
            array('pml_internal_vessel_id' => '1292', 'vessel_name' => 'TB PATRIA 6', 'vessel_tx_id' => '501334', 'vessel_lat' => '-6.867798811083504', 'vessel_lon' => '110.37628806965394', 'vessel_vts_speed_knot' => '3', 'vessel_calc_speed_knot' => '3', 'vessel_heading_degree' => '135', 'pml_last_updated_at' => $currentDateTime),
            array('pml_internal_vessel_id' => '1340', 'vessel_name' => 'TB PATRIA 7', 'vessel_tx_id' => '501316', 'vessel_lat' => '-6.867798811083504', 'vessel_lon' => '110.37628806965394', 'vessel_vts_speed_knot' => '3', 'vessel_calc_speed_knot' => '3', 'vessel_heading_degree' => '135', 'pml_last_updated_at' => $currentDateTime),
            array('pml_internal_vessel_id' => '755', 'vessel_name' => 'TB PATRIA 8', 'vessel_tx_id' => '502557', 'vessel_lat' => '-6.867798811083504', 'vessel_lon' => '110.37628806965394', 'vessel_vts_speed_knot' => '3', 'vessel_calc_speed_knot' => '3', 'vessel_heading_degree' => '135', 'pml_last_updated_at' => $currentDateTime),
            array('pml_internal_vessel_id' => '1239', 'vessel_name' => 'TB PATRIA 9', 'vessel_tx_id' => '501321', 'vessel_lat' => '-6.867798811083504', 'vessel_lon' => '110.37628806965394', 'vessel_vts_speed_knot' => '3', 'vessel_calc_speed_knot' => '3', 'vessel_heading_degree' => '135', 'pml_last_updated_at' => $currentDateTime),
            array('pml_internal_vessel_id' => '1234', 'vessel_name' => 'TB PATRIA ANDROMEDA 1', 'vessel_tx_id' => '501441', 'vessel_lat' => '-6.867798811083504', 'vessel_lon' => '110.37628806965394', 'vessel_vts_speed_knot' => '3', 'vessel_calc_speed_knot' => '3', 'vessel_heading_degree' => '135', 'pml_last_updated_at' => $currentDateTime),
            array('pml_internal_vessel_id' => '1482', 'vessel_name' => 'TB PM 1', 'vessel_tx_id' => '501461', 'vessel_lat' => '-6.867798811083504', 'vessel_lon' => '110.37628806965394', 'vessel_vts_speed_knot' => '3', 'vessel_calc_speed_knot' => '3', 'vessel_heading_degree' => '135', 'pml_last_updated_at' => $currentDateTime),
            array('pml_internal_vessel_id' => '1458', 'vessel_name' => 'TB PM 202', 'vessel_tx_id' => '510029', 'vessel_lat' => '-6.867798811083504', 'vessel_lon' => '110.37628806965394', 'vessel_vts_speed_knot' => '3', 'vessel_calc_speed_knot' => '3', 'vessel_heading_degree' => '135', 'pml_last_updated_at' => $currentDateTime),
            array('pml_internal_vessel_id' => '1641', 'vessel_name' => 'TB PRIMA POWER 01', 'vessel_tx_id' => '501501', 'vessel_lat' => '-6.867798811083504', 'vessel_lon' => '110.37628806965394', 'vessel_vts_speed_knot' => '3', 'vessel_calc_speed_knot' => '3', 'vessel_heading_degree' => '135', 'pml_last_updated_at' => $currentDateTime),
            array('pml_internal_vessel_id' => '1686', 'vessel_name' => 'TB PRIMA POWER 05', 'vessel_tx_id' => '501373', 'vessel_lat' => '-6.867798811083504', 'vessel_lon' => '110.37628806965394', 'vessel_vts_speed_knot' => '3', 'vessel_calc_speed_knot' => '3', 'vessel_heading_degree' => '135', 'pml_last_updated_at' => $currentDateTime),
            array('pml_internal_vessel_id' => '1460', 'vessel_name' => 'TB SINDO PERKASA V', 'vessel_tx_id' => '502616', 'vessel_lat' => '-6.867798811083504', 'vessel_lon' => '110.37628806965394', 'vessel_vts_speed_knot' => '3', 'vessel_calc_speed_knot' => '3', 'vessel_heading_degree' => '135', 'pml_last_updated_at' => $currentDateTime),
            array('pml_internal_vessel_id' => '1459', 'vessel_name' => 'TB SURYA ABADI 38', 'vessel_tx_id' => '502561', 'vessel_lat' => '-6.867798811083504', 'vessel_lon' => '110.37628806965394', 'vessel_vts_speed_knot' => '3', 'vessel_calc_speed_knot' => '3', 'vessel_heading_degree' => '135', 'pml_last_updated_at' => $currentDateTime),
            array('pml_internal_vessel_id' => '1469', 'vessel_name' => 'TB TRANS PACIFIC 211', 'vessel_tx_id' => '501460', 'vessel_lat' => '-6.867798811083504', 'vessel_lon' => '110.37628806965394', 'vessel_vts_speed_knot' => '3', 'vessel_calc_speed_knot' => '3', 'vessel_heading_degree' => '135', 'pml_last_updated_at' => $currentDateTime),
            array('pml_internal_vessel_id' => '1694', 'vessel_name' => 'TB VINCENT 1', 'vessel_tx_id' => '502609', 'vessel_lat' => '-6.867798811083504', 'vessel_lon' => '110.37628806965394', 'vessel_vts_speed_knot' => '3', 'vessel_calc_speed_knot' => '3', 'vessel_heading_degree' => '135', 'pml_last_updated_at' => $currentDateTime),
            array('pml_internal_vessel_id' => '1370', 'vessel_name' => 'TB. MASADA 27', 'vessel_tx_id' => '--', 'vessel_lat' => '-6.867798811083504', 'vessel_lon' => '110.37628806965394', 'vessel_vts_speed_knot' => '3', 'vessel_calc_speed_knot' => '3', 'vessel_heading_degree' => '135', 'pml_last_updated_at' => $currentDateTime),
            array('pml_internal_vessel_id' => '1624', 'vessel_name' => 'TK 3214', 'vessel_tx_id' => '706521', 'vessel_lat' => '-6.867798811083504', 'vessel_lon' => '110.37628806965394', 'vessel_vts_speed_knot' => '3', 'vessel_calc_speed_knot' => '3', 'vessel_heading_degree' => '135', 'pml_last_updated_at' => $currentDateTime),
            array('pml_internal_vessel_id' => '1625', 'vessel_name' => 'TK 3216', 'vessel_tx_id' => '706641', 'vessel_lat' => '-6.867798811083504', 'vessel_lon' => '110.37628806965394', 'vessel_vts_speed_knot' => '3', 'vessel_calc_speed_knot' => '3', 'vessel_heading_degree' => '135', 'pml_last_updated_at' => $currentDateTime),
            array('pml_internal_vessel_id' => '1499', 'vessel_name' => 'TK ACHERNAR', 'vessel_tx_id' => '704688', 'vessel_lat' => '-6.867798811083504', 'vessel_lon' => '110.37628806965394', 'vessel_vts_speed_knot' => '3', 'vessel_calc_speed_knot' => '3', 'vessel_heading_degree' => '135', 'pml_last_updated_at' => $currentDateTime),
            array('pml_internal_vessel_id' => '1506', 'vessel_name' => 'TK ALKAID', 'vessel_tx_id' => '705736', 'vessel_lat' => '-6.867798811083504', 'vessel_lon' => '110.37628806965394', 'vessel_vts_speed_knot' => '3', 'vessel_calc_speed_knot' => '3', 'vessel_heading_degree' => '135', 'pml_last_updated_at' => $currentDateTime),
            array('pml_internal_vessel_id' => '1565', 'vessel_name' => 'TK ALNAIR', 'vessel_tx_id' => '705815', 'vessel_lat' => '-6.867798811083504', 'vessel_lon' => '110.37628806965394', 'vessel_vts_speed_knot' => '3', 'vessel_calc_speed_knot' => '3', 'vessel_heading_degree' => '135', 'pml_last_updated_at' => $currentDateTime),
            array('pml_internal_vessel_id' => '1514', 'vessel_name' => 'TK ANAND 15', 'vessel_tx_id' => '705809', 'vessel_lat' => '-6.867798811083504', 'vessel_lon' => '110.37628806965394', 'vessel_vts_speed_knot' => '3', 'vessel_calc_speed_knot' => '3', 'vessel_heading_degree' => '135', 'pml_last_updated_at' => $currentDateTime),
            array('pml_internal_vessel_id' => '1515', 'vessel_name' => 'TK AURA', 'vessel_tx_id' => '705825', 'vessel_lat' => '-6.867798811083504', 'vessel_lon' => '110.37628806965394', 'vessel_vts_speed_knot' => '3', 'vessel_calc_speed_knot' => '3', 'vessel_heading_degree' => '135', 'pml_last_updated_at' => $currentDateTime),
            array('pml_internal_vessel_id' => '1500', 'vessel_name' => 'TK PATRIA 3210', 'vessel_tx_id' => '704689', 'vessel_lat' => '-6.867798811083504', 'vessel_lon' => '110.37628806965394', 'vessel_vts_speed_knot' => '3', 'vessel_calc_speed_knot' => '3', 'vessel_heading_degree' => '135', 'pml_last_updated_at' => $currentDateTime),

        );

        // Create the vessels in the database
        foreach ($vessels as $vessel) {
            Vessel::updateOrCreate(
                ['pml_internal_vessel_id' => $vessel['pml_internal_vessel_id']],
                $vessel
            );
        }


        // Initialize a new Guzzle client
        $client = new Client();

        // Get the API username and password from .env, if not exist, use empty string as default so the request will fail
        $username = env('PML_API_USERNAME', '');
        $password = env('PML_API_PASSWORD', '');

        $url = 'https://www.vms.web.id/vmap/api/get.php?user=' . $username . '&pass=' . $password . '&type=1&d=2&vessel=0';

        // Params

        // This is from PT PML IT Support, I dont know what this is
        $queryParams = [
            "user" => $username,
            "pass" => $password,
            "type" => "2", // I dont know what this is
            "d" => "2", // I dont know what this is
            "d1" => "2024-05-01", // start date
            "d2" => "2024-05-01", // end date
            "vessel" => "0" // I dont know what this is
        ];

        // Do the request
        $response = $client->request('GET', $url, [
            'verify' => false,
            // 'query' => $queryParams,
        ]);

        // Alternate way to do the request, not really working.
        // $response = $client->request('GET', $url, ['verify' => base_path('cacert.pem')]);

        // Get the content of the response
        $content = $response->getBody()->getContents();

        // Decode the content to an array
        $contentArray = json_decode($content, true);



        // Floor to the nearest hour
        $floorDateTime = $currentDateTime->minute(0)->second(0);



        // Define the start and end of the date range
        $startDate = $floorDateTime->copy()->subHour(1);
        $endDate = $floorDateTime->copy()->subSecond(1);

        // Initialize an array to keep track of the latest entries
        $latestEntries = [];

        foreach ($contentArray['data'] as $entry) {
            $entryDate = DateTime::createFromFormat('Y-m-d H:i:s', $entry['date']);
            $txid = $entry['txid'];

            // Check if the entry date is within the specified range
            if ($entryDate >= $startDate && $entryDate <= $endDate) {

                // If the txid is not in the latestEntries array or the entry is more recent, update the latestEntries array
                if (!isset($latestEntries[$txid]) || $entryDate > DateTime::createFromFormat('Y-m-d H:i:s', $latestEntries[$txid]['date'])) {

                    // Add the entry to the latestEntries array
                    $latestEntries[] = $entry;
                }
            }
        }

        // Insert the latest entries into the database using the Vessel model
        foreach ($latestEntries as $entry) {

            // // Find the vessel by internal ID
            // $vessel = Vessel::where('pml_internal_vessel_id', $entry['vessel_id'])->first();

            // if ($vessel) {
            //     // Reset specific fields to null
            //     $vessel->update([
            //         'vessel_lat' => "-6.867798811083504",
            //         'vessel_lon' => "110.37628806965394",
            //         'vessel_vts_speed_knot' => "3",
            //         'vessel_calc_speed_knot' => "3",
            //         'vessel_heading_degree' => "135",
            //         'pml_last_updated_at' => $floorDateTime,
            //     ]);
            // }

            // Update the vessel if there is a match in txid or create the vessel data if there is no match
            Vessel::updateOrCreate(
                ['pml_internal_vessel_id' => $entry['vessel_id']],
                [
                    'vessel_tx_id' => $entry['txid'],
                    'vessel_name' => $entry['name'],
                    'vessel_lat' => $entry['lat'],
                    'vessel_lon' => $entry['lon'],
                    'vessel_vts_speed_knot' => $entry['speed'],
                    'vessel_calc_speed_knot' => $entry['calcspeed'],
                    'vessel_heading_degree' => $entry['heading'],
                    'pml_last_updated_at' => $entry['date'],
                ]
            );
        }
    }
}
