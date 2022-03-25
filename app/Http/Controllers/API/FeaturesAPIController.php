<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateFeaturesAPIRequest;
use App\Http\Requests\API\UpdateFeaturesAPIRequest;
use App\Models\Features;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\FeaturesResource;
use Response;

/**
 * Class FeaturesController
 * @package App\Http\Controllers\API
 */

class FeaturesAPIController extends AppBaseController
{
    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/features",
     *      summary="Get a listing of the Features.",
     *      tags={"Features"},
     *      description="Get all Features",
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
     *                  @SWG\Items(ref="#/definitions/Features")
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
        $query = Features::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $features = $query->get();

         return $this->sendResponse(
             FeaturesResource::collection($features),
             __('messages.retrieved', ['model' => __('models/features.plural')])
         );
    }

    /**
     * @param CreateFeaturesAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/features",
     *      summary="Store a newly created Features in storage",
     *      tags={"Features"},
     *      description="Store Features",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Features that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Features")
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
     *                  ref="#/definitions/Features"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateFeaturesAPIRequest $request)
    {
        $input = $request->all();

        /** @var Features $features */
        $features = Features::create($input);

        return $this->sendResponse(
             new FeaturesResource($features),
             __('messages.saved', ['model' => __('models/features.singular')])
        );
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/features/{id}",
     *      summary="Display the specified Features",
     *      tags={"Features"},
     *      description="Get Features",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Features",
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
     *                  ref="#/definitions/Features"
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
        /** @var Features $features */
        $features = Features::find($id);

        if (empty($features)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/features.singular')])
            );
        }

        return $this->sendResponse(
            new FeaturesResource($features),
            __('messages.retrieved', ['model' => __('models/features.singular')])
        );
    }

    /**
     * @param int $id
     * @param UpdateFeaturesAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/features/{id}",
     *      summary="Update the specified Features in storage",
     *      tags={"Features"},
     *      description="Update Features",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Features",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Features that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Features")
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
     *                  ref="#/definitions/Features"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateFeaturesAPIRequest $request)
    {
        /** @var Features $features */
        $features = Features::find($id);

        if (empty($features)) {
           return $this->sendError(
               __('messages.not_found', ['model' => __('models/features.singular')])
           );
        }

        $features->fill($request->all());
        $features->save();

        return $this->sendResponse(
             new FeaturesResource($features),
             __('messages.updated', ['model' => __('models/features.singular')])
        );
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/features/{id}",
     *      summary="Remove the specified Features from storage",
     *      tags={"Features"},
     *      description="Delete Features",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Features",
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
        /** @var Features $features */
        $features = Features::find($id);

        if (empty($features)) {
           return $this->sendError(
                 __('messages.not_found', ['model' => __('models/features.singular')])
           );
        }

        $features->delete();

         return $this->sendResponse(
             $id,
             __('messages.deleted', ['model' => __('models/features.singular')])
         );
    }
}
