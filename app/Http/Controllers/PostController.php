<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function all(Request $request) {
        if (!$request->search) {
            $posts = Post::paginate(20);
        } else {
            // SELECT * FROM posts WHERE title LIKE '%hello%';
            $posts = Post::where('title', 'LIKE', "%$request->search%")
                ->orWhere('excerpt', 'LIKE', "%$request->search%")
                ->orWhere('content', 'LIKE', "%$request->search%")
                ->orWhere('author', 'LIKE', "%$request->search%")
                ->orderBy('title', 'desc')
                ->paginate(20);
        }

        return view('blog', [
            'posts' => $posts
        ]);
    }

    // Getting access to the dynamic portion of the URL
    // by giving our method a param with the same name as the url {} bit
    public function find(Post $post)
    {
        return view('singlePost', [
            'post' => $post,
        ]);
    }

//    public function find(int $id)
//    {
//        $post = Post::findorFail($id);
//        return view('singlePost', [
//            'post' => $post,
//        ]);
//    }

    public function addForm()
    {
    return view('addPost');
    }

    // If you have an action that needs to access data from the request (form data)
    // We give it a $request param typed hinted to Request
    // This gives us a request object containing all the data from the form
    // and some extra magic stuff we'll see later
    public function create(Request $request)
    {
        // TODO: Validate the data
        $request->validate([
            'title' => 'required|string|min:2|max:70',
            'content' => 'required|string|min:50',
            'image' => 'nullable|string|url|max:255',
            'excerpt' => 'required|string|min:10|max:300',
            'author' => 'required|string|min:3|max:255',

        ]);

        // Get the data out of the form
        $newPost = new Post(); // We create a new blank post

        // Transfer the data from the request (form) into the blank post
        $newPost->title = $request->title;
        $newPost->content = $request->content;
        $newPost->image = $request->image;
        $newPost->excerpt = $request->excerpt;
        $newPost->author = $request->author;
        // Save the data to the posts table
        $newPost->save();

        // Send some kind of response
        return redirect('/blog');
    }
}
