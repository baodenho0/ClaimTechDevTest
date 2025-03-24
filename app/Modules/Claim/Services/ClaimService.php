<?php

namespace App\Modules\Claim\Services;


use App\Http\Services\BaseService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use App\Modules\Claim\Repositories\ClaimRepositoryInterface;


class ClaimService extends BaseService
{
    private $claimRepository;

    public function __construct(
        ClaimRepositoryInterface $claimRepository,
    ) {
        $this->claimRepository = $claimRepository;
    }

    public function handleClaimDetails($request)
    {
        $claim = $this->claimRepository->create([
            'user_id' => auth()->id(),
            'lender' => $request->lender,
        ]);
        $claim->refresh();
        $response = Http::post('https://postman-echo.com/post', [
            'claim_id' => $claim->id,
            'user_id' => auth()->id(),
            'lender' => $request->lender,
            'status' => $claim->status,
        ]);

        $claim->update(['api_response' => $response->json()]);
        return $claim;
    }

}
