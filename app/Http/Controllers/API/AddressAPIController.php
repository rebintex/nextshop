<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateAddressAPIRequest;
use App\Http\Requests\API\UpdateAddressAPIRequest;
use App\Models\Address;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\AddressResource;
use Response;

/**
 * Class AddressController
 * @package App\Http\Controllers\API
 */

class AddressAPIController extends AppBaseController
{
    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/addresses",
     *      summary="Get a listing of the Addresses.",
     *      tags={"Address"},
     *      description="Get all Addresses",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/Address")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request) : JsonResponse
    {
        $query = Address::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $addresses = $query->get();

        return response()->json(Address::all());

         return $this->sendResponse(
             AddressResource::collection($addresses),
             __('messages.retrieved', ['model' => __('models/addresses.plural')])
         );
    }

    /**
     * @param CreateAddressAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/addresses",
     *      summary="Store a newly created Address in storage",
     *      tags={"Address"},
     *      description="Store Address",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Address that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Address")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Address"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateAddressAPIRequest $request)
    {
        $input = $request->all();

        /** @var Address $address */
        $address = Address::create($input);

        return response()->json(Adress::all());

        return $this->sendResponse(
             new AddressResource($address),
             __('messages.saved', ['model' => __('models/addresses.singular')])
        );
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/addresses/{id}",
     *      summary="Display the specified Address",
     *      tags={"Address"},
     *      description="Get Address",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Address",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Address"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var Address $address */
        $address = Address::find($id);

        if (empty($address)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/addresses.singular')])
            );
        }

        return $this->sendResponse(
            new AddressResource($address),
            __('messages.retrieved', ['model' => __('models/addresses.singular')])
        );
    }

    /**
     * @param int $id
     * @param UpdateAddressAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/addresses/{id}",
     *      summary="Update the specified Address in storage",
     *      tags={"Address"},
     *      description="Update Address",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Address",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Address that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Address")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Address"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateAddressAPIRequest $request)
    {
        /** @var Address $address */
        $address = Address::find($id);

        if (empty($address)) {
           return $this->sendError(
               __('messages.not_found', ['model' => __('models/addresses.singular')])
           );
        }

        $address->fill($request->all());
        $address->save();

        return $this->sendResponse(
             new AddressResource($address),
             __('messages.updated', ['model' => __('models/addresses.singular')])
        );
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/addresses/{id}",
     *      summary="Remove the specified Address from storage",
     *      tags={"Address"},
     *      description="Delete Address",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Address",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var Address $address */
        $address = Address::find($id);

        if (empty($address)) {
           return $this->sendError(
                 __('messages.not_found', ['model' => __('models/addresses.singular')])
           );
        }

        $address->delete();

         return $this->sendResponse(
             $id,
             __('messages.deleted', ['model' => __('models/addresses.singular')])
         );
    }
}
