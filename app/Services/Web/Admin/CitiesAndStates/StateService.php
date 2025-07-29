<?php
namespace App\Services\Web\Admin\CitiesAndStates;

use App\Enums\StatusEnum;
use App\Models\State;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;

class StateService
{
public function getStateById($id)
{
    return State::findOrFail($id);
}
 public function getAll(Request $request)
{
    $query = State::query();

    // فلترة الاسم إذا موجود
    if ($request->filled('name')) {
        $query->filterByName($request->input('name'));
    }

    // فلترة الحالة إذا موجودة
    if ($request->filled('status')) {
        $query->filterByStatus($request->input('status'));
    }

   

    return $query->latest()->get();
}

 

 public function create(array $data)
 {
    $state =State::create([
        'name'=>$data['name'],

        'status'=>StatusEnum::ACTIVE->value

    ]);
    return $state;
 }
 public function update(array $data ,State $state)
 {
    $state =$this->getStateById($state);
    $state->update([
          'name'=>$data['name'],
         'status' => $data['status'] ?? $state->status,

    ]);
    return $state;
 }
 public function delete(State $state)
 {
    $this->getStateById($state)->delete();
 }
}
