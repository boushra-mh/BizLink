<?php

namespace App\Services\Web\Admin\Tags;

use App\Enums\StatusEnum;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagService
{
    public function getAll(Request $request)
    {
        $query = Tag::query();

        if ($request->filled('name')) {
            $query->filterByName($request->input('name'));
        }

        if ($request->filled('status')) {
            $query->filterByStatus($request->input('status'));
        }

        return $query->latest()->get();
    }

    public function getTagById($id): Tag
    {
        return Tag::findOrFail($id);
    }

    public function create(array $data)
    {
     $tag=Tag::create([
        'name'=>$data['name'],
        'status'=>StatusEnum::ACTIVE->value

     ]);
     return $tag;
    }

    public function update(array $data, string $id): Tag
    {
        $tag= $this->getTagById($id);
        $tag->update([
            'name'=>$data['name'],
            'status'=>$data['status'] ?? $tag->status
        ]);
        return $tag;
    }

    public function delete(Tag $tag): void
    {
        $tag->delete();
    }
}
