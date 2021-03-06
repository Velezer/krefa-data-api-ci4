<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PeopleTable extends Migration
{
	public function up()
	{

		$this->forge->addField([
			'id' => [
				'type' => 'VARCHAR',
				'constraint' => 20,
				'null' => false

			],
			'foto' => [
				'type' => 'VARCHAR',
				'constraint' => 255,
				'null' => true
			],
			'nama' => [
				'type' => 'VARCHAR',
				'constraint' => 255
			],
			'whatsapp' => [
				'type' => 'VARCHAR',
				'constraint' => 16
			],
			'alamat' => [
				'type' => 'TEXT',
			],
			'tanggal_lahir' => [
				'type' => 'DATE'
			],
			'status_sekolah'      => [
				'type'           => 'ENUM',
				'constraint'     => ['Kuliah', 'SMP', 'SMA'],
				'default'        => 'Kuliah',
			],
			'status_kerja'      => [
				'type'           => 'ENUM',
				'constraint'     => ['Kerja', 'Tidak Kerja'],
				'default'        => 'Kerja',
			],
		]);

		$this->forge->addPrimaryKey('id');
		$this->forge->createTable('people', true);
	}

	public function down()
	{
		$this->forge->dropTable('people', true);
	}
}
