<?php

namespace App\Http\Controllers;

use App\Models\Billing;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Services\BillingService;
use Illuminate\View\View;

class BillingController extends Controller
{
    protected BillingService $billingService;

    public function __construct(BillingService $billingService)
    {
        $this->billingService = $billingService;
    }

    public function index(): View
    {
        $billings = $this->billingService->getAllBillings();
        return view('billings.index', compact('billings'));
    }

    public function create(): View
    {
        return view('billings.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $billing = $this->billingService->createBilling($request->validate());

        return redirect()->route('billings.index')->with('success', 'Billing created successfully.');
    }

    public function show(Billing $billing): View
    {
        return view('billings.show', compact('billing'));
    }

    public function edit(Billing $billing): View
    {
        return view('billings.edit', compact('billing'));
    }

    public function update(Request $request, Billing $billing): RedirectResponse
    {
        $this->billingService->updateBilling($billing, $request->validate());

        return redirect()->route('billings.index')->with('success', 'Billing updated successfully.');
    }

    public function destroy(Billing $billing): RedirectResponse
    {
        $this->billingService->deleteBilling($billing);

        return redirect()->route('billings.index')->with('success', 'Billing deleted successfully.');
    }
}