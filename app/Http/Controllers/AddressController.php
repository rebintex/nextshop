<?php

namespace App\Http\Controllers;

use App\DataTables\AddressDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateAddressRequest;
use App\Http\Requests\UpdateAddressRequest;
use App\Models\Address;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class AddressController extends AppBaseController
{
    /**
     * Display a listing of the Address.
     *
     * @param AddressDataTable $addressDataTable
     *
     * @return Response
     */
    public function index(AddressDataTable $addressDataTable)
    {
        return $addressDataTable->render('admin.addresses.index');
    }

    /**
     * Show the form for creating a new Address.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.addresses.create');
    }

    /**
     * Store a newly created Address in storage.
     *
     * @param CreateAddressRequest $request
     *
     * @return Response
     */
    public function store(CreateAddressRequest $request)
    {
        $input = $request->all();

        /** @var Address $address */
        $address = Address::create($input);

        Flash::success(__('messages.saved', ['model' => __('models/addresses.singular')]));

        return redirect(route('admin.addresses.index'));
    }

    /**
     * Display the specified Address.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Address $address */
        $address = Address::find($id);

        if (empty($address)) {
            Flash::error(__('models/addresses.singular').' '.__('messages.not_found'));

            return redirect(route('admin.addresses.index'));
        }

        return view('admin.addresses.show')->with('address', $address);
    }

    /**
     * Show the form for editing the specified Address.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Address $address */
        $address = Address::find($id);

        if (empty($address)) {
            Flash::error(__('messages.not_found', ['model' => __('models/addresses.singular')]));

            return redirect(route('admin.addresses.index'));
        }

        return view('admin.addresses.edit')->with('address', $address);
    }

    /**
     * Update the specified Address in storage.
     *
     * @param int $id
     * @param UpdateAddressRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAddressRequest $request)
    {
        /** @var Address $address */
        $address = Address::find($id);

        if (empty($address)) {
            Flash::error(__('messages.not_found', ['model' => __('models/addresses.singular')]));

            return redirect(route('admin.addresses.index'));
        }

        $address->fill($request->all());
        $address->save();

        Flash::success(__('messages.updated', ['model' => __('models/addresses.singular')]));

        return redirect(route('admin.addresses.index'));
    }

    /**
     * Remove the specified Address from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Address $address */
        $address = Address::find($id);

        if (empty($address)) {
            Flash::error(__('messages.not_found', ['model' => __('models/addresses.singular')]));

            return redirect(route('admin.addresses.index'));
        }

        $address->delete();

        Flash::success(__('messages.deleted', ['model' => __('models/addresses.singular')]));

        return redirect(route('admin.addresses.index'));
    }
}
