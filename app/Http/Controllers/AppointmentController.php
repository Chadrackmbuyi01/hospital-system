<?php
namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Services\AppointmentService;
use Illuminate\View\View;
use App\Http\Requests\AppointmentRequest;

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
        // You'll need to pass doctors and patients to the view
        $doctors = \App\Models\User::where('role', 'doctor')->get();
        $patients = \App\Models\User::where('role', 'patient')->get();
        return view('appointments.create', compact('doctors', 'patients'));
    }

    public function store(AppointmentRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $this->appointmentService->createAppointment($validated);

        return redirect()->route('appointments.index')->with('success', 'Appointment created successfully.');
    }

    public function show(Appointment $appointment): View
    {
        return view('appointments.show', compact('appointment'));
    }

    public function edit(Appointment $appointment): View
    {
        $doctors = \App\Models\User::where('role', 'doctor')->get();
        $patients = \App\Models\User::where('role', 'patient')->get();
        return view('appointments.edit', compact('appointment', 'doctors', 'patients'));
    }

    public function update(AppointmentRequest $request, Appointment $appointment): RedirectResponse
    {
        $validated = $request->validated();
        $this->appointmentService->updateAppointment($appointment, $validated);

        return redirect()->route('appointments.index')->with('success', 'Appointment updated successfully.');
    }

    public function destroy(Appointment $appointment): RedirectResponse
    {
        $this->appointmentService->deleteAppointment($appointment);
        return redirect()->route('appointments.index')->with('success', 'Appointment deleted successfully.');
    }
}