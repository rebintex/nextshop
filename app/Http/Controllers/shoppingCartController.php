<?php

namespace App\Http\Controllers;

use App\DataTables\shoppingCartDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateshoppingCartRequest;
use App\Http\Requests\UpdateshoppingCartRequest;
use App\Models\ShoppingCart;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class shoppingCartController extends AppBaseController
{
    /**
     * Display a listing of the ShoppingCart.
     *
     * @param shoppingCartDataTable $shoppingCartDataTable
     *
     * @return Response
     */
    public function index(shoppingCartDataTable $shoppingCartDataTable)
    {
        return $shoppingCartDataTable->render('admin.shopping_carts.index');
    }

    /**
     * Show the form for creating a new ShoppingCart.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.shopping_carts.create');
    }

    /**
     * Store a newly created ShoppingCart in storage.
     *
     * @param CreateshoppingCartRequest $request
     *
     * @return Response
     */
    public function store(CreateshoppingCartRequest $request)
    {
        $input = $request->all();

        /** @var ShoppingCart $shoppingCart */
        $shoppingCart = ShoppingCart::create($input);

        Flash::success(__('messages.saved', ['model' => __('models/shoppingCarts.singular')]));

        return redirect(route('admin.shoppingCarts.index'));
    }

    /**
     * Display the specified ShoppingCart.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var ShoppingCart $shoppingCart */
        $shoppingCart = ShoppingCart::find($id);

        if (empty($shoppingCart)) {
            Flash::error(__('models/shoppingCarts.singular').' '.__('messages.not_found'));

            return redirect(route('admin.shoppingCarts.index'));
        }

        return view('admin.shopping_carts.show')->with('ShoppingCart', $shoppingCart);
    }

    /**
     * Show the form for editing the specified ShoppingCart.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var ShoppingCart $shoppingCart */
        $shoppingCart = ShoppingCart::find($id);

        if (empty($shoppingCart)) {
            Flash::error(__('messages.not_found', ['model' => __('models/shoppingCarts.singular')]));

            return redirect(route('admin.shoppingCarts.index'));
        }

        return view('admin.shopping_carts.edit')->with('ShoppingCart', $shoppingCart);
    }

    /**
     * Update the specified ShoppingCart in storage.
     *
     * @param int $id
     * @param UpdateshoppingCartRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateshoppingCartRequest $request)
    {
        /** @var ShoppingCart $shoppingCart */
        $shoppingCart = ShoppingCart::find($id);

        if (empty($shoppingCart)) {
            Flash::error(__('messages.not_found', ['model' => __('models/shoppingCarts.singular')]));

            return redirect(route('admin.shoppingCarts.index'));
        }

        $shoppingCart->fill($request->all());
        $shoppingCart->save();

        Flash::success(__('messages.updated', ['model' => __('models/shoppingCarts.singular')]));

        return redirect(route('admin.shoppingCarts.index'));
    }

    /**
     * Remove the specified ShoppingCart from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var ShoppingCart $shoppingCart */
        $shoppingCart = ShoppingCart::find($id);

        if (empty($shoppingCart)) {
            Flash::error(__('messages.not_found', ['model' => __('models/shoppingCarts.singular')]));

            return redirect(route('admin.shoppingCarts.index'));
        }

        $shoppingCart->delete();

        Flash::success(__('messages.deleted', ['model' => __('models/shoppingCarts.singular')]));

        return redirect(route('admin.shoppingCarts.index'));
    }
}
