<?php

namespace App\Controllers;

class Biodata extends BaseController
{
	public function fungsiBaru($nama,$npm){
		echo "Hello $nama";
		echo "<br> $npm";
	}
    public function fungsiNama($nama,$npm){
		echo "Hello $nama";
	}
    public function fungsiNpm($nama,$npm){
		echo "$npm";
	}
}
