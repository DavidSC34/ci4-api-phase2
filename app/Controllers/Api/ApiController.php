<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use App\Models\CategoryModel;
use App\Models\BlogModel;

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
        $category_obj =  new CategoryModel();
        $response = [
            'status'=>200,
            'message'=>"List of categories",
            'error'=>false,
            'data'=> $category_obj->findAll()

        ];

        return $this->respondCreated($response);
    }
    //POST
    public function createBlog()
    {
        //validation
      $rules =[
          'category_id'=>'required',
          'title'=>'required'

      ];
      if(!$this->validate($rules)){ 
            //error
            $response = [
                'status'=>500,
                'message'=>$this->validator->getErrors(),
                'error'=>true,
                'data'=> []    
            ];
      }else{
            //no error
            //asegurar que la categoria existe
            $category_obj = new CategoryModel();
            $is_exists =   $category_obj->find($this->request->getVar('category_id'));
            if(!empty($is_exists)){
                    //existe la categoria
                    $blog_obj = new BlogModel();
                    $data = [
                        'category_id'=>$this->request->getVar('category_id'),
                        'title'=>$this->request->getVar('title'),
                        'content'=>$this->request->getVar('content')
                    ];
                    if($blog_obj->insert($data)){
                            //blog created
                            $response = [
                                'status'=>200,
                                'message'=>'Blog has been created',
                                'error'=>false,
                                'data'=> []    
                            ];
                    }else{
                        //failde to create blog
                        $response = [
                            'status'=>500,
                            'message'=>'Failed to created blog',
                            'error'=>true,
                            'data'=> []    
                        ];
                    }
            }else{
                // no existe la categoria
                $response = [
                    'status'=>404,
                    'message'=>'Category not found',
                    'error'=>true,
                    'data'=> []    
                ];
            }
      }
      return $this->respondCreated($response);

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
