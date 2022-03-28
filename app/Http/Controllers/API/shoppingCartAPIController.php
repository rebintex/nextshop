<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateshoppingCartAPIRequest;
use App\Http\Requests\API\UpdateshoppingCartAPIRequest;
use App\Models\ShoppingCart;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\shoppingCartResource;
use Response;

/**
 * Class shoppingCartController
 * @package App\Http\Controllers\API
 */

class shoppingCartAPIController extends AppBaseController
{
    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/shoppingCarts",
     *      summary="Get a listing of the shoppingCarts.",
     *      tags={"ShoppingCart"},
     *      description="Get all shoppingCarts",
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
     *                  @SWG\Items(ref="#/definitions/ShoppingCart")
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
        $query = ShoppingCart::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $shoppingCarts = $query->get();

         return $this->sendResponse(
             shoppingCartResource::collection($shoppingCarts),
             __('messages.retrieved', ['model' => __('models/shoppingCarts.plural')])
         );
    }

    /**
     * @param CreateshoppingCartAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/shoppingCarts",
     *      summary="Store a newly created ShoppingCart in storage",
     *      tags={"ShoppingCart"},
     *      description="Store ShoppingCart",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="ShoppingCart that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/ShoppingCart")
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
     *                  ref="#/definitions/ShoppingCart"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateshoppingCartAPIRequest $request)
    {
        $input = $request->all();

        /** @var ShoppingCart $shoppingCart */
        $shoppingCart = ShoppingCart::create($input);

        return $this->sendResponse(
             new shoppingCartResource($shoppingCart),
             __('messages.saved', ['model' => __('models/shoppingCarts.singular')])
        );
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/shoppingCarts/{id}",
     *      summary="Display the specified ShoppingCart",
     *      tags={"ShoppingCart"},
     *      description="Get ShoppingCart",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of ShoppingCart",
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
     *                  ref="#/definitions/ShoppingCart"
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
        /** @var ShoppingCart $shoppingCart */
        $shoppingCart = ShoppingCart::find($id);

        if (empty($shoppingCart)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/shoppingCarts.singular')])
            );
        }

        return $this->sendResponse(
            new shoppingCartResource($shoppingCart),
            __('messages.retrieved', ['model' => __('models/shoppingCarts.singular')])
        );
    }

    /**
     * @param int $id
     * @param UpdateshoppingCartAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/shoppingCarts/{id}",
     *      summary="Update the specified ShoppingCart in storage",
     *      tags={"ShoppingCart"},
     *      description="Update ShoppingCart",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of ShoppingCart",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="ShoppingCart that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/ShoppingCart")
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
     *                  ref="#/definitions/ShoppingCart"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateshoppingCartAPIRequest $request)
    {
        /** @var ShoppingCart $shoppingCart */
        $shoppingCart = ShoppingCart::find($id);

        if (empty($shoppingCart)) {
           return $this->sendError(
               __('messages.not_found', ['model' => __('models/shoppingCarts.singular')])
           );
        }

        $shoppingCart->fill($request->all());
        $shoppingCart->save();

        return $this->sendResponse(
             new shoppingCartResource($shoppingCart),
             __('messages.updated', ['model' => __('models/shoppingCarts.singular')])
        );
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/shoppingCarts/{id}",
     *      summary="Remove the specified ShoppingCart from storage",
     *      tags={"ShoppingCart"},
     *      description="Delete ShoppingCart",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of ShoppingCart",
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
        /** @var ShoppingCart $shoppingCart */
        $shoppingCart = ShoppingCart::find($id);

        if (empty($shoppingCart)) {
           return $this->sendError(
                 __('messages.not_found', ['model' => __('models/shoppingCarts.singular')])
           );
        }

        $shoppingCart->delete();

         return $this->sendResponse(
             $id,
             __('messages.deleted', ['model' => __('models/shoppingCarts.singular')])
         );
    }
}
