<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'id'          => [
				'type'           => 'INT',
				'constraint'     => 5,
				'unsigned'       => true,
				'auto_increment' => true
			],
			'Username'          => [
				'type'           => 'VARCHAR',
				'constraint'     => '100',
			],
			'Password'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '100',
			],
			'Name'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '100',
			],
			'Role'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '10',
			],
			'Profile' => [
				'type'           => 'VARCHAR',
				'constraint'     => 100,
				'null'           => true,
			],
			'created_at' => [
				'type'           => 'DATETIME',
				'null'       	 => true,
			],
			'updated_at' => [
				'type'           => 'DATETIME',
				'null'       	 => true,
			]
 
		]);
		$this->forge->addPrimaryKey('id', true);
		$this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
