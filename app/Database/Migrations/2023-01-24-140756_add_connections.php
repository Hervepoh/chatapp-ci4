<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class AddConnections extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'          => [
				'type'           => 'INT',
				'unsigned'       => TRUE,
				'auto_increment' => TRUE
			],
			'ressource_id'       => [
				'type'           => 'INT',
			],
			'user_id'       => [
				'type'           => 'INT',
			],
			'name'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '50'
			],
			'created_at' => [
                'type'       => 'TIMESTAMP',
                'default'    => new RawSql('CURRENT_TIMESTAMP')
            ],
		]);
		$this->forge->addKey('id', TRUE);
		$this->forge->createTable('connections');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('connections');
	}
}
