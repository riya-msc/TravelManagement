<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function blogs()
    {
        $blogs = Blog::latest('id')->get();
        return view('admin.blog.index',compact('blogs'));
    }
    public function blogAdd()
    {
        return view('admin.blog.add');
    }

    public function blogStore(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('upload/blogs'), $fileName);
            $image = 'upload/blogs/' . $fileName;
        }

        Blog::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $image,
            'author' => $request->author,
            'author_details' => $request->author_details,
        ]);

        $notification = array(
            'message' => 'Blog Added Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.blogs')->with($notification);
    }

    public function blogEdit(Blog $blog)
    {
        return view('admin.blog.edit',compact('blog'));
    }

    public function blogUpdate(Request $request,Blog $blog)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('upload/blogs'), $fileName);
            $image = 'upload/blogs/' . $fileName;
        }

        $blog->update([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $image ?? $blog->image,
            'author' => $request->author,
            'author_details' => $request->author_details,
        ]);

        $notification = array(
            'message' => 'Blog Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.blogs')->with($notification);
    }
    public function blogDeactivate(Blog $blog)
    {
        $blog->update([
            'status' => 0
        ]);
        $notification = array(
            'message' => 'Blog Deactivated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.blogs')->with($notification);
    }
    public function blogActivate(Blog $blog)
    {
        $blog->update([
            'status' => 1
        ]);
        $notification = array(
            'message' => 'Blog Activated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.blogs')->with($notification);
    }

}
