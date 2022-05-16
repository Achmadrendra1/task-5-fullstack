<?php

namespace App\Http\Controllers;

use App\Models\Articles;
use App\Models\Categories;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        return view('Admin.index', [
            'title' => 'Dashboard Admin',

        ]);
    }

    public function addPosts()
    {
        $category = Categories::all();
        return view('Admin.add_post', [
            'title' => 'Dashboard Admin',
            'category' => $category

        ]);
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Articles::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }

    public function storePosts(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',

        ]);

        $add_posts = new Articles();
        $add_posts->title = $request->title;
        $add_posts->slug = $request->slug;
        $add_posts->content = $request->content;
        $add_posts->excerpt = Str::limit(strip_tags($request->content), 100, '...');
        $add_posts->user_id = Auth::user()->id;
        $add_posts->category_id = $request->category;
        if ($request->hasFile('image')) {
            $request->validate(['image' => 'mimes:jpeg,bmp,png']);
            $request->image->store('posts', 'public');
            $add_posts->image = $request->image->hashName();
        }

        $add_posts->save();
        return redirect('admin/posts')->with('success', 'New Posts added');
    }

    public function viewPost()
    {
        $user = Auth::user()->id;
        $data = Articles::all()->where('user_id', $user);

        return view('Admin.view_post', [
            'title' => 'My Post',
            'posts' => $data
        ]);
    }

    public function editPosts(Request $request, $id)
    {
        $edit_posts = Articles::find($id);
        $category = Categories::all();
        return view('Admin.edit_post', [
            'title' => 'Edit Post',
            'posts' => $edit_posts,
            'category' => $category
        ]);
    }

    public function updatePosts(Request $request, $id)
    {
        $edit_posts = Articles::findOrFail($id);
        $edit_posts->title = $request->edited_title;
        $edit_posts->slug = $request->edited_slug;
        $edit_posts->content = $request->edited_content;
        $edit_posts->excerpt = Str::limit(strip_tags($request->edited_content), 100, '...');
        $edit_posts->user_id = Auth::user()->id;
        $edit_posts->category_id = $request->category;
        if ($request->hasFile('image')) {
            $request->validate(['image' => 'mimes:jpeg,bmp,png']);
            $request->image->store('posts', 'public');
            $edit_posts->image = $request->image->hashName();
        }
        $edit_posts->update();
        return redirect('admin/posts')->with('success', 'Posts Updated');
    }

    public function destroyPosts($id)
    {
        Articles::where('id', $id)->delete();
        return redirect('admin/posts')->with('success', 'Posts Deleted');
    }

    public function list_category()
    {

        $data = Categories::all();

        return view('Admin.view_category', [
            'title' => 'My Post',
            'category' => $data
        ]);
    }

    public function addCategory()
    {

        return view('Admin.add_category', [
            'title' => 'Dashboard Admin',

        ]);
    }

    public function storeCategory(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',

        ]);

        $add_category = new Categories();
        $add_category->name = $request->name;
        $add_category->user_id = Auth::user()->id;


        $add_category->save();
        return redirect('admin/category')->with('success', 'New Category added');
    }

    public function editCategory(Request $request, $id)
    {

        $category = Categories::findOrFail($id);
        return view('Admin.edit_category', [
            'title' => 'Edit Post',

            'category' => $category
        ]);
    }

    public function updateCategory(Request $request, $id)
    {
        $edit_category = Categories::findOrFail($id);
        $edit_category->name = $request->edited_name;

        $edit_category->update();
        return redirect('admin/category')->with('success', 'Category Updated');
    }

    public function destroyCategory($id)
    {
        Categories::where('id', $id)->delete();
        return redirect('admin/category')->with('success', 'Category Deleted');
    }
}
