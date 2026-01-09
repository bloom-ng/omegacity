<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = Blog::query();

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where('title', 'like', "%$search%")
                ->orWhere('body', 'like', "%$search%");
        }

        $blogs = $query->orderBy('published_at', 'desc')->paginate(6);

        return view('admin.blogs.index', compact('blogs'));
    }


    public function create()
    {
        return view('admin.blogs.create');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'string',
            'published_at' => 'nullable|date',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('blogs', 'public');
        }


        if (!$request->excerpt) {
            $validated['excerpt'] = Str::limit(strip_tags($validated['body']), 150);
        }

        $validated['author'] = 'Omega City';

        Blog::create($validated);

        return redirect()->route('admin.blogs.index')
            ->with('success', 'Blog created successfully.');
    }


    public function show(Blog $blog)
    {
        return view('admin.blogs.show', compact('blog'));
    }

    public function edit(Blog $blog)
    {
        return view('admin.blogs.edit', compact('blog'));
    }

     public function update(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'published_at' => 'nullable|date',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('thumbnail')) {

            if ($blog->thumbnail && Storage::disk('public')->exists($blog->thumbnail)) {
                Storage::disk('public')->delete($blog->thumbnail);
            }

            $validated['thumbnail'] = $request->file('thumbnail')->store('blogs', 'public');
        }

        $blog->update($validated);

        return redirect()->route('admin.blogs.index')
            ->with('success', 'Blog updated successfully.');
    }

    public function destroy(Blog $blog)
    {
        if ($blog->thumbnail && Storage::disk('public')->exists($blog->thumbnail)) {
            Storage::disk('public')->delete($blog->thumbnail);
        }

        $blog->delete();

        return redirect()->route('admin.blogs.index')
            ->with('success', 'Blog deleted successfully.');
    }
}
