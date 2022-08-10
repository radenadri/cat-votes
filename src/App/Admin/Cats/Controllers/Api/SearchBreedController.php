<?php

namespace App\Admin\Cats\Controllers\Api;

use App\Admin\Cats\Resources\BreedResource;
use Domain\Cats\Models\Breed;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class SearchBreedController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __invoke(Request $request)
    {
        $searchedBreed = Breed::query()
                            ->when($request->has('q'), function ($query) use ($request) {
                                $query->where('name', 'LIKE', "%{$request->get('q')}%");
                            })
                            ->take(3)
                            ->get();

        return response()->json([
            'success' => 'ok',
            'message' => 'Breed successfuly retrieved!',
            'data' => $searchedBreed->map(function($data) {
                return new BreedResource($data);
            })
        ]);
    }
}
