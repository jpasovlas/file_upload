<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Service\JobApplicationService;
use App\Http\Requests\JobApplicationRequest;
use App\Http\Requests\JobApplicationUpdateRequest;
use Exception;
use Log;
use App\Constants\AppConstants;

class JobApplicationApiController extends Controller
{

    protected $jobApplicationService;

    public function __construct(JobApplicationService $jobApplicationService)
    {
        $this->jobApplicationService = $jobApplicationService;
    }

    public function getAllApplicants()
    {
        try {
            $applicants = $this->jobApplicationService->getAllApplicants();

            return response()->json($applicants, 200);
        } catch (Exception $e) {
            Log::error('An error occurred: ' . $e->getMessage());

            return response()->json(AppConstants::EXCEPTION_ERROR, AppConstants::EXCEPTION_CODE);
        }
    }

    public function getApplicantById($id)
    {
        try {
            $applicant = $this->jobApplicationService->getApplicantById($id);

            return response()->json($applicant, 200);
        } catch (Exception $e) {
            Log::error('An error occurred: ' . $e->getMessage());

            return response()->json(AppConstants::EXCEPTION_ERROR, AppConstants::EXCEPTION_CODE);
        }
    }

    public function saveApplicant(JobApplicationRequest $request)
    {
        try {
            $applicant = $this->jobApplicationService->saveApplicant($request);

            if ($applicant) {

                return response()->json([
                    'success' => true,
                    'message' => AppConstants::APPLICANT_CREATED_MESSAGE,
                    'data' => $applicant
                ], 201);
            } else {
                return $applicant;
            }
        } catch (Exception $e) {
            Log::error('An error occurred: ' . $e->getMessage());

            return response()->json(AppConstants::EXCEPTION_ERROR, AppConstants::EXCEPTION_CODE);
        }
    }

    public function updateApplicantById($id, JobApplicationUpdateRequest $request)
    {
        try {
            $article = $this->jobApplicationService->updateApplicantById($id, $request);

            return response()->json([
                'success' => true,
                'message' => AppConstants::APPLICANT_UPDATED_MESSAGE,
                'data' => $article
            ], 201);
        } catch (Exception $e) {
            Log::error('An error occurred: ' . $e->getMessage());

            return response()->json(AppConstants::EXCEPTION_ERROR, AppConstants::EXCEPTION_CODE);
        }
    }

    public function deleteApplicantById($id)
    {
        try {
            $article = $this->jobApplicationService->deleteApplicantById($id);

            return response()->json([
                'success' => true,
                'message' => AppConstants::APPLICANT_DELETED_MESSAGE,
                'data' => $article
            ], 201);
        } catch (Exception $e) {
            Log::error('An error occurred: ' . $e->getMessage());

            return response()->json(AppConstants::EXCEPTION_ERROR, AppConstants::EXCEPTION_CODE);
        }
    }
}
