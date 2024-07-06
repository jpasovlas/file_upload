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

    /**
     * @var JobApplicationService $jobApplicationService
     */
    protected $jobApplicationService;

    /**
     * Constructor
     *
     * @param JobApplicationService $jobApplicationService
     */
    public function __construct(JobApplicationService $jobApplicationService)
    {
        $this->jobApplicationService = $jobApplicationService;
    }

    /**
     * Get all applicants
     *
     * @return JsonResponse
     */
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

    /**
     * Get specific applicant by ID
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function getApplicantById(int $id)
    {
        try {
            $applicant = $this->jobApplicationService->getApplicantById($id);

            return response()->json($applicant, 200);
        } catch (Exception $e) {
            Log::error('An error occurred: ' . $e->getMessage());

            return response()->json(AppConstants::EXCEPTION_ERROR, AppConstants::EXCEPTION_CODE);
        }
    }

    /**
     * Create new applicant
     *
     * @param JobApplicationRequest $request
     *
     * @return JsonResponse
     */
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

    /**
     * Update specific applicant by ID
     *
     * @param int $id
     * @param JobApplicationUpdateRequest $request
     *
     * @return JsonResponse
     */
    public function updateApplicantById(int $id, JobApplicationUpdateRequest $request)
    {
        try {
            $applicant = $this->jobApplicationService->updateApplicantById($id, $request);

            return response()->json([
                'success' => true,
                'message' => AppConstants::APPLICANT_UPDATED_MESSAGE,
                'data' => $applicant
            ], 201);
        } catch (Exception $e) {
            Log::error('An error occurred: ' . $e->getMessage());

            return response()->json(AppConstants::EXCEPTION_ERROR, AppConstants::EXCEPTION_CODE);
        }
    }

    /**
     * Delete specific applicant by ID
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function deleteApplicantById(int $id)
    {
        try {
            $applicant = $this->jobApplicationService->deleteApplicantById($id);

            return response()->json([
                'success' => true,
                'message' => AppConstants::APPLICANT_DELETED_MESSAGE,
                'data' => $applicant
            ], 201);
        } catch (Exception $e) {
            Log::error('An error occurred: ' . $e->getMessage());

            return response()->json(AppConstants::EXCEPTION_ERROR, AppConstants::EXCEPTION_CODE);
        }
    }
}
