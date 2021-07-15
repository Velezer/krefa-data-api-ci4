<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class EventsTable extends Migration
{
	public function up()
	{

		$this->forge->addField([
			'id'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true
			],
			'tema' => [
				'type' => 'VARCHAR',
				'constraint' => 100,
			],
			'judul' => [
				'type'         => 'VARCHAR',
				'constraint'   => 255
			],
			'pembicara' => [
				'type'        => 'VARCHAR',
				'constraint'  => 255
			],
			'tempat' => [
				'type' => 'VARCHAR',
				'constraint' => 255
			],
			'keterangan_tambahan' => [
				'type' => 'TEXT',
				'null' => true
			],
			'tanggal' => [
				'type' => 'DATE'
			],
			'people_id' => [
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => true,
				'null' => true
				
			]
		]);

		
		$this->forge->addPrimaryKey('id');

		$this->forge->addForeignKey('people_id', 'people', 'id');

		$this->forge->createTable('events', true);

	}

	public function down()
	{
		$this->forge->dropTable('events', true);
	}
}