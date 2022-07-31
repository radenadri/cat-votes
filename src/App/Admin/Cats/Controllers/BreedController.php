<?php

namespace App\Admin\Cats\Controllers;

use App\Admin\Cats\Requests\BreedRequest;
use Domain\Cats\Actions\CreateBreedAction;
use Domain\Cats\Actions\DeleteBreedAction;
use Domain\Cats\Actions\UpdateBreedAction;
use Domain\Cats\DataTransferObjects\BreedData;
use Domain\Cats\Models\Breed;
use Domain\Cats\ViewModel\BreedViewModel;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class BreedController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        return Inertia::render('Cats/Breed/Index', [
            'breeds' => Breed::latest()->paginate(10)
        ]);
    }

    public function show()
    {
        //
    }

    public function create()
    {
        $viewModel = new BreedViewModel(url: 'breed.store');

        return Inertia::render('Cats/Breed/Form', [
            'method' => 'save',
            'breed' => $viewModel->breed,
            'url' => $viewModel->url,
        ]);
    }

    public function store(BreedRequest $request) : RedirectResponse
    {
        $validated = BreedData::fromRequest($request);

        (new CreateBreedAction($validated))->execute();

        return Redirect::route('breed.index')->with('message', 'Breed saved!');
    }

    public function edit(Breed $breed)
    {
        $viewModel = new BreedViewModel(
            breed: $breed,
            url: 'breed.update'
        );

        return Inertia::render('Cats/Breed/Form', [
            'method' => 'edit',
            'breed' => $viewModel->breed,
            'url' => $viewModel->url,
        ]);
    }

    public function update(Breed $breed, BreedRequest $request)
    {
        $validated = BreedData::fromRequest($request);

        $updateBreed = new UpdateBreedAction(
            breed: $breed,
            breedData: $validated
        );
        $updateBreed->execute();

        return Redirect::route('breed.index')->with('message', 'Breed updated!');
    }

    public function destroy(Breed $breed)
    {
        (new DeleteBreedAction($breed))->execute();

        return Redirect::route('breed.index')->with('message', 'Breed deleted!');
    }
}
