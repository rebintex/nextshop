<?php

namespace App\Http\Controllers;

use App\DataTables\OrderDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Order;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class OrderController extends AppBaseController
{
    /**
     * Display a listing of the Order.
     *
     * @param OrderDataTable $orderDataTable
     *
     * @return Response
     */
    public function index(OrderDataTable $orderDataTable)
    {
        return $orderDataTable->render('admin.orders.index');
    }

    /**
     * Show the form for creating a new Order.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.orders.create');
    }

    /**
     * Store a newly created Order in storage.
     *
     * @param CreateOrderRequest $request
     *
     * @return Response
     */
    public function store(CreateOrderRequest $request)
    {
        $input = $request->all();

        /** @var Order $order */
        $order = Order::create($input);

        Flash::success(__('messages.saved', ['model' => __('models/orders.singular')]));

        return redirect(route('admin.orders.index'));
    }

    /**
     * Display the specified Order.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Order $order */
        $order = Order::find($id);

        if (empty($order)) {
            Flash::error(__('models/orders.singular').' '.__('messages.not_found'));

            return redirect(route('admin.orders.index'));
        }

        return view('admin.orders.show')->with('order', $order);
    }

    /**
     * Show the form for editing the specified Order.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Order $order */
        $order = Order::find($id);

        if (empty($order)) {
            Flash::error(__('messages.not_found', ['model' => __('models/orders.singular')]));

            return redirect(route('admin.orders.index'));
        }

        return view('admin.orders.edit')->with('order', $order);
    }

    /**
     * Update the specified Order in storage.
     *
     * @param int $id
     * @param UpdateOrderRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOrderRequest $request)
    {
        /** @var Order $order */
        $order = Order::find($id);

        if (empty($order)) {
            Flash::error(__('messages.not_found', ['model' => __('models/orders.singular')]));

            return redirect(route('admin.orders.index'));
        }

        $order->fill($request->all());
        $order->save();

        Flash::success(__('messages.updated', ['model' => __('models/orders.singular')]));

        return redirect(route('admin.orders.index'));
    }

    /**
     * Remove the specified Order from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Order $order */
        $order = Order::find($id);

        if (empty($order)) {
            Flash::error(__('messages.not_found', ['model' => __('models/orders.singular')]));

            return redirect(route('admin.orders.index'));
        }

        $order->delete();

        Flash::success(__('messages.deleted', ['model' => __('models/orders.singular')]));

        return redirect(route('admin.orders.index'));
    }
}
