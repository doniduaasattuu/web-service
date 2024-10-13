<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class Members extends ResourceController
{
    use ResponseTrait;
    private $builder;

    function __construct()
    {
        $this->builder = \Config\Database::connect()->table('members');
    }
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $members = $this->builder->get()->getResult();
        return $this->respond($members);
    }

    /**
     * Return the properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function show($id = null)
    {
        $user = $this->builder->where('id', $id)->get()->getResult();

        if ($user) {
            return $this->respond($user);
        } else {
            return $this->failNotFound('No users were found');
        }
    }

    /**
     * Return a new resource object, with default properties.
     *
     * @return ResponseInterface
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        $rules = [
            'nama_member' => 'required|min_length[3]|max_length[40]',
            'email' => 'required|min_length[5]|max_length[35]|valid_email|is_unique[members.email]',
            'no_telp' => 'required|min_length[11]|max_length[16]|is_unique[members.no_telp]',
        ];

        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $validated = [
            'nama_member' => $this->request->getPost('nama_member'),
            'email' => $this->request->getPost('email'),
            'no_telp' => $this->request->getPost('no_telp'),
        ];

        $this->builder->insert($validated);
        return $this->respondCreated('Member created successfully');
    }

    /**
     * Return the editable properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function update($id = null)
    {
        $user = $this->builder->where('id', $id)->get()->getResult();

        if (!$user) {
            return $this->failNotFound('No users were found');
        }

        $data = $this->request->getRawInput();

        $rules = [
            'nama_member' => 'required|min_length[3]|max_length[40]',
            'email' => "required|min_length[5]|max_length[35]|valid_email|is_unique[members.email,id,$id]",
            'no_telp' => "required|min_length[11]|max_length[16]|is_unique[members.no_telp,id,$id]",
        ];

        $validation = \Config\Services::validation();
        $validation->setRules($rules);

        if (!$validation->run($data)) {
            return $this->failValidationErrors($validation->getErrors());
        }

        $validated = $this->request->getRawInput();
        $this->builder->where('id', $id)->update($validated);
        return $this->respondUpdated('Member updated successfully');
    }

    /**
     * Delete the designated resource object from the model.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function delete($id = null)
    {
        $user = $this->builder->where('id', $id)->get()->getResult();

        if ($user) {
            $this->builder->delete(['id' => $id]);
            return $this->respondDeleted('Member deleted successfully');
        }

        return $this->respondDeleted('Member already deleted');
    }
}
