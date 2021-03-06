<?php

namespace App\Models;

use CodeIgniter\Model;

class PeopleModel extends Model
{
	protected $table = 'people';
	protected $primaryKey = 'id';
	protected $allowedFields = [
		'id', 'foto', 'nama', 'whatsapp', 'alamat', 'tanggal_lahir', 'status_sekolah', 'status_kerja',
	];

	// public function findByName($name)
	// {
	// 	return $this->select('*')
	// 		->where('name', $name)
	// 		->get()->getResultArray();
	// }
}
