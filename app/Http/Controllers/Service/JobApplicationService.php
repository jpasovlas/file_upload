<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Repository\JobApplicationRepository;
use Illuminate\Support\Facades\Storage;

class JobApplicationService extends Controller
{

    protected $jobApplicationRepository;

    public function __construct(JobApplicationRepository $jobApplicationRepository)
    {
        $this->jobApplicationRepository = $jobApplicationRepository;
    }

    public function getAllApplicants()
    {
        $applicants = $this->jobApplicationRepository->getAllApplicants();

        return $applicants;
    }

    public function getApplicantById($id)
    {

        $applicant = $this->jobApplicationRepository->getApplicantById($id);

        return $applicant;
    }

    public function saveApplicant($request)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('resume')) {
            $filePath = $request->file('resume')->store('uploads', 'public');
            $validatedData['resume'] = $filePath;
        }

        $applicant = $this->jobApplicationRepository->saveApplicant($validatedData);

        return $applicant;
    }

    public function updateApplicantById($id, $request)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('resume')) {
            $applicant = $this->getApplicantById($id);
            Storage::disk('public')->delete($applicant->resume);
            $filePath = $request->file('resume')->store('uploads', 'public');
            $validatedData['resume'] = $filePath;
        }

        $applicant = $this->jobApplicationRepository->updateApplicantById($id, $validatedData);

        return $applicant;
    }

    public function deleteApplicantById($id)
    {
        $applicant = $this->jobApplicationRepository->deleteApplicantById($id);

        return $applicant;
    }
}
