<?php

namespace App\Http\Controllers\Repository;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;

class JobApplicationRepository extends Controller
{

    /**
     * Get all applicants
     *
     * @param int $id
     *
     * @return mixed
     */
    public function getAllApplicants()
    {
        $applicants = JobApplication::get();

        return $applicants;
    }

    /**
     * Get applicant by ID
     *
     * @param int $id
     *
     * @return mixed
     */
    public function getApplicantById($id)
    {
        $applicant = JobApplication::findOrFail($id);

        return $applicant;
    }

    /**
     * Create new applicant
     *
     * @param array $data
     *
     * @return object
     */
    public function saveApplicant($data)
    {
        $applicant = JobApplication::create($data);

        return $applicant;
    }

    /**
     * Update applicant by ID
     *
     * @param int $id
     * @param array $data
     *
     * @return mixed
     */
    public function updateApplicantById($id, $data)
    {
        $applicant = JobApplication::where('id', $id)->update($data);

        return $applicant;
    }

    /**
     * Delete applicant by ID
     *
     * @param int $id
     *
     * @return mixed
     */
    public function deleteApplicantById($id)
    {
        $applicant = JobApplication::where('id', $id)->delete();

        return $applicant;
    }
}
