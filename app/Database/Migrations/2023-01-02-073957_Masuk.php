<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Masuk extends Migration
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
			'Asal_Surat'       => [
				'type'           => 'VARCHAR',
                'constraint'     => 255,
			],
			'Nomor'      => [
				'type'           => 'VARCHAR',
				'constraint'     => 255,
			],
			'Tanggal' => [
				'type'           => 'VARCHAR',
				'constraint'     => 255,
			],
            'Perihal' => [
				'type'           => 'VARCHAR',
				'constraint'     => 255,
			],
            'Penanggung_Jawab' => [
				'type'           => 'VARCHAR',
				'constraint'     => 255,
			],
            'Tanggal_Penerimaan' => [
				'type'           => 'VARCHAR',
				'constraint'     => 255,
			],
			'Keterangan' => [
				'type'           => 'VARCHAR',
				'constraint'     => 255,
				'null'           => true,
			],
			'created_at' => [
				'type'           => 'DATETIME',
				'null'           => true,
			],
			'updated_at' => [
				'type'           => 'DATETIME',
				'null'           => true,
			]
		]);

		// Membuat primary key
		$this->forge->addKey('id', TRUE);

		// Membuat tabel news
		$this->forge->createTable('Masuk', TRUE);
    }

    public function down()
    {
        //
        $this->forge->dropTable('Masuk');
    }
}