<?php

namespace App\Http\Controllers;

use App\DataTables\BrandDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Models\Brand;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class BrandController extends AppBaseController
{
    /**
     * Display a listing of the Brand.
     *
     * @param BrandDataTable $brandDataTable
     *
     * @return Response
     */
    public function index(BrandDataTable $brandDataTable)
    {
        return $brandDataTable->render('admin.brands.index');
    }

    /**
     * Show the form for creating a new Brand.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.brands.create');
    }

    /**
     * Store a newly created Brand in storage.
     *
     * @param CreateBrandRequest $request
     *
     * @return Response
     */
    public function store(CreateBrandRequest $request)
    {
        $input = $request->all();

        /** @var Brand $brand */
        $brand = Brand::create($input);

        Flash::success(__('messages.saved', ['model' => __('models/brands.singular')]));

        return redirect(route('admin.brands.index'));
    }

    /**
     * Display the specified Brand.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Brand $brand */
        $brand = Brand::find($id);

        if (empty($brand)) {
            Flash::error(__('models/brands.singular').' '.__('messages.not_found'));

            return redirect(route('admin.brands.index'));
        }

        return view('admin.brands.show')->with('brand', $brand);
    }

    /**
     * Show the form for editing the specified Brand.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Brand $brand */
        $brand = Brand::find($id);

        if (empty($brand)) {
            Flash::error(__('messages.not_found', ['model' => __('models/brands.singular')]));

            return redirect(route('admin.brands.index'));
        }

        return view('admin.brands.edit')->with('brand', $brand);
    }

    /**
     * Update the specified Brand in storage.
     *
     * @param int $id
     * @param UpdateBrandRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBrandRequest $request)
    {
        /** @var Brand $brand */
        $brand = Brand::find($id);

        if (empty($brand)) {
            Flash::error(__('messages.not_found', ['model' => __('models/brands.singular')]));

            return redirect(route('admin.brands.index'));
        }

        $brand->fill($request->all());
        $brand->save();

        Flash::success(__('messages.updated', ['model' => __('models/brands.singular')]));

        return redirect(route('admin.brands.index'));
    }

    /**
     * Remove the specified Brand from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Brand $brand */
        $brand = Brand::find($id);

        if (empty($brand)) {
            Flash::error(__('messages.not_found', ['model' => __('models/brands.singular')]));

            return redirect(route('admin.brands.index'));
        }

        $brand->delete();

        Flash::success(__('messages.deleted', ['model' => __('models/brands.singular')]));

        return redirect(route('admin.brands.index'));
    }
}
