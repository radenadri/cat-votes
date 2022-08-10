<?php

namespace App\Admin\Cats\Controllers;

use App\Admin\Cats\Requests\CatRequest;
use Domain\Cats\Actions\CreateCatAction;
use Domain\Cats\Actions\DeleteCatAction;
use Domain\Cats\Actions\UpdateCatAction;
use Domain\Cats\DataTransferObjects\CatData;
use Domain\Cats\Models\Cat;
use Domain\Cats\ViewModel\CatViewModel;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class CatController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        return Inertia::render('Cats/Cat/Index', [
            'cats' => Cat::with('breed', 'owner')->latest()->paginate(10),
        ]);
    }

    public function show()
    {
        //
    }

    public function create()
    {
        $viewModel = new CatViewModel(url: 'cat.store');

        return Inertia::render('Cats/Cat/Form', [
            'method' => 'save',
            'cat' => $viewModel->cat,
            'url' => $viewModel->url,
            'breed' => $viewModel->breed
        ]);
    }

    public function store(CatRequest $request, CreateCatAction $createCatAction)
    {
        $data = CatData::fromRequest($request);

        $createCatAction->execute($data);

        return Redirect::route('cat.index')->with('message', 'Cats saved!');
    }

    public function edit(Cat $cat)
    {
        $viewModel = new CatViewModel(
            cat: $cat,
            url: 'cat.update'
        );

        return Inertia::render('Cats/Cat/Form', [
            'method' => 'edit',
            'cat' => $viewModel->cat,
            'url' => $viewModel->url,
            'breed' => $viewModel->breed
        ]);
    }

    public function update(Cat $cat, CatRequest $request, UpdateCatAction $updateCatAction)
    {
        $validated = CatData::fromRequest($request);

        $updateCatAction->execute($cat, $validated);

        return Redirect::route('cat.index')->with('message', 'Cat updated!');
    }

    public function destroy(Cat $cat, DeleteCatAction $deleteCatAction)
    {
        $deleteCatAction->execute($cat);

        return Redirect::route('cat.index')->with('message', 'Cat deleted!');
    }
}
