<?php

namespace App\Http\Controllers;

use App\DataTables\CouponDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateCouponRequest;
use App\Http\Requests\UpdateCouponRequest;
use App\Models\Coupon;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class CouponController extends AppBaseController
{
    /**
     * Display a listing of the Coupon.
     *
     * @param CouponDataTable $couponDataTable
     *
     * @return Response
     */
    public function index(CouponDataTable $couponDataTable)
    {
        return $couponDataTable->render('admin.coupons.index');
    }

    /**
     * Show the form for creating a new Coupon.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.coupons.create');
    }

    /**
     * Store a newly created Coupon in storage.
     *
     * @param CreateCouponRequest $request
     *
     * @return Response
     */
    public function store(CreateCouponRequest $request)
    {
        $input = $request->all();

        /** @var Coupon $coupon */
        $coupon = Coupon::create($input);

        Flash::success(__('messages.saved', ['model' => __('models/coupons.singular')]));

        return redirect(route('admin.coupons.index'));
    }

    /**
     * Display the specified Coupon.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Coupon $coupon */
        $coupon = Coupon::find($id);

        if (empty($coupon)) {
            Flash::error(__('models/coupons.singular').' '.__('messages.not_found'));

            return redirect(route('admin.coupons.index'));
        }

        return view('admin.coupons.show')->with('coupon', $coupon);
    }

    /**
     * Show the form for editing the specified Coupon.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Coupon $coupon */
        $coupon = Coupon::find($id);

        if (empty($coupon)) {
            Flash::error(__('messages.not_found', ['model' => __('models/coupons.singular')]));

            return redirect(route('admin.coupons.index'));
        }

        return view('admin.coupons.edit')->with('coupon', $coupon);
    }

    /**
     * Update the specified Coupon in storage.
     *
     * @param int $id
     * @param UpdateCouponRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCouponRequest $request)
    {
        /** @var Coupon $coupon */
        $coupon = Coupon::find($id);

        if (empty($coupon)) {
            Flash::error(__('messages.not_found', ['model' => __('models/coupons.singular')]));

            return redirect(route('admin.coupons.index'));
        }

        $coupon->fill($request->all());
        $coupon->save();

        Flash::success(__('messages.updated', ['model' => __('models/coupons.singular')]));

        return redirect(route('admin.coupons.index'));
    }

    /**
     * Remove the specified Coupon from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Coupon $coupon */
        $coupon = Coupon::find($id);

        if (empty($coupon)) {
            Flash::error(__('messages.not_found', ['model' => __('models/coupons.singular')]));

            return redirect(route('admin.coupons.index'));
        }

        $coupon->delete();

        Flash::success(__('messages.deleted', ['model' => __('models/coupons.singular')]));

        return redirect(route('admin.coupons.index'));
    }
}
