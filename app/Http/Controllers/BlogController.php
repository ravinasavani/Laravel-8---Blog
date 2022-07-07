<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Blog;
use Validator;
use Session;

class BlogController extends Controller
{
    public function index()
    {
        $blog = new Blog();
        $blogs = $blog->getBlog();
        // dd($blogs);
        return view('blog.index', compact('blogs'));
    }

    public function create()
    {
        return view('blog.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        $data = array(
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'user_id' => Auth::user()->id
        );

        $blog = new Blog();
        $addBlog = $blog->addBlog($data);
        if($addBlog)
        {
            $return = ['status' => 'success', 'message' => " Blog created successfully."];
        }
        else
        {
            $return = ['status' => 'error', 'message' => " Something went wrong."];
        }
        Session::flash('message', '<div class="success-alert alert alert-' . ($return['status'] == 'error' ? 'danger' : $return['status']) . '"><strong>' . ucfirst($return['status']) . ': </strong> ' . $return['message'] . '</div>');
        return redirect('blog');
    }
    
    public function edit($id)
    {
        $blog = new Blog();
        $editBlog = $blog->getBlogById($id);
        return view('blog.edit', compact('editBlog'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        $data = array(
            'title' => $request->get('title'),
            'description' => $request->get('description'),
        );

        $blog = new Blog();
        $editBlog = $blog->editBlog($data, $id);
        if($editBlog)
        {
            $return = ['status' => 'success', 'message' => " Blog updated successfully."];
        }
        else
        {
            $return = ['status' => 'error', 'message' => " Something went wrong."];
        }
        Session::flash('message', '<div class="success-alert alert alert-' . ($return['status'] == 'error' ? 'danger' : $return['status']) . '"><strong>' . ucfirst($return['status']) . ': </strong> ' . $return['message'] . '</div>');
        return redirect('blog');
    }

    public function delete($id)
    {
        $blog = new Blog();
        $deleteBlogFound = $blog->getBlogById($id);
        if($deleteBlogFound)
        {
            $deleteBlog=$blog->deleteBlog($id);
            $return = ['status' => 'success', 'message' => " Blog deleted successfully."];
        }
        else
        {
            $return = ['status' => 'error', 'message' => " Something went wrong."];
        }
        Session::flash('message', '<div class="success-alert alert alert-' . ($return['status'] == 'error' ? 'danger' : $return['status']) . '"><strong>' . ucfirst($return['status']) . ': </strong> ' . $return['message'] . '</div>');
        return redirect('blog');
    }
}
