<?php

namespace App\Http\Controllers;

use App\DataTables\FeaturesDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateFeaturesRequest;
use App\Http\Requests\UpdateFeaturesRequest;
use App\Models\Features;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class FeaturesController extends AppBaseController
{
    /**
     * Display a listing of the Features.
     *
     * @param FeaturesDataTable $featuresDataTable
     *
     * @return Response
     */
    public function index(FeaturesDataTable $featuresDataTable)
    {
        return $featuresDataTable->render('admin.features.index');
    }

    /**
     * Show the form for creating a new Features.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.features.create');
    }

    /**
     * Store a newly created Features in storage.
     *
     * @param CreateFeaturesRequest $request
     *
     * @return Response
     */
    public function store(CreateFeaturesRequest $request)
    {
        $input = $request->all();

        /** @var Features $features */
        $features = Features::create($input);

        Flash::success(__('messages.saved', ['model' => __('models/features.singular')]));

        return redirect(route('admin.features.index'));
    }

    /**
     * Display the specified Features.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Features $features */
        $features = Features::find($id);

        if (empty($features)) {
            Flash::error(__('models/features.singular').' '.__('messages.not_found'));

            return redirect(route('admin.features.index'));
        }

        return view('admin.features.show')->with('features', $features);
    }

    /**
     * Show the form for editing the specified Features.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Features $features */
        $features = Features::find($id);

        if (empty($features)) {
            Flash::error(__('messages.not_found', ['model' => __('models/features.singular')]));

            return redirect(route('admin.features.index'));
        }

        return view('admin.features.edit')->with('features', $features);
    }

    /**
     * Update the specified Features in storage.
     *
     * @param int $id
     * @param UpdateFeaturesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFeaturesRequest $request)
    {
        /** @var Features $features */
        $features = Features::find($id);

        if (empty($features)) {
            Flash::error(__('messages.not_found', ['model' => __('models/features.singular')]));

            return redirect(route('admin.features.index'));
        }

        $features->fill($request->all());
        $features->save();

        Flash::success(__('messages.updated', ['model' => __('models/features.singular')]));

        return redirect(route('admin.features.index'));
    }

    /**
     * Remove the specified Features from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Features $features */
        $features = Features::find($id);

        if (empty($features)) {
            Flash::error(__('messages.not_found', ['model' => __('models/features.singular')]));

            return redirect(route('admin.features.index'));
        }

        $features->delete();

        Flash::success(__('messages.deleted', ['model' => __('models/features.singular')]));

        return redirect(route('admin.features.index'));
    }
}
