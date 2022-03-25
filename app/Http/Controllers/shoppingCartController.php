<?php

namespace App\Http\Controllers;

use App\DataTables\shoppingCartDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateshoppingCartRequest;
use App\Http\Requests\UpdateshoppingCartRequest;
use App\Models\shoppingCart;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class shoppingCartController extends AppBaseController
{
    /**
     * Display a listing of the shoppingCart.
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
     * Show the form for creating a new shoppingCart.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.shopping_carts.create');
    }

    /**
     * Store a newly created shoppingCart in storage.
     *
     * @param CreateshoppingCartRequest $request
     *
     * @return Response
     */
    public function store(CreateshoppingCartRequest $request)
    {
        $input = $request->all();

        /** @var shoppingCart $shoppingCart */
        $shoppingCart = shoppingCart::create($input);

        Flash::success(__('messages.saved', ['model' => __('models/shoppingCarts.singular')]));

        return redirect(route('admin.shoppingCarts.index'));
    }

    /**
     * Display the specified shoppingCart.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var shoppingCart $shoppingCart */
        $shoppingCart = shoppingCart::find($id);

        if (empty($shoppingCart)) {
            Flash::error(__('models/shoppingCarts.singular').' '.__('messages.not_found'));

            return redirect(route('admin.shoppingCarts.index'));
        }

        return view('admin.shopping_carts.show')->with('shoppingCart', $shoppingCart);
    }

    /**
     * Show the form for editing the specified shoppingCart.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var shoppingCart $shoppingCart */
        $shoppingCart = shoppingCart::find($id);

        if (empty($shoppingCart)) {
            Flash::error(__('messages.not_found', ['model' => __('models/shoppingCarts.singular')]));

            return redirect(route('admin.shoppingCarts.index'));
        }

        return view('admin.shopping_carts.edit')->with('shoppingCart', $shoppingCart);
    }

    /**
     * Update the specified shoppingCart in storage.
     *
     * @param int $id
     * @param UpdateshoppingCartRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateshoppingCartRequest $request)
    {
        /** @var shoppingCart $shoppingCart */
        $shoppingCart = shoppingCart::find($id);

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
     * Remove the specified shoppingCart from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var shoppingCart $shoppingCart */
        $shoppingCart = shoppingCart::find($id);

        if (empty($shoppingCart)) {
            Flash::error(__('messages.not_found', ['model' => __('models/shoppingCarts.singular')]));

            return redirect(route('admin.shoppingCarts.index'));
        }

        $shoppingCart->delete();

        Flash::success(__('messages.deleted', ['model' => __('models/shoppingCarts.singular')]));

        return redirect(route('admin.shoppingCarts.index'));
    }
}
