<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateFavouriteAPIRequest;
use App\Http\Requests\API\UpdateFavouriteAPIRequest;
use App\Models\Favourite;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\FavouriteResource;
use Response;

/**
 * Class FavouriteController
 * @package App\Http\Controllers\API
 */

class FavouriteAPIController extends AppBaseController
{
    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/favourites",
     *      summary="Get a listing of the Favourites.",
     *      tags={"Favourite"},
     *      description="Get all Favourites",
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
     *                  @SWG\Items(ref="#/definitions/Favourite")
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
        $query = Favourite::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $favourites = $query->get();

         return $this->sendResponse(
             FavouriteResource::collection($favourites),
             __('messages.retrieved', ['model' => __('models/favourites.plural')])
         );
    }

    /**
     * @param CreateFavouriteAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/favourites",
     *      summary="Store a newly created Favourite in storage",
     *      tags={"Favourite"},
     *      description="Store Favourite",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Favourite that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Favourite")
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
     *                  ref="#/definitions/Favourite"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateFavouriteAPIRequest $request)
    {
        $input = $request->all();

        /** @var Favourite $favourite */
        $favourite = Favourite::create($input);

        return $this->sendResponse(
             new FavouriteResource($favourite),
             __('messages.saved', ['model' => __('models/favourites.singular')])
        );
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/favourites/{id}",
     *      summary="Display the specified Favourite",
     *      tags={"Favourite"},
     *      description="Get Favourite",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Favourite",
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
     *                  ref="#/definitions/Favourite"
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
        /** @var Favourite $favourite */
        $favourite = Favourite::find($id);

        if (empty($favourite)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/favourites.singular')])
            );
        }

        return $this->sendResponse(
            new FavouriteResource($favourite),
            __('messages.retrieved', ['model' => __('models/favourites.singular')])
        );
    }

    /**
     * @param int $id
     * @param UpdateFavouriteAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/favourites/{id}",
     *      summary="Update the specified Favourite in storage",
     *      tags={"Favourite"},
     *      description="Update Favourite",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Favourite",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Favourite that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Favourite")
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
     *                  ref="#/definitions/Favourite"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateFavouriteAPIRequest $request)
    {
        /** @var Favourite $favourite */
        $favourite = Favourite::find($id);

        if (empty($favourite)) {
           return $this->sendError(
               __('messages.not_found', ['model' => __('models/favourites.singular')])
           );
        }

        $favourite->fill($request->all());
        $favourite->save();

        return $this->sendResponse(
             new FavouriteResource($favourite),
             __('messages.updated', ['model' => __('models/favourites.singular')])
        );
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/favourites/{id}",
     *      summary="Remove the specified Favourite from storage",
     *      tags={"Favourite"},
     *      description="Delete Favourite",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Favourite",
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
        /** @var Favourite $favourite */
        $favourite = Favourite::find($id);

        if (empty($favourite)) {
           return $this->sendError(
                 __('messages.not_found', ['model' => __('models/favourites.singular')])
           );
        }

        $favourite->delete();

         return $this->sendResponse(
             $id,
             __('messages.deleted', ['model' => __('models/favourites.singular')])
         );
    }
}
