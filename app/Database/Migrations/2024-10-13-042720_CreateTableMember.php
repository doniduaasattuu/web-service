<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableMember extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
            ],
            'nama_member' => [
                'type'           => 'VARCHAR',
                'constraint'     => 40,
            ],
            'email' => [
                'type'           => 'VARCHAR',
                'constraint'     => 35,
            ],
            'no_telp' => [
                'type'           => 'VARCHAR',
                'constraint'     => 16,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('members');
    }

    public function down()
    {
        $this->forge->dropTable('members');
    }
}
