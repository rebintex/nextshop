<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCouponAPIRequest;
use App\Http\Requests\API\UpdateCouponAPIRequest;
use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\CouponResource;
use Response;

/**
 * Class CouponController
 * @package App\Http\Controllers\API
 */

class CouponAPIController extends AppBaseController
{
    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/coupons",
     *      summary="Get a listing of the Coupons.",
     *      tags={"Coupon"},
     *      description="Get all Coupons",
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
     *                  @SWG\Items(ref="#/definitions/Coupon")
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
        $query = Coupon::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $coupons = $query->get();

         return $this->sendResponse(
             CouponResource::collection($coupons),
             __('messages.retrieved', ['model' => __('models/coupons.plural')])
         );
    }

    /**
     * @param CreateCouponAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/coupons",
     *      summary="Store a newly created Coupon in storage",
     *      tags={"Coupon"},
     *      description="Store Coupon",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Coupon that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Coupon")
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
     *                  ref="#/definitions/Coupon"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateCouponAPIRequest $request)
    {
        $input = $request->all();

        /** @var Coupon $coupon */
        $coupon = Coupon::create($input);

        return $this->sendResponse(
             new CouponResource($coupon),
             __('messages.saved', ['model' => __('models/coupons.singular')])
        );
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/coupons/{id}",
     *      summary="Display the specified Coupon",
     *      tags={"Coupon"},
     *      description="Get Coupon",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Coupon",
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
     *                  ref="#/definitions/Coupon"
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
        /** @var Coupon $coupon */
        $coupon = Coupon::find($id);

        if (empty($coupon)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/coupons.singular')])
            );
        }

        return $this->sendResponse(
            new CouponResource($coupon),
            __('messages.retrieved', ['model' => __('models/coupons.singular')])
        );
    }

    /**
     * @param int $id
     * @param UpdateCouponAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/coupons/{id}",
     *      summary="Update the specified Coupon in storage",
     *      tags={"Coupon"},
     *      description="Update Coupon",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Coupon",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Coupon that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Coupon")
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
     *                  ref="#/definitions/Coupon"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateCouponAPIRequest $request)
    {
        /** @var Coupon $coupon */
        $coupon = Coupon::find($id);

        if (empty($coupon)) {
           return $this->sendError(
               __('messages.not_found', ['model' => __('models/coupons.singular')])
           );
        }

        $coupon->fill($request->all());
        $coupon->save();

        return $this->sendResponse(
             new CouponResource($coupon),
             __('messages.updated', ['model' => __('models/coupons.singular')])
        );
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/coupons/{id}",
     *      summary="Remove the specified Coupon from storage",
     *      tags={"Coupon"},
     *      description="Delete Coupon",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Coupon",
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
        /** @var Coupon $coupon */
        $coupon = Coupon::find($id);

        if (empty($coupon)) {
           return $this->sendError(
                 __('messages.not_found', ['model' => __('models/coupons.singular')])
           );
        }

        $coupon->delete();

         return $this->sendResponse(
             $id,
             __('messages.deleted', ['model' => __('models/coupons.singular')])
         );
    }
}
