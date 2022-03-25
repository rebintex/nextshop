<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateshoppingCartAPIRequest;
use App\Http\Requests\API\UpdateshoppingCartAPIRequest;
use App\Models\shoppingCart;
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
     *      tags={"shoppingCart"},
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
     *                  @SWG\Items(ref="#/definitions/shoppingCart")
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
        $query = shoppingCart::query();

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
     *      summary="Store a newly created shoppingCart in storage",
     *      tags={"shoppingCart"},
     *      description="Store shoppingCart",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="shoppingCart that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/shoppingCart")
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
     *                  ref="#/definitions/shoppingCart"
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

        /** @var shoppingCart $shoppingCart */
        $shoppingCart = shoppingCart::create($input);

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
     *      summary="Display the specified shoppingCart",
     *      tags={"shoppingCart"},
     *      description="Get shoppingCart",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of shoppingCart",
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
     *                  ref="#/definitions/shoppingCart"
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
        /** @var shoppingCart $shoppingCart */
        $shoppingCart = shoppingCart::find($id);

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
     *      summary="Update the specified shoppingCart in storage",
     *      tags={"shoppingCart"},
     *      description="Update shoppingCart",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of shoppingCart",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="shoppingCart that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/shoppingCart")
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
     *                  ref="#/definitions/shoppingCart"
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
        /** @var shoppingCart $shoppingCart */
        $shoppingCart = shoppingCart::find($id);

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
     *      summary="Remove the specified shoppingCart from storage",
     *      tags={"shoppingCart"},
     *      description="Delete shoppingCart",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of shoppingCart",
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
        /** @var shoppingCart $shoppingCart */
        $shoppingCart = shoppingCart::find($id);

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
