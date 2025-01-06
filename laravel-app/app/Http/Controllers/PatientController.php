<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Http\Requests\StorePatientRequest;
use App\Notifications\PatientRegisteredNotification;
use App\Services\FileUploadService;


class PatientController extends Controller
{
    protected FileUploadService $fileUploadService;

    public function __construct(FileUploadService $fileUploadService)
    {
        $this->fileUploadService = $fileUploadService;
    }

    public function store(StorePatientRequest $request)
    {
        $validatedData = $request->validated();

        $validatedData['document_photo'] = $this->fileUploadService->uploadToPath($request->file('document_photo'), 'documents');

        $newPatient = Patient::create(
            $validatedData
        );

        $newPatient->notify(new PatientRegisteredNotification($newPatient));

        return response()->json([
            'message' => 'Patient registered successfully, go check your email!',
            'data' => $newPatient,
        ], 201);
    }
}
