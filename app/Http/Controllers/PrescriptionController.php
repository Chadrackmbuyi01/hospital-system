<?php

namespace App\Http\Controllers;

use App\Models\Prescription;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Services\PrescriptionService;
use Illuminate\View\View;

class PrescriptionController extends Controller
{
    protected PrescriptionService $prescriptionService;

    public function __construct(PrescriptionService $prescriptionService)
    {
        $this->prescriptionService = $prescriptionService;
    }

    public function index(): View
    {
        $prescriptions = $this->prescriptionService->getAllPrescriptions();
        return view('prescriptions.index', compact('prescriptions'));
    }

    public function create(): View
    {
        return view('prescriptions.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $prescription = $this->prescriptionService->createPrescription($request->validate());

        return redirect()->route('prescriptions.index')->with('success', 'Prescription created successfully.');
    }

    public function show(Prescription $prescription): View
    {
        return view('prescriptions.show', compact('prescription'));
    }

    public function edit(Prescription $prescription): View
    {
        return view('prescriptions.edit', compact('prescription'));
    }

    public function update(Request $request, Prescription $prescription): RedirectResponse
    {
        $this->prescriptionService->updatePrescription($prescription, $request->validate());

        return redirect()->route('prescriptions.index')->with('success', 'Prescription updated successfully.');
    }

    public function destroy(Prescription $prescription): RedirectResponse
    {
        $this->prescriptionService->deletePrescription($prescription);

        return redirect()->route('prescriptions.index')->with('success', 'Prescription deleted successfully.');
    }
}