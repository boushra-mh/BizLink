<?php

namespace App\Http\Controllers\Web\Admin\Tags;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\Tags\TagRequest;
use App\Models\Tag;
use App\Services\Web\Admin\Tags\TagService;
use Illuminate\Http\Request;

class TagController extends Controller
{
    protected TagService $tagService;

    public function __construct(TagService $tagService)
    {
        $this->tagService = $tagService;
    }

    public function index(Request $request)
    {
        $tags = $this->tagService->getAll($request);
        return view('admin.tags.index', compact('tags'));
    }

    public function create()
    {
        return view('admin.tags.create');
    }

    public function store(TagRequest $request)
    {
        $this->tagService->create($request->validated());
        return redirect()->route('admin.tags.index')->with('success', 'Tag created successfully!');
    }

    public function show($id)
    {
        $tag = $this->tagService->getTagById($id);
        return view('admin.tags.show', compact('tag'));
    }

    public function edit($id)
    {
        $tag = $this->tagService->getTagById($id);
        return view('admin.tags.edit', compact('tag'));
    }

    public function update(TagRequest $request, $id)
    {
        $this->tagService->update($request->validated(), $id);
        return redirect()->route('admin.tags.index')->with('success', 'Tag updated successfully!');
    }

    public function destroy(Tag $tag)
    {
        $this->tagService->delete($tag);
        return redirect()->route('admin.tags.index')->with('success', 'Tag deleted successfully!');
    }
}
