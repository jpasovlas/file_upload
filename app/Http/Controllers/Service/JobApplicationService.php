<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Repository\JobApplicationRepository;

class JobApplicationService extends Controller
{

    /**
     * @var JobApplicationRepository $jobApplicationRepository
     */
    protected $jobApplicationRepository;

    /**
     * Constructor
     *
     * @param JobApplicationRepository $jobApplicationRepository
     */
    public function __construct(JobApplicationRepository $jobApplicationRepository)
    {
        $this->jobApplicationRepository = $jobApplicationRepository;
    }

    /**
     * Get all applicants
     */
    public function getAllApplicants()
    {
        $applicants = $this->jobApplicationRepository->getAllApplicants();

        return $applicants;
    }

    /**
     * Get specific applicant by ID
     *
     * @param int $id
     *
     * @return Object
     */
    public function getApplicantById(int $id)
    {

        $applicant = $this->jobApplicationRepository->getApplicantById($id);

        return $applicant;
    }

    /**
     * Create new applicant
     *
     * @param object $request
     *
     * @return Object
     */
    public function saveApplicant(object $request)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('resume')) {
            $filePath = $request->file('resume')->store('uploads', 'public');
            $validatedData['resume'] = $filePath;
        }

        $applicant = $this->jobApplicationRepository->saveApplicant($validatedData);

        return $applicant;
    }

    /**
     * Update applicant by ID
     *
     * @param int $id
     * @param object $request
     *
     * @return Object
     */
    public function updateApplicantById(int $id, object $request)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('resume')) {
            $applicant = $this->getApplicantById($id);

            $this->jobApplicationRepository->deleteFile($applicant->resume);

            $filePath = $request->file('resume')->store('uploads', 'public');
            $validatedData['resume'] = $filePath;
        }

        $applicant = $this->jobApplicationRepository->updateApplicantById($id, $validatedData);

        return $applicant;
    }

    /**
     * Delete applicant by ID
     *
     * @param int $id
     *
     * @return Object
     */
    public function deleteApplicantById(int $id)
    {
        $applicant = $this->jobApplicationRepository->deleteApplicantById($id);

        return $applicant;
    }
}
