<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateBrandAPIRequest;
use App\Http\Requests\API\UpdateBrandAPIRequest;
use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\BrandResource;
use Response;

/**
 * Class BrandController
 * @package App\Http\Controllers\API
 */

class BrandAPIController extends AppBaseController
{
    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/brands",
     *      summary="Get a listing of the Brands.",
     *      tags={"Brand"},
     *      description="Get all Brands",
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
     *                  @SWG\Items(ref="#/definitions/Brand")
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
        $query = Brand::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $brands = $query->get();

         return $this->sendResponse(
             BrandResource::collection($brands),
             __('messages.retrieved', ['model' => __('models/brands.plural')])
         );
    }

    /**
     * @param CreateBrandAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/brands",
     *      summary="Store a newly created Brand in storage",
     *      tags={"Brand"},
     *      description="Store Brand",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Brand that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Brand")
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
     *                  ref="#/definitions/Brand"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateBrandAPIRequest $request)
    {
        $input = $request->all();

        /** @var Brand $brand */
        $brand = Brand::create($input);

        return $this->sendResponse(
             new BrandResource($brand),
             __('messages.saved', ['model' => __('models/brands.singular')])
        );
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/brands/{id}",
     *      summary="Display the specified Brand",
     *      tags={"Brand"},
     *      description="Get Brand",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Brand",
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
     *                  ref="#/definitions/Brand"
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
        /** @var Brand $brand */
        $brand = Brand::find($id);

        if (empty($brand)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/brands.singular')])
            );
        }

        return $this->sendResponse(
            new BrandResource($brand),
            __('messages.retrieved', ['model' => __('models/brands.singular')])
        );
    }

    /**
     * @param int $id
     * @param UpdateBrandAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/brands/{id}",
     *      summary="Update the specified Brand in storage",
     *      tags={"Brand"},
     *      description="Update Brand",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Brand",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Brand that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Brand")
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
     *                  ref="#/definitions/Brand"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateBrandAPIRequest $request)
    {
        /** @var Brand $brand */
        $brand = Brand::find($id);

        if (empty($brand)) {
           return $this->sendError(
               __('messages.not_found', ['model' => __('models/brands.singular')])
           );
        }

        $brand->fill($request->all());
        $brand->save();

        return $this->sendResponse(
             new BrandResource($brand),
             __('messages.updated', ['model' => __('models/brands.singular')])
        );
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/brands/{id}",
     *      summary="Remove the specified Brand from storage",
     *      tags={"Brand"},
     *      description="Delete Brand",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Brand",
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
        /** @var Brand $brand */
        $brand = Brand::find($id);

        if (empty($brand)) {
           return $this->sendError(
                 __('messages.not_found', ['model' => __('models/brands.singular')])
           );
        }

        $brand->delete();

         return $this->sendResponse(
             $id,
             __('messages.deleted', ['model' => __('models/brands.singular')])
         );
    }
}
