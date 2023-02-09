<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Ekspedisi extends Migration
{
    public function up()
	{
		// Membuat kolom/field untuk tabel news
		$this->forge->addField([
			'id'          => [
				'type'           => 'INT',
				'constraint'     => 5,
				'unsigned'       => true,
				'auto_increment' => true
			],
			'Tanggal_Surat_Kirim'       => [
				'type'           => 'DATE',
			],
			'Nomor_Surat_Kirim'      => [
				'type'           => 'VARCHAR',
				'constraint'     => 255,
			],
			'Perihal' => [
				'type'           => 'VARCHAR',
				'constraint'     => 255,
			],
            'Tujuan_Surat' => [
				'type'           => 'VARCHAR',
				'constraint'     => 255,
			],
            'TTD' => [
				'type'           => 'VARCHAR',
				'constraint'     => 100,
				'null'           => true,
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
		$this->forge->createTable('Ekspedisi', TRUE);
	}

	//-------------------------------------------------------

	public function down()
	{
		// menghapus tabel news
		$this->forge->dropTable('Ekspedisi');
	}
}
