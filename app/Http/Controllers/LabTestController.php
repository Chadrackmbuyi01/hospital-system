<?php

namespace App\Http\Controllers;

use App\Models\LabTest;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Services\LabTestService;
use Illuminate\View\View;

class LabTestController extends Controller
{
    protected LabTestService $labTestService;

    public function __construct(LabTestService $labTestService)
    {
        $this->labTestService = $labTestService;
    }

    public function index(): View
    {
        $labTests = $this->labTestService->getAllLabTests();
        return view('labtests.index', compact('labTests'));
    }

    public function create(): View
    {
        return view('labtests.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $labTest = $this->labTestService->createLabTest($request->validate());

        return redirect()->route('labtests.index')->with('success', 'Lab Test created successfully.');
    }

    public function show(LabTest $labTest): View
    {
        return view('labtests.show', compact('labTest'));
    }

    public function edit(LabTest $labTest): View
    {
        return view('labtests.edit', compact('labTest'));
    }

    public function update(Request $request, LabTest $labTest): RedirectResponse
    {
        $this->labTestService->updateLabTest($labTest, $request->validate());

        return redirect()->route('labtests.index')->with('success', 'Lab Test updated successfully.');
    }

    public function destroy(LabTest $labTest): RedirectResponse
    {
        $this->labTestService->deleteLabTest($labTest);

        return redirect()->route('labtests.index')->with('success', 'Lab Test deleted successfully.');
    }
}