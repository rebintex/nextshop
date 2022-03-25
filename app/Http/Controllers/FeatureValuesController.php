<?php

namespace App\Http\Controllers;

use App\DataTables\FeatureValuesDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateFeatureValuesRequest;
use App\Http\Requests\UpdateFeatureValuesRequest;
use App\Models\FeatureValues;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class FeatureValuesController extends AppBaseController
{
    /**
     * Display a listing of the FeatureValues.
     *
     * @param FeatureValuesDataTable $featureValuesDataTable
     *
     * @return Response
     */
    public function index(FeatureValuesDataTable $featureValuesDataTable)
    {
        return $featureValuesDataTable->render('admin.feature_values.index');
    }

    /**
     * Show the form for creating a new FeatureValues.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.feature_values.create');
    }

    /**
     * Store a newly created FeatureValues in storage.
     *
     * @param CreateFeatureValuesRequest $request
     *
     * @return Response
     */
    public function store(CreateFeatureValuesRequest $request)
    {
        $input = $request->all();

        /** @var FeatureValues $featureValues */
        $featureValues = FeatureValues::create($input);

        Flash::success(__('messages.saved', ['model' => __('models/featureValues.singular')]));

        return redirect(route('admin.featureValues.index'));
    }

    /**
     * Display the specified FeatureValues.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var FeatureValues $featureValues */
        $featureValues = FeatureValues::find($id);

        if (empty($featureValues)) {
            Flash::error(__('models/featureValues.singular').' '.__('messages.not_found'));

            return redirect(route('admin.featureValues.index'));
        }

        return view('admin.feature_values.show')->with('featureValues', $featureValues);
    }

    /**
     * Show the form for editing the specified FeatureValues.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var FeatureValues $featureValues */
        $featureValues = FeatureValues::find($id);

        if (empty($featureValues)) {
            Flash::error(__('messages.not_found', ['model' => __('models/featureValues.singular')]));

            return redirect(route('admin.featureValues.index'));
        }

        return view('admin.feature_values.edit')->with('featureValues', $featureValues);
    }

    /**
     * Update the specified FeatureValues in storage.
     *
     * @param int $id
     * @param UpdateFeatureValuesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFeatureValuesRequest $request)
    {
        /** @var FeatureValues $featureValues */
        $featureValues = FeatureValues::find($id);

        if (empty($featureValues)) {
            Flash::error(__('messages.not_found', ['model' => __('models/featureValues.singular')]));

            return redirect(route('admin.featureValues.index'));
        }

        $featureValues->fill($request->all());
        $featureValues->save();

        Flash::success(__('messages.updated', ['model' => __('models/featureValues.singular')]));

        return redirect(route('admin.featureValues.index'));
    }

    /**
     * Remove the specified FeatureValues from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var FeatureValues $featureValues */
        $featureValues = FeatureValues::find($id);

        if (empty($featureValues)) {
            Flash::error(__('messages.not_found', ['model' => __('models/featureValues.singular')]));

            return redirect(route('admin.featureValues.index'));
        }

        $featureValues->delete();

        Flash::success(__('messages.deleted', ['model' => __('models/featureValues.singular')]));

        return redirect(route('admin.featureValues.index'));
    }
}
