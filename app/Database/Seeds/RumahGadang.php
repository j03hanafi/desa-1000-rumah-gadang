<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class RumahGadang extends Seeder
{
    public function run()
    {
    
        $rows = array_map('str_getcsv', file(WRITEPATH.'seeds/'. 'rumah_gadang.csv'));
        $header = array_shift($rows);
    
        foreach ($rows as $row) {
            $data = [
                'id_rumah_gadang' => $row[0],
                'id_user' => $row[1],
                'id_recommendation' => $row[2],
                'name' => $row[3],
                'address' => $row[4],
                'open' => $row[5],
                'close' => $row[6],
                'cp' => $row[7],
                'price_ticket' => $row[9],
                'status' => $row[10],
                'description' => $row[11],
                'video_url' => $row[12],
                'lat' => $row[13],
                'lng' => $row[14],
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ];
        
            $this->db->table('rumah_gadang')->insert($data);
            $this->db->table('rumah_gadang')->set('geom', $row[8], false)->where('id_rumah_gadang', $row[0])->update();
        }
    }
}
