<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateFeatureValuesAPIRequest;
use App\Http\Requests\API\UpdateFeatureValuesAPIRequest;
use App\Models\FeatureValues;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\FeatureValuesResource;
use Response;

/**
 * Class FeatureValuesController
 * @package App\Http\Controllers\API
 */

class FeatureValuesAPIController extends AppBaseController
{
    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/featureValues",
     *      summary="Get a listing of the FeatureValues.",
     *      tags={"FeatureValues"},
     *      description="Get all FeatureValues",
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
     *                  @SWG\Items(ref="#/definitions/FeatureValues")
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
        $query = FeatureValues::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $featureValues = $query->get();

         return $this->sendResponse(
             FeatureValuesResource::collection($featureValues),
             __('messages.retrieved', ['model' => __('models/featureValues.plural')])
         );
    }

    /**
     * @param CreateFeatureValuesAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/featureValues",
     *      summary="Store a newly created FeatureValues in storage",
     *      tags={"FeatureValues"},
     *      description="Store FeatureValues",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="FeatureValues that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/FeatureValues")
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
     *                  ref="#/definitions/FeatureValues"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateFeatureValuesAPIRequest $request)
    {
        $input = $request->all();

        /** @var FeatureValues $featureValues */
        $featureValues = FeatureValues::create($input);

        return $this->sendResponse(
             new FeatureValuesResource($featureValues),
             __('messages.saved', ['model' => __('models/featureValues.singular')])
        );
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/featureValues/{id}",
     *      summary="Display the specified FeatureValues",
     *      tags={"FeatureValues"},
     *      description="Get FeatureValues",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of FeatureValues",
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
     *                  ref="#/definitions/FeatureValues"
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
        /** @var FeatureValues $featureValues */
        $featureValues = FeatureValues::find($id);

        if (empty($featureValues)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/featureValues.singular')])
            );
        }

        return $this->sendResponse(
            new FeatureValuesResource($featureValues),
            __('messages.retrieved', ['model' => __('models/featureValues.singular')])
        );
    }

    /**
     * @param int $id
     * @param UpdateFeatureValuesAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/featureValues/{id}",
     *      summary="Update the specified FeatureValues in storage",
     *      tags={"FeatureValues"},
     *      description="Update FeatureValues",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of FeatureValues",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="FeatureValues that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/FeatureValues")
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
     *                  ref="#/definitions/FeatureValues"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateFeatureValuesAPIRequest $request)
    {
        /** @var FeatureValues $featureValues */
        $featureValues = FeatureValues::find($id);

        if (empty($featureValues)) {
           return $this->sendError(
               __('messages.not_found', ['model' => __('models/featureValues.singular')])
           );
        }

        $featureValues->fill($request->all());
        $featureValues->save();

        return $this->sendResponse(
             new FeatureValuesResource($featureValues),
             __('messages.updated', ['model' => __('models/featureValues.singular')])
        );
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/featureValues/{id}",
     *      summary="Remove the specified FeatureValues from storage",
     *      tags={"FeatureValues"},
     *      description="Delete FeatureValues",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of FeatureValues",
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
        /** @var FeatureValues $featureValues */
        $featureValues = FeatureValues::find($id);

        if (empty($featureValues)) {
           return $this->sendError(
                 __('messages.not_found', ['model' => __('models/featureValues.singular')])
           );
        }

        $featureValues->delete();

         return $this->sendResponse(
             $id,
             __('messages.deleted', ['model' => __('models/featureValues.singular')])
         );
    }
}
