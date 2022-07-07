<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class Blog extends Model
{
    protected $table = "blog";
    protected $primaryKey = "id";
    use HasFactory;

    public function User()
    {
        $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function getBlog()
    {
        return $this->get();
    }

    public function getBlogById($id)
    {
        return $this->where('id', $id)->first();
    }

    public function addBlog($data = array())
    {
        // $table = 'blog';
        // $data = array(
        //     'title' => 'Test',
        //     'description' => 'test'
        // );

        // return DB::table("$table")->insert($data);
        $blog = new Blog();
        $blog->title = $data['title'];
        $blog->description = $data['description'];
        $blog->user_id = $data['user_id'];
        if ($blog->save()) {
            return $blog;
        }
        return false;
    }

    public function editBlog($data, $id)
    {
        $updBlog = Blog::where('id', $id)->update([
            'title' =>  $data['title'],
            'description' => $data['description']
        ]);
        if ($updBlog) {
            return $updBlog;
        }
        return false;
    }

    public function deleteBlog($id)
    {
        // $table = 'blog';
        // $arrId = array('id' => 10);
        // $col_name = key($arrId);
        // $col_val = $arrId[$col_name];
        // return DB::table("$table")->where($col_name, "=", $col_val)->delete();

        return $this->where('id', '=', $id)->delete();
    }
}
