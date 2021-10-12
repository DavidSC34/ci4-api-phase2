<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use App\Models\CategoryModel;

class ApiController extends ResourceController
{
    //POST
    public function createCategory()
    {
        //validation 
        $rules = [
            'name' => 'required|is_unique[categories.name]'
        ];

        if (!$this->validate($rules)) {
            $response = [
                'status' => 500,
                'message' => $this->validator->getErrors(),
                'error' => true,
                'data' => []
            ];
        } else {
            $category_model = new CategoryModel();
            $data = [
                'name' => $this->request->getVar('name'),
                'status' => $this->request->getVar('status')
            ];
            if ($category_model->insert($data)) {
                //data has been saved
                $response = [
                    'status' => 200,
                    'message' => 'Category created succesfully',
                    'error' => false,
                    'data' => []
                ];
            } else {
                //failed to save data
                $response = [
                    'status' => 500,
                    'message' => 'Failed to create category',
                    'error' => true,
                    'data' => []
                ];
            }
        }
        return $this->respondCreated($response);

        //instanc of category model

        //save to database table
    }

    //GET
    public function listCategory()
    {
    }
    //POST
    public function createBlog()
    {
    }

    //GET
    public function listBlogs()
    {
    }
    //GET
    public function singleBlogDetail($blog_id)
    {
    }
    //POSt --> PUT
    public function updateBlog($blog_id)
    {
    }
    //DELETe
    public function deleteBlog($blog_id)
    {
    }
}
