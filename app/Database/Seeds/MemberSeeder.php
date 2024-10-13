<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MemberSeeder extends Seeder
{
    public function run()
    {
        $members = [
            [
                'nama_member' => 'Tiwi Pertiwi',
                'email'       => 'tiwi@gmail.com',
                'no_telp'     => '111122223333',
            ],
            [
                'nama_member' => 'Hanna Putri',
                'email'       => 'hana@gmail.com',
                'no_telp'     => '555566667777',
            ],
            [
                'nama_member' => 'Mus Dalifa',
                'email'       => 'mus@gmail.com',
                'no_telp'     => '888899990000',
            ],
        ];

        $this->db->table('members')->insertBatch($members);
    }
}
