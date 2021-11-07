<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PostModel;
class AdminPostController extends BaseController
{
	public function index()
	{
		$PostModel = model("PostModel");
		$data = [
			'posts' => $PostModel->findAll()
		];
		return view("posts/index", $data);
	}

	public function create()
	{
		session();
		$data = [
			'validation' => \Config\Services::validation(),
		];
		return view("posts/create", $data);
	}

	public function store()
	{
		$valid = $this->validate([
			"judul" => [
				"label" => "judul",
				"rules" => "required",
				"errors" => [
					"required" => "{field} Harus Diisi!"
				]
			],
			"slug" => [
				"label" => "slug",
				"rules" => "required|is_unique[posts.slug]",
				"errors" => [
					"required" => "{field} Harus Diisi!",
					"is_unique" => "{field} sudah ada!"
				]
			],
			"kategori" => [
				"label" => "kategori",
				"rules" => "required",
				"errors" => [
					"{field} Harus Diisi!"
				]
			],
			"author" => [
				"label" => "author",
				"rules" => "required",
				"errors" => [
					"{field} Harus Diisi!"
				]
			],
			"deskripsi" => [
				"label" => "deskripsi",
				"rules" => "required",
				"errors" => [
					"{field} Harus Diisi!"
				]
			]
		]);

		if ($valid) {
			$data = [
				'judul' => $this->request->getVar('judul'),
				'slug' => $this->request->getVar('slug'),
				'kategori' => $this->request->getVar('kategori'),
				'author' => $this->request->getVar('author'),
				'deskripsi' => $this->request->getVar('deskripsi'),
			];

			$PostModel = model("PostModel");
			$PostModel-> insert($data);
			return redirect()->to(base_url('/admin/posts/'));
		} else {
			return redirect()->to(base_url('/admin/posts/create'))->withInput()->with('validation', $this->validator);
		}
	}

	public function edit($post_id){
		$postmodel = new PostModel();
		$datas ['postmodel'] = $postmodel->find($post_id);
		return view('posts/edit', $datas);
	}

	public function update($post_id){
		$postmodel =new PostModel();
		$data = [
			'judul' => $this->request->getVar('judul'),
			'slug' => $this->request->getVar('slug'),
			'kategori' => $this->request->getVar('kategori'),
			'author' => $this->request->getVar('author'),
			'deskripsi' => $this->request->getVar('deskripsi'),
		];
		$postmodel->update($post_id, $data);
		return redirect()->to(base_url('/admin/posts/'));
	}

	public function delete($post_id){
		$postmodel = new PostModel();
		$postmodel->delete($post_id);
		return redirect()->to(base_url('/admin/posts/'));
	}
}