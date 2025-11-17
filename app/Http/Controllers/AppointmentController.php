<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Services\AppointmentService;
use Illuminate\View\View;


class AppointmentController extends Controller
{
    protected AppointmentService $appointmentService;

    public function __construct(AppointmentService $appointmentService)
    {
        $this->appointmentService = $appointmentService;
    }

    public function index(): View
    {
        $appointments = $this->appointmentService->getAllAppointments();
        return view('appointments.index', compact('appointments'));
    }

    public function create(): View
    {
        return view('appointments.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $appointment = $this->appointmentService->createAppointment($request->validate());

        return redirect()->route('appointments.index')->with('success', 'Appointment created successfully.');
    }

    public function show(Appointment $appointment): View
    {
        return view('appointments.show', compact('appointment'));
    }

    public function edit(Appointment $appointment): View
    {
        return view('appointments.edit', compact('appointment'));
    }

    public function update(Request $request, Appointment $appointment): RedirectResponse
    {
        $this->appointmentService->updateAppointment($appointment, $request->validate());

        return redirect()->route('appointments.index')->with('success', 'Appointment updated successfully.');
    }

    public function destroy(Appointment $appointment): RedirectResponse
    {
        $this->appointmentService->deleteAppointment($appointment);

        return redirect()->route('appointments.index')->with('success', 'Appointment deleted successfully.');
    }
}