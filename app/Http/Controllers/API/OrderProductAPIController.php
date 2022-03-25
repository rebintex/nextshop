<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateOrderProductAPIRequest;
use App\Http\Requests\API\UpdateOrderProductAPIRequest;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\OrderProductResource;
use Response;

/**
 * Class OrderProductController
 * @package App\Http\Controllers\API
 */

class OrderProductAPIController extends AppBaseController
{
    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/orderProducts",
     *      summary="Get a listing of the OrderProducts.",
     *      tags={"OrderProduct"},
     *      description="Get all OrderProducts",
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
     *                  @SWG\Items(ref="#/definitions/OrderProduct")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $query = OrderProduct::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $orderProducts = $query->get();

         return $this->sendResponse(
             OrderProductResource::collection($orderProducts),
             __('messages.retrieved', ['model' => __('models/orderProducts.plural')])
         );
    }

    /**
     * @param CreateOrderProductAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/orderProducts",
     *      summary="Store a newly created OrderProduct in storage",
     *      tags={"OrderProduct"},
     *      description="Store OrderProduct",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="OrderProduct that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/OrderProduct")
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
     *                  ref="#/definitions/OrderProduct"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateOrderProductAPIRequest $request)
    {
        $input = $request->all();

        /** @var OrderProduct $orderProduct */
        $orderProduct = OrderProduct::create($input);

        return $this->sendResponse(
             new OrderProductResource($orderProduct),
             __('messages.saved', ['model' => __('models/orderProducts.singular')])
        );
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/orderProducts/{id}",
     *      summary="Display the specified OrderProduct",
     *      tags={"OrderProduct"},
     *      description="Get OrderProduct",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of OrderProduct",
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
     *                  ref="#/definitions/OrderProduct"
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
        /** @var OrderProduct $orderProduct */
        $orderProduct = OrderProduct::find($id);

        if (empty($orderProduct)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/orderProducts.singular')])
            );
        }

        return $this->sendResponse(
            new OrderProductResource($orderProduct),
            __('messages.retrieved', ['model' => __('models/orderProducts.singular')])
        );
    }

    /**
     * @param int $id
     * @param UpdateOrderProductAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/orderProducts/{id}",
     *      summary="Update the specified OrderProduct in storage",
     *      tags={"OrderProduct"},
     *      description="Update OrderProduct",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of OrderProduct",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="OrderProduct that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/OrderProduct")
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
     *                  ref="#/definitions/OrderProduct"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateOrderProductAPIRequest $request)
    {
        /** @var OrderProduct $orderProduct */
        $orderProduct = OrderProduct::find($id);

        if (empty($orderProduct)) {
           return $this->sendError(
               __('messages.not_found', ['model' => __('models/orderProducts.singular')])
           );
        }

        $orderProduct->fill($request->all());
        $orderProduct->save();

        return $this->sendResponse(
             new OrderProductResource($orderProduct),
             __('messages.updated', ['model' => __('models/orderProducts.singular')])
        );
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/orderProducts/{id}",
     *      summary="Remove the specified OrderProduct from storage",
     *      tags={"OrderProduct"},
     *      description="Delete OrderProduct",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of OrderProduct",
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
        /** @var OrderProduct $orderProduct */
        $orderProduct = OrderProduct::find($id);

        if (empty($orderProduct)) {
           return $this->sendError(
                 __('messages.not_found', ['model' => __('models/orderProducts.singular')])
           );
        }

        $orderProduct->delete();

         return $this->sendResponse(
             $id,
             __('messages.deleted', ['model' => __('models/orderProducts.singular')])
         );
    }
}
