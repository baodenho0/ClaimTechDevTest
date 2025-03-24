<?php

namespace App\Modules\Claim\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Claim\Services\ClaimService;
use Illuminate\Validation\ValidationException;

class ClaimController extends Controller
{
    private $claimService;

    public function __construct(ClaimService $claimService)
    {
        $this->claimService = $claimService;
    }

    public function index(Request $request)
    {
        $query = $this->claimService->index();
        if ($query) {
            return $this->getResponseJson(self::SUCCESS, $query);
        } else {
            return $this->getResponseJson(self::ERROR, $this->setMessage('something went wrong!'));
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'lender' => 'required|in:vw_finance,bmw_finance,first_response,gmac,jeep,marsh_finance',
            ]);

        } catch (ValidationException $e) {
            return $this->getResponseJson(self::ERROR, ['errors' => $e->errors()]);
        }

        $query = $this->claimService->handleClaimDetails($request);
        if ($query) {
            return $this->getResponseJson(self::SUCCESS, $query);
        } else {
            return $this->getResponseJson(self::ERROR, $this->setMessage('something went wrong!'));
        }
    }

}
