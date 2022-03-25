<?php

namespace App\Http\Controllers;

use App\DataTables\OrderProductDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateOrderProductRequest;
use App\Http\Requests\UpdateOrderProductRequest;
use App\Models\OrderProduct;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class OrderProductController extends AppBaseController
{
    /**
     * Display a listing of the OrderProduct.
     *
     * @param OrderProductDataTable $orderProductDataTable
     *
     * @return Response
     */
    public function index(OrderProductDataTable $orderProductDataTable)
    {
        return $orderProductDataTable->render('admin.order_products.index');
    }

    /**
     * Show the form for creating a new OrderProduct.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.order_products.create');
    }

    /**
     * Store a newly created OrderProduct in storage.
     *
     * @param CreateOrderProductRequest $request
     *
     * @return Response
     */
    public function store(CreateOrderProductRequest $request)
    {
        $input = $request->all();

        /** @var OrderProduct $orderProduct */
        $orderProduct = OrderProduct::create($input);

        Flash::success(__('messages.saved', ['model' => __('models/orderProducts.singular')]));

        return redirect(route('admin.orderProducts.index'));
    }

    /**
     * Display the specified OrderProduct.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var OrderProduct $orderProduct */
        $orderProduct = OrderProduct::find($id);

        if (empty($orderProduct)) {
            Flash::error(__('models/orderProducts.singular').' '.__('messages.not_found'));

            return redirect(route('admin.orderProducts.index'));
        }

        return view('admin.order_products.show')->with('orderProduct', $orderProduct);
    }

    /**
     * Show the form for editing the specified OrderProduct.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var OrderProduct $orderProduct */
        $orderProduct = OrderProduct::find($id);

        if (empty($orderProduct)) {
            Flash::error(__('messages.not_found', ['model' => __('models/orderProducts.singular')]));

            return redirect(route('admin.orderProducts.index'));
        }

        return view('admin.order_products.edit')->with('orderProduct', $orderProduct);
    }

    /**
     * Update the specified OrderProduct in storage.
     *
     * @param int $id
     * @param UpdateOrderProductRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOrderProductRequest $request)
    {
        /** @var OrderProduct $orderProduct */
        $orderProduct = OrderProduct::find($id);

        if (empty($orderProduct)) {
            Flash::error(__('messages.not_found', ['model' => __('models/orderProducts.singular')]));

            return redirect(route('admin.orderProducts.index'));
        }

        $orderProduct->fill($request->all());
        $orderProduct->save();

        Flash::success(__('messages.updated', ['model' => __('models/orderProducts.singular')]));

        return redirect(route('admin.orderProducts.index'));
    }

    /**
     * Remove the specified OrderProduct from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var OrderProduct $orderProduct */
        $orderProduct = OrderProduct::find($id);

        if (empty($orderProduct)) {
            Flash::error(__('messages.not_found', ['model' => __('models/orderProducts.singular')]));

            return redirect(route('admin.orderProducts.index'));
        }

        $orderProduct->delete();

        Flash::success(__('messages.deleted', ['model' => __('models/orderProducts.singular')]));

        return redirect(route('admin.orderProducts.index'));
    }
}
