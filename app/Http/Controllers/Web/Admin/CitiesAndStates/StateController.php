<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\CitiesAndStates\StateRequest;
use App\Models\State;
use App\Services\Web\Admin\CitiesAndStates\StateService;
use Illuminate\Http\Request;

class StateController extends Controller
{
    protected $stateService;

    public function __construct(StateService $stateService)
    {
        $this->stateService = $stateService;
    }

    // ✅ عرض كل الولايات
    public function index(Request $request)
    {
        $states = $this->stateService->getAll($request);
        return view('admin.states.index', compact('states'));
    }

    // ✅ عرض فورم إنشاء ولاية جديدة
    public function create()
    {
        return view('admin.states.create');
    }

    // ✅ تخزين ولاية جديدة
    public function store(StateRequest $request)
    {
        $this->stateService->create($request->validated());
        return redirect()->route('admin.states.index')->with('success', 'State created successfully.');
    }

    // ✅ عرض تفاصيل ولاية (مع المدن التابعة لها)
    public function show($id)
    {
        $state = $this->stateService->getStateById($id);
        $cities = $state->cities()->get(); // أو paginate لو بتحب
        return view('admin.states.show', compact('state', 'cities'));
    }

    // ✅ عرض فورم التعديل
    public function edit(State $state)
    {
        return view('admin.states.edit', compact('state'));
    }

    // ✅ تحديث ولاية
    public function update(StateRequest $request, State $state)
    {
        $this->stateService->update($request->validated(), $state);
        return redirect()->route('admin.states.index')->with('success', 'State updated successfully.');
    }

    // ✅ حذف ولاية
    public function destroy(State $state)
    {
        $this->stateService->delete($state);
        return redirect()->route('admin.states.index')->with('success', 'State deleted successfully.');
    }
}
