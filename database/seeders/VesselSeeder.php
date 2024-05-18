<?php

namespace Database\Seeders;

use App\Models\Vessel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VesselSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        static $vessels = array(
            array('name'=>'MV PATRIA NAWASENA 1', 'vessel_type'=>'MV', 'vessel_tx_id'=>'518883', 'vessel_heading_degree'=>'91','vessel_vts_speed_knot'=>'11.4','vessel_lat'=>'-5.7403','vessel_lon'=>'122.255','last_updated'=>'2024-05-18 09:24:55'),
            array('name'=>'SAMASTA NINGRUM', 'vessel_type'=>'TB', 'vessel_tx_id'=>'706688', 'vessel_heading_degree'=>'145','vessel_vts_speed_knot'=>'0','vessel_lat'=>'-6.163749999999993','vessel_lon'=>'106.89875','last_updated'=>'2023-11-02 15:16:41'),
            array('name'=>'TB BENGKALIS 1', 'vessel_type'=>'TB', 'vessel_tx_id'=>'501442', 'vessel_heading_degree'=>'342','vessel_vts_speed_knot'=>'0','vessel_lat'=>'-3.3174','vessel_lon'=>'114.5626','last_updated'=>'2024-05-18 09:00:10'),
            array('name'=>'TB BRAHMA 1', 'vessel_type'=>'TB', 'vessel_tx_id'=>'501327', 'vessel_heading_degree'=>'10','vessel_vts_speed_knot'=>'0','vessel_lat'=>'-2.3548','vessel_lon'=>'114.8957','last_updated'=>'2024-05-18 09:00:00'),
            array('name'=>'TB BRAHMA 10', 'vessel_type'=>'TB', 'vessel_tx_id'=>'501319', 'vessel_heading_degree'=>'297','vessel_vts_speed_knot'=>'0','vessel_lat'=>'-3.7123','vessel_lon'=>'114.4261','last_updated'=>'2024-05-18 09:00:00'),
            array('name'=>'TB BRAHMA 11', 'vessel_type'=>'TB', 'vessel_tx_id'=>'541433', 'vessel_heading_degree'=>'0','vessel_vts_speed_knot'=>'0','vessel_lat'=>'-2.3756','vessel_lon'=>'114.9074','last_updated'=>'2024-05-18 09:09:55'),
            array('name'=>'TB BRAHMA 12', 'vessel_type'=>'TB', 'vessel_tx_id'=>'501449', 'vessel_heading_degree'=>'176','vessel_vts_speed_knot'=>'1','vessel_lat'=>'-3.6202','vessel_lon'=>'114.481','last_updated'=>'2024-05-18 09:00:00'),
            array('name'=>'TB BRAHMA 15', 'vessel_type'=>'TB', 'vessel_tx_id'=>'501318', 'vessel_heading_degree'=>'351','vessel_vts_speed_knot'=>'0','vessel_lat'=>'0.4561','vessel_lon'=>'128.1668','last_updated'=>'2024-05-18 09:00:00'),
            array('name'=>'TB BRAHMA 2', 'vessel_type'=>'TB', 'vessel_tx_id'=>'501345', 'vessel_heading_degree'=>'57','vessel_vts_speed_knot'=>'1','vessel_lat'=>'-6.2602','vessel_lon'=>'112.4575','last_updated'=>'2024-05-18 09:00:00'),
            array('name'=>'TB BRAHMA 3', 'vessel_type'=>'TB', 'vessel_tx_id'=>'502608', 'vessel_heading_degree'=>'275','vessel_vts_speed_knot'=>'0','vessel_lat'=>'-3.3176','vessel_lon'=>'114.5624','last_updated'=>'2024-05-18 09:00:00'),
            array('name'=>'TB BRAHMA 5', 'vessel_type'=>'TB', 'vessel_tx_id'=>'501328', 'vessel_heading_degree'=>'358','vessel_vts_speed_knot'=>'3','vessel_lat'=>'-3.9279','vessel_lon'=>'106.1532','last_updated'=>'2024-05-18 09:00:00'),
            array('name'=>'TB BRAHMA 6', 'vessel_type'=>'TB', 'vessel_tx_id'=>'501336', 'vessel_heading_degree'=>'268','vessel_vts_speed_knot'=>'3','vessel_lat'=>'-5.7961','vessel_lon'=>'107.5784','last_updated'=>'2024-05-18 09:00:00'),
            array('name'=>'TB BRAHMA 7', 'vessel_type'=>'TB', 'vessel_tx_id'=>'541435', 'vessel_heading_degree'=>'349','vessel_vts_speed_knot'=>'0.1','vessel_lat'=>'-3.3176','vessel_lon'=>'114.5624','last_updated'=>'2024-05-18 09:10:01'),
            array('name'=>'TB BRAHMA 8', 'vessel_type'=>'TB', 'vessel_tx_id'=>'501360', 'vessel_heading_degree'=>'343','vessel_vts_speed_knot'=>'3','vessel_lat'=>'-0.8262','vessel_lon'=>'117.3019','last_updated'=>'2024-05-18 09:00:00'),
            array('name'=>'TB BRAHMA 9', 'vessel_type'=>'TB', 'vessel_tx_id'=>'501335', 'vessel_heading_degree'=>'218','vessel_vts_speed_knot'=>'2.5','vessel_lat'=>'-5.5952','vessel_lon'=>'112.5397','last_updated'=>'2024-05-18 09:00:00'),
            array('name'=>'TB BSP 01', 'vessel_type'=>'TB', 'vessel_tx_id'=>'501508', 'vessel_heading_degree'=>'291','vessel_vts_speed_knot'=>'0','vessel_lat'=>'-1.2323','vessel_lon'=>'114.8037','last_updated'=>'2024-05-18 09:00:30'),
            array('name'=>'TB EKA MARIS', 'vessel_type'=>'TB', 'vessel_tx_id'=>'501424', 'vessel_heading_degree'=>'260','vessel_vts_speed_knot'=>'0','vessel_lat'=>'-3.3158','vessel_lon'=>'114.5631','last_updated'=>'2024-05-18 09:00:00'),
            array('name'=>'TB EKA MARIS 10', 'vessel_type'=>'TB', 'vessel_tx_id'=>'502621', 'vessel_heading_degree'=>'49','vessel_vts_speed_knot'=>'0','vessel_lat'=>'-5.9476','vessel_lon'=>'106.1064','last_updated'=>'2024-04-01 12:10:10'),
            array('name'=>'TB EKA MARIS 8', 'vessel_type'=>'TB', 'vessel_tx_id'=>'501339', 'vessel_heading_degree'=>'15','vessel_vts_speed_knot'=>'4.5','vessel_lat'=>'-3.3869','vessel_lon'=>'114.503','last_updated'=>'2024-05-18 09:00:00'),
            array('name'=>'TB EKA MARIS 9', 'vessel_type'=>'TB', 'vessel_tx_id'=>'501423', 'vessel_heading_degree'=>'58','vessel_vts_speed_knot'=>'2.5','vessel_lat'=>'-3.0813','vessel_lon'=>'114.6419','last_updated'=>'2024-05-18 09:00:00'),
            array('name'=>'TB FERY XXI', 'vessel_type'=>'TB', 'vessel_tx_id'=>'502620', 'vessel_heading_degree'=>'73','vessel_vts_speed_knot'=>'0','vessel_lat'=>'-3.2613','vessel_lon'=>'114.5513','last_updated'=>'2024-05-18 05:00:00'),
            array('name'=>'TB FERY XXIV', 'vessel_type'=>'TB', 'vessel_tx_id'=>'501451', 'vessel_heading_degree'=>'315','vessel_vts_speed_knot'=>'3','vessel_lat'=>'-1.2839','vessel_lon'=>'114.7685','last_updated'=>'2024-05-18 09:00:00'),
            array('name'=>'TB FERY XXVI', 'vessel_type'=>'TB', 'vessel_tx_id'=>'502564', 'vessel_heading_degree'=>'194','vessel_vts_speed_knot'=>'0','vessel_lat'=>'-3.3928','vessel_lon'=>'114.4977','last_updated'=>'2024-05-18 09:00:00'),
            array('name'=>'TB GONAYA', 'vessel_type'=>'TB', 'vessel_tx_id'=>'501331', 'vessel_heading_degree'=>'187','vessel_vts_speed_knot'=>'0','vessel_lat'=>'-3.2279','vessel_lon'=>'114.55','last_updated'=>'2024-05-18 09:00:00'),
            array('name'=>'TB GONAYA X', 'vessel_type'=>'TB', 'vessel_tx_id'=>'510028', 'vessel_heading_degree'=>'197','vessel_vts_speed_knot'=>'0','vessel_lat'=>'-3.316','vessel_lon'=>'114.5631','last_updated'=>'2024-05-18 09:00:10'),
            array('name'=>'TB GONAYA XXII', 'vessel_type'=>'TB', 'vessel_tx_id'=>'510032', 'vessel_heading_degree'=>'241','vessel_vts_speed_knot'=>'0','vessel_lat'=>'-5.5346','vessel_lon'=>'105.3343','last_updated'=>'2024-05-18 09:00:00'),
            array('name'=>'TB ISMAIL 01', 'vessel_type'=>'TB', 'vessel_tx_id'=>'501492', 'vessel_heading_degree'=>'223','vessel_vts_speed_knot'=>'0','vessel_lat'=>'-6.8633','vessel_lon'=>'109.2128','last_updated'=>'2024-05-18 09:00:00'),
            array('name'=>'TB KARYA ABADI 2', 'vessel_type'=>'TB', 'vessel_tx_id'=>'502623', 'vessel_heading_degree'=>'32','vessel_vts_speed_knot'=>'4','vessel_lat'=>'-1.2617','vessel_lon'=>'114.8247','last_updated'=>'2023-02-17 07:00:00'),
            array('name'=>'TB MARINO 178', 'vessel_type'=>'TB', 'vessel_tx_id'=>'502548', 'vessel_heading_degree'=>'68','vessel_vts_speed_knot'=>'0','vessel_lat'=>'-5.9124','vessel_lon'=>'106.1025','last_updated'=>'2024-05-18 09:00:00'),
            array('name'=>'TB MARINO 188', 'vessel_type'=>'TB', 'vessel_tx_id'=>'501456', 'vessel_heading_degree'=>'226','vessel_vts_speed_knot'=>'0','vessel_lat'=>'-3.3161','vessel_lon'=>'114.5632','last_updated'=>'2024-05-18 09:00:00'),
            array('name'=>'TB MARINO 189', 'vessel_type'=>'TB', 'vessel_tx_id'=>'501502', 'vessel_heading_degree'=>'33','vessel_vts_speed_knot'=>'0','vessel_lat'=>'-2.1058','vessel_lon'=>'114.8586','last_updated'=>'2024-05-18 09:00:00'),
            array('name'=>'TB MASADA 09', 'vessel_type'=>'TB', 'vessel_tx_id'=>'501403', 'vessel_heading_degree'=>'153','vessel_vts_speed_knot'=>'2.5','vessel_lat'=>'-3.4365','vessel_lon'=>'114.5022','last_updated'=>'2024-05-18 09:00:00'),
            array('name'=>'TB MEDELIN 1', 'vessel_type'=>'TB', 'vessel_tx_id'=>'501444', 'vessel_heading_degree'=>'84','vessel_vts_speed_knot'=>'0','vessel_lat'=>'3.7815','vessel_lon'=>'98.7006','last_updated'=>'2024-03-22 09:34:10'),
            array('name'=>'TB MEDELIN OCEAN', 'vessel_type'=>'TB', 'vessel_tx_id'=>'501496', 'vessel_heading_degree'=>'237','vessel_vts_speed_knot'=>'3.5','vessel_lat'=>'-4.4112','vessel_lon'=>'114.9285','last_updated'=>'2024-05-18 09:00:20'),
            array('name'=>'TB MICHELLE 219-03', 'vessel_type'=>'TB', 'vessel_tx_id'=>'510039', 'vessel_heading_degree'=>'223','vessel_vts_speed_knot'=>'0','vessel_lat'=>'-3.2285','vessel_lon'=>'114.5503','last_updated'=>'2024-05-18 09:00:10'),
            array('name'=>'TB MITRA PASIFIK 2', 'vessel_type'=>'TB', 'vessel_tx_id'=>'502549', 'vessel_heading_degree'=>'208','vessel_vts_speed_knot'=>'0','vessel_lat'=>'-1.2176','vessel_lon'=>'114.8073','last_updated'=>'2024-05-18 09:00:00'),
            array('name'=>'TB PATRIA 1', 'vessel_type'=>'TB', 'vessel_tx_id'=>'502550', 'vessel_heading_degree'=>'119','vessel_vts_speed_knot'=>'0','vessel_lat'=>'-6.8601','vessel_lon'=>'109.8372','last_updated'=>'2024-05-18 09:00:00'),
            array('name'=>'TB PATRIA 10', 'vessel_type'=>'TB', 'vessel_tx_id'=>'501433', 'vessel_heading_degree'=>'18','vessel_vts_speed_knot'=>'2.5','vessel_lat'=>'-6.6462','vessel_lon'=>'113.0381','last_updated'=>'2024-05-18 09:00:00'),
            array('name'=>'TB PATRIA 11', 'vessel_type'=>'TB', 'vessel_tx_id'=>'501317', 'vessel_heading_degree'=>'18','vessel_vts_speed_knot'=>'0','vessel_lat'=>'-3.3106','vessel_lon'=>'122.2895','last_updated'=>'2024-05-18 09:00:00'),
            array('name'=>'TB PATRIA 15', 'vessel_type'=>'TB', 'vessel_tx_id'=>'541434', 'vessel_heading_degree'=>'205','vessel_vts_speed_knot'=>'0.6','vessel_lat'=>'-3.6872','vessel_lon'=>'114.5181','last_updated'=>'2024-05-18 09:10:01'),
            array('name'=>'TB PATRIA 16', 'vessel_type'=>'TB', 'vessel_tx_id'=>'501493', 'vessel_heading_degree'=>'218','vessel_vts_speed_knot'=>'3','vessel_lat'=>'-7.0669','vessel_lon'=>'114.2042','last_updated'=>'2024-05-18 09:00:00'),
            array('name'=>'TB PATRIA 17', 'vessel_type'=>'TB', 'vessel_tx_id'=>'500135', 'vessel_heading_degree'=>'195','vessel_vts_speed_knot'=>'0','vessel_lat'=>'-2.9305','vessel_lon'=>'114.8872','last_updated'=>'2024-05-18 09:00:00'),
            array('name'=>'TB PATRIA 18', 'vessel_type'=>'TB', 'vessel_tx_id'=>'508813', 'vessel_heading_degree'=>'0','vessel_vts_speed_knot'=>'0','vessel_lat'=>'-2.9397','vessel_lon'=>'114.8614','last_updated'=>'2024-05-18 09:02:07'),
            array('name'=>'TB PATRIA 19', 'vessel_type'=>'TB', 'vessel_tx_id'=>'509092', 'vessel_heading_degree'=>'0','vessel_vts_speed_knot'=>'0','vessel_lat'=>'-2.9254','vessel_lon'=>'114.8712','last_updated'=>'2024-05-18 09:26:50'),
            array('name'=>'TB PATRIA 2', 'vessel_type'=>'TB', 'vessel_tx_id'=>'501430', 'vessel_heading_degree'=>'307','vessel_vts_speed_knot'=>'1.5','vessel_lat'=>'0.4465','vessel_lon'=>'127.9651','last_updated'=>'2024-05-18 09:00:00'),
            array('name'=>'TB PATRIA 20', 'vessel_type'=>'TB', 'vessel_tx_id'=>'513108', 'vessel_heading_degree'=>'80','vessel_vts_speed_knot'=>'2.5','vessel_lat'=>'-3.0645','vessel_lon'=>'122.8144','last_updated'=>'2024-05-18 08:01:58'),
            array('name'=>'TB PATRIA 22', 'vessel_type'=>'TB', 'vessel_tx_id'=>'501313', 'vessel_heading_degree'=>'268','vessel_vts_speed_knot'=>'5','vessel_lat'=>'-1.3398','vessel_lon'=>'114.8742','last_updated'=>'2024-05-18 09:00:00'),
            array('name'=>'TB PATRIA 23', 'vessel_type'=>'TB', 'vessel_tx_id'=>'500991', 'vessel_heading_degree'=>'303','vessel_vts_speed_knot'=>'0','vessel_lat'=>'0.4701','vessel_lon'=>'127.9614','last_updated'=>'2024-05-18 09:00:00'),
            array('name'=>'TB PATRIA 24', 'vessel_type'=>'TB', 'vessel_tx_id'=>'501320', 'vessel_heading_degree'=>'189','vessel_vts_speed_knot'=>'0','vessel_lat'=>'-2.942','vessel_lon'=>'114.8604','last_updated'=>'2024-05-18 09:00:00'),
            array('name'=>'TB PATRIA 25', 'vessel_type'=>'TB', 'vessel_tx_id'=>'502562', 'vessel_heading_degree'=>'262','vessel_vts_speed_knot'=>'0','vessel_lat'=>'-3.395','vessel_lon'=>'114.4968','last_updated'=>'2024-05-18 09:00:00'),
            array('name'=>'TB PATRIA 26', 'vessel_type'=>'TB', 'vessel_tx_id'=>'502612', 'vessel_heading_degree'=>'224','vessel_vts_speed_knot'=>'2.5','vessel_lat'=>'-5.6393','vessel_lon'=>'111.6043','last_updated'=>'2024-05-18 09:00:15'),
            array('name'=>'TB PATRIA 27', 'vessel_type'=>'TB', 'vessel_tx_id'=>'501386', 'vessel_heading_degree'=>'197','vessel_vts_speed_knot'=>'0','vessel_lat'=>'-0.4428','vessel_lon'=>'129.9041','last_updated'=>'2024-05-18 09:00:00'),
            array('name'=>'TB PATRIA 29', 'vessel_type'=>'TB', 'vessel_tx_id'=>'501504', 'vessel_heading_degree'=>'59','vessel_vts_speed_knot'=>'1','vessel_lat'=>'-4.976','vessel_lon'=>'112.631','last_updated'=>'2024-05-18 09:00:00'),
            array('name'=>'TB PATRIA 3', 'vessel_type'=>'TB', 'vessel_tx_id'=>'510045', 'vessel_heading_degree'=>'187','vessel_vts_speed_knot'=>'0','vessel_lat'=>'-3.3155','vessel_lon'=>'114.5634','last_updated'=>'2024-05-18 09:00:00'),
            array('name'=>'TB PATRIA 30', 'vessel_type'=>'TB', 'vessel_tx_id'=>'541225', 'vessel_heading_degree'=>'209','vessel_vts_speed_knot'=>'1.2','vessel_lat'=>'-3.7684','vessel_lon'=>'115.6426','last_updated'=>'2024-05-18 09:07:01'),
            array('name'=>'TB PATRIA 31', 'vessel_type'=>'TB', 'vessel_tx_id'=>'501498', 'vessel_heading_degree'=>'59','vessel_vts_speed_knot'=>'4','vessel_lat'=>'-6.6744','vessel_lon'=>'110.1783','last_updated'=>'2024-05-18 09:00:00'),
            array('name'=>'TB PATRIA 32', 'vessel_type'=>'TB', 'vessel_tx_id'=>'541229', 'vessel_heading_degree'=>'273','vessel_vts_speed_knot'=>'4.2','vessel_lat'=>'-2.924','vessel_lon'=>'114.8681','last_updated'=>'2024-05-18 09:08:43'),
            array('name'=>'TB PATRIA 34', 'vessel_type'=>'TB', 'vessel_tx_id'=>'502558', 'vessel_heading_degree'=>'175','vessel_vts_speed_knot'=>'0','vessel_lat'=>'-3.3174','vessel_lon'=>'114.5625','last_updated'=>'2024-05-18 09:00:00'),
            array('name'=>'TB PATRIA 35', 'vessel_type'=>'TB', 'vessel_tx_id'=>'525521', 'vessel_heading_degree'=>'54','vessel_vts_speed_knot'=>'4','vessel_lat'=>'-3.6656','vessel_lon'=>'114.4571','last_updated'=>'2024-05-18 09:06:01'),
            array('name'=>'TB PATRIA 36', 'vessel_type'=>'TB', 'vessel_tx_id'=>'541420', 'vessel_heading_degree'=>'185','vessel_vts_speed_knot'=>'2.9','vessel_lat'=>'-3.4737','vessel_lon'=>'106.2008','last_updated'=>'2024-05-18 09:06:03'),
            array('name'=>'TB PATRIA 37', 'vessel_type'=>'TB', 'vessel_tx_id'=>'502572', 'vessel_heading_degree'=>'166','vessel_vts_speed_knot'=>'0','vessel_lat'=>'-2.8969','vessel_lon'=>'122.2101','last_updated'=>'2024-05-18 09:00:00'),
            array('name'=>'TB PATRIA 4', 'vessel_type'=>'TB', 'vessel_tx_id'=>'501325', 'vessel_heading_degree'=>'308','vessel_vts_speed_knot'=>'0','vessel_lat'=>'-3.3884','vessel_lon'=>'114.4973','last_updated'=>'2024-05-18 09:00:00'),
            array('name'=>'TB PATRIA 6', 'vessel_type'=>'TB', 'vessel_tx_id'=>'501334', 'vessel_heading_degree'=>'236','vessel_vts_speed_knot'=>'0','vessel_lat'=>'-3.3176','vessel_lon'=>'114.5623','last_updated'=>'2024-05-18 09:00:00'),
            array('name'=>'TB PATRIA 7', 'vessel_type'=>'TB', 'vessel_tx_id'=>'501316', 'vessel_heading_degree'=>'169','vessel_vts_speed_knot'=>'0','vessel_lat'=>'-1.2343','vessel_lon'=>'114.8056','last_updated'=>'2024-05-16 18:29:00'),
            array('name'=>'TB PATRIA 8', 'vessel_type'=>'TB', 'vessel_tx_id'=>'502557', 'vessel_heading_degree'=>'101','vessel_vts_speed_knot'=>'0','vessel_lat'=>'-3.662','vessel_lon'=>'114.4468','last_updated'=>'2024-05-18 09:00:00'),
            array('name'=>'TB PATRIA 9', 'vessel_type'=>'TB', 'vessel_tx_id'=>'501321', 'vessel_heading_degree'=>'289','vessel_vts_speed_knot'=>'0','vessel_lat'=>'-3.3161','vessel_lon'=>'114.5631','last_updated'=>'2024-05-18 09:00:00'),
            array('name'=>'TB PATRIA ANDROMEDA 1', 'vessel_type'=>'TB', 'vessel_tx_id'=>'501441', 'vessel_heading_degree'=>'261','vessel_vts_speed_knot'=>'0','vessel_lat'=>'-7.0218','vessel_lon'=>'106.5261','last_updated'=>'2024-05-18 09:00:00'),
            array('name'=>'TB PM 1', 'vessel_type'=>'TB', 'vessel_tx_id'=>'501461', 'vessel_heading_degree'=>'191','vessel_vts_speed_knot'=>'4','vessel_lat'=>'-3.0454','vessel_lon'=>'114.7415','last_updated'=>'2024-05-18 09:00:00'),
            array('name'=>'TB PM 202', 'vessel_type'=>'TB', 'vessel_tx_id'=>'510029', 'vessel_heading_degree'=>'6','vessel_vts_speed_knot'=>'0','vessel_lat'=>'-3.6752','vessel_lon'=>'114.5012','last_updated'=>'2024-05-18 09:00:15'),
            array('name'=>'TB PRIMA POWER 01', 'vessel_type'=>'TB', 'vessel_tx_id'=>'501501', 'vessel_heading_degree'=>'223','vessel_vts_speed_knot'=>'0','vessel_lat'=>'-3.3175','vessel_lon'=>'114.5624','last_updated'=>'2024-05-17 20:41:05'),
            array('name'=>'TB PRIMA POWER 05', 'vessel_type'=>'TB', 'vessel_tx_id'=>'501373', 'vessel_heading_degree'=>'182','vessel_vts_speed_knot'=>'0','vessel_lat'=>'-3.3176','vessel_lon'=>'114.5627','last_updated'=>'2024-05-18 09:20:30'),
            array('name'=>'TB SINDO PERKASA V', 'vessel_type'=>'TB', 'vessel_tx_id'=>'502616', 'vessel_heading_degree'=>'119','vessel_vts_speed_knot'=>'0','vessel_lat'=>'-3.2702','vessel_lon'=>'116.1435','last_updated'=>'2024-03-06 15:34:10'),
            array('name'=>'TB SURYA ABADI 38', 'vessel_type'=>'TB', 'vessel_tx_id'=>'502561', 'vessel_heading_degree'=>'316','vessel_vts_speed_knot'=>'0','vessel_lat'=>'-6.9495','vessel_lon'=>'110.4255','last_updated'=>'2024-05-18 09:00:00'),
            array('name'=>'TB TRANS PACIFIC 211', 'vessel_type'=>'TB', 'vessel_tx_id'=>'501460', 'vessel_heading_degree'=>'187','vessel_vts_speed_knot'=>'0','vessel_lat'=>'-3.9294','vessel_lon'=>'113.6009','last_updated'=>'2024-05-18 09:00:00'),
            array('name'=>'TB VINCENT 1', 'vessel_type'=>'TB', 'vessel_tx_id'=>'502609', 'vessel_heading_degree'=>'10','vessel_vts_speed_knot'=>'1','vessel_lat'=>'-4.7699','vessel_lon'=>'113.4921','last_updated'=>'2024-05-18 09:00:00'),
            array('name'=>'TK 3214', 'vessel_type'=>'TB', 'vessel_tx_id'=>'706521', 'vessel_heading_degree'=>'268','vessel_vts_speed_knot'=>'3.7','vessel_lat'=>'-5.6875','vessel_lon'=>'110.22555','last_updated'=>'2024-05-01 14:00:30'),
            array('name'=>'TK 3216', 'vessel_type'=>'TB', 'vessel_tx_id'=>'706641', 'vessel_heading_degree'=>'0','vessel_vts_speed_knot'=>'0','vessel_lat'=>'-2.936949999999996','vessel_lon'=>'114.89450000000001','last_updated'=>'2024-05-18 03:05:03'),
            array('name'=>'TK ACHERNAR', 'vessel_type'=>'TB', 'vessel_tx_id'=>'704688', 'vessel_heading_degree'=>'54','vessel_vts_speed_knot'=>'2.5','vessel_lat'=>'-3.0896999999999935','vessel_lon'=>'122.7788','last_updated'=>'2024-05-18 07:00:00'),
            array('name'=>'TK ALKAID', 'vessel_type'=>'TB', 'vessel_tx_id'=>'705736', 'vessel_heading_degree'=>'0','vessel_vts_speed_knot'=>'0','vessel_lat'=>'-3.350049999999996','vessel_lon'=>'114.55525','last_updated'=>'2023-04-08 19:02:57'),
            array('name'=>'TK ALNAIR', 'vessel_type'=>'TB', 'vessel_tx_id'=>'705815', 'vessel_heading_degree'=>'0','vessel_vts_speed_knot'=>'0','vessel_lat'=>'-3.314949999999996','vessel_lon'=>'114.56055','last_updated'=>'2024-05-18 06:00:00'),
            array('name'=>'TK ANAND 15', 'vessel_type'=>'TB', 'vessel_tx_id'=>'705809', 'vessel_heading_degree'=>'220','vessel_vts_speed_knot'=>'5','vessel_lat'=>'-3.339649999999992','vessel_lon'=>'114.54715','last_updated'=>'2023-05-25 02:55:06'),
            array('name'=>'TK AURA', 'vessel_type'=>'TB', 'vessel_tx_id'=>'705825', 'vessel_heading_degree'=>'0','vessel_vts_speed_knot'=>'0','vessel_lat'=>'-3.4013499999999937','vessel_lon'=>'114.49600000000001','last_updated'=>'2024-05-17 08:45:00'),
            array('name'=>'TK PATRIA 3210', 'vessel_type'=>'TB', 'vessel_tx_id'=>'704689', 'vessel_heading_degree'=>'51','vessel_vts_speed_knot'=>'2','vessel_lat'=>'-5.150049999999993','vessel_lon'=>'112.38195','last_updated'=>'2024-05-17 23:00:00'),

        );

        foreach ($vessels as $vessel) {
            Vessel::factory()->create([
                'vessel_name' => $vessel['name'],
                'vessel_type' => $vessel['vessel_type'],
                'vessel_tx_id' => $vessel['vessel_tx_id'],
                'vessel_heading_degree' => $vessel['vessel_heading_degree'],
                'vessel_vts_speed_knot' => $vessel['vessel_vts_speed_knot'],
                'vessel_lat' => $vessel['vessel_lat'],
                'vessel_lon' => $vessel['vessel_lon'],
                'last_updated' => $vessel['last_updated'],


            ]);
        }
    }
}
