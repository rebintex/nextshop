<?php

namespace App\Http\Controllers;

use App\DataTables\FavouriteDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateFavouriteRequest;
use App\Http\Requests\UpdateFavouriteRequest;
use App\Models\Favourite;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class FavouriteController extends AppBaseController
{
    /**
     * Display a listing of the Favourite.
     *
     * @param FavouriteDataTable $favouriteDataTable
     *
     * @return Response
     */
    public function index(FavouriteDataTable $favouriteDataTable)
    {
        return $favouriteDataTable->render('admin.favourites.index');
    }

    /**
     * Show the form for creating a new Favourite.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.favourites.create');
    }

    /**
     * Store a newly created Favourite in storage.
     *
     * @param CreateFavouriteRequest $request
     *
     * @return Response
     */
    public function store(CreateFavouriteRequest $request)
    {
        $input = $request->all();

        /** @var Favourite $favourite */
        $favourite = Favourite::create($input);

        Flash::success(__('messages.saved', ['model' => __('models/favourites.singular')]));

        return redirect(route('admin.favourites.index'));
    }

    /**
     * Display the specified Favourite.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Favourite $favourite */
        $favourite = Favourite::find($id);

        if (empty($favourite)) {
            Flash::error(__('models/favourites.singular').' '.__('messages.not_found'));

            return redirect(route('admin.favourites.index'));
        }

        return view('admin.favourites.show')->with('favourite', $favourite);
    }

    /**
     * Show the form for editing the specified Favourite.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Favourite $favourite */
        $favourite = Favourite::find($id);

        if (empty($favourite)) {
            Flash::error(__('messages.not_found', ['model' => __('models/favourites.singular')]));

            return redirect(route('admin.favourites.index'));
        }

        return view('admin.favourites.edit')->with('favourite', $favourite);
    }

    /**
     * Update the specified Favourite in storage.
     *
     * @param int $id
     * @param UpdateFavouriteRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFavouriteRequest $request)
    {
        /** @var Favourite $favourite */
        $favourite = Favourite::find($id);

        if (empty($favourite)) {
            Flash::error(__('messages.not_found', ['model' => __('models/favourites.singular')]));

            return redirect(route('admin.favourites.index'));
        }

        $favourite->fill($request->all());
        $favourite->save();

        Flash::success(__('messages.updated', ['model' => __('models/favourites.singular')]));

        return redirect(route('admin.favourites.index'));
    }

    /**
     * Remove the specified Favourite from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Favourite $favourite */
        $favourite = Favourite::find($id);

        if (empty($favourite)) {
            Flash::error(__('messages.not_found', ['model' => __('models/favourites.singular')]));

            return redirect(route('admin.favourites.index'));
        }

        $favourite->delete();

        Flash::success(__('messages.deleted', ['model' => __('models/favourites.singular')]));

        return redirect(route('admin.favourites.index'));
    }
}
