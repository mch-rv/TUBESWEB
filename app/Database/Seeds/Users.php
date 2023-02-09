<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\UsersModel;

class Users extends Seeder
{
	public function run()
	{
		$user_object = new UsersModel();

		$user_object->insertBatch([
			[
                "Username" => "Admin",
                "Password" => password_hash("Admin123", PASSWORD_DEFAULT),
                "Name" => "Admin",
				"Role" => "Admin",
                "Profile"   => "profile.png"
            ],
            [
                "Username" => "Ujang",
                "Password" => password_hash("Ujang123", PASSWORD_DEFAULT),
                "Name" => "Ujang",
				"Role" => "Staff",
                "Profile"   => "profile.png",
            ],
            [
                "Username" => "40621100041",
                "Password" => password_hash("40621100041", PASSWORD_DEFAULT),
                "Name" => "Mochammad Ravly",
				"Role" => "Pimpinan",
                "Profile"   => "profile.png",
            ],
		]);
	}
}