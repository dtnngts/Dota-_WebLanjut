<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		return view('welcome_message');
	}

	public function fungsiBaru($nama, $npm) {
		echo "Hello $nama";
		echo "<br> $npm";
	}

	public function show() {
		$adat['nama'] = 'Dota Ningtias';
		$adat['jurusan'] = 'Ilmu Komputer';
		echo view("mahasiswa/index", $adat);
	}
}
