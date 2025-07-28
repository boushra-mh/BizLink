<?php
namespace App\Services\Web\Admin\CitiesAndStates;

use App\Enums\StatusEnum;
use App\Models\State;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;

class StateService
{
 public function getStateById(State $state)
 {
      return $state;

 }
 public function getAll( Request $request)
 {
      $query = State::query();

        $query->filterByName($request->input('name'))
              ->filterByStatus($request->input('status'));
            
    return State::latest()->get();
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
    $state =$this->getstateById($state);
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
