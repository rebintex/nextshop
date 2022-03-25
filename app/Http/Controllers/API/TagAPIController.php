<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateTagAPIRequest;
use App\Http\Requests\API\UpdateTagAPIRequest;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\TagResource;
use Response;

/**
 * Class TagController
 * @package App\Http\Controllers\API
 */

class TagAPIController extends AppBaseController
{
    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/tags",
     *      summary="Get a listing of the Tags.",
     *      tags={"Tag"},
     *      description="Get all Tags",
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
     *                  @SWG\Items(ref="#/definitions/Tag")
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
        $query = Tag::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $tags = $query->get();

         return $this->sendResponse(
             TagResource::collection($tags),
             __('messages.retrieved', ['model' => __('models/tags.plural')])
         );
    }

    /**
     * @param CreateTagAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/tags",
     *      summary="Store a newly created Tag in storage",
     *      tags={"Tag"},
     *      description="Store Tag",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Tag that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Tag")
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
     *                  ref="#/definitions/Tag"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateTagAPIRequest $request)
    {
        $input = $request->all();

        /** @var Tag $tag */
        $tag = Tag::create($input);

        return $this->sendResponse(
             new TagResource($tag),
             __('messages.saved', ['model' => __('models/tags.singular')])
        );
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/tags/{id}",
     *      summary="Display the specified Tag",
     *      tags={"Tag"},
     *      description="Get Tag",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Tag",
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
     *                  ref="#/definitions/Tag"
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
        /** @var Tag $tag */
        $tag = Tag::find($id);

        if (empty($tag)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/tags.singular')])
            );
        }

        return $this->sendResponse(
            new TagResource($tag),
            __('messages.retrieved', ['model' => __('models/tags.singular')])
        );
    }

    /**
     * @param int $id
     * @param UpdateTagAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/tags/{id}",
     *      summary="Update the specified Tag in storage",
     *      tags={"Tag"},
     *      description="Update Tag",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Tag",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Tag that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Tag")
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
     *                  ref="#/definitions/Tag"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateTagAPIRequest $request)
    {
        /** @var Tag $tag */
        $tag = Tag::find($id);

        if (empty($tag)) {
           return $this->sendError(
               __('messages.not_found', ['model' => __('models/tags.singular')])
           );
        }

        $tag->fill($request->all());
        $tag->save();

        return $this->sendResponse(
             new TagResource($tag),
             __('messages.updated', ['model' => __('models/tags.singular')])
        );
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/tags/{id}",
     *      summary="Remove the specified Tag from storage",
     *      tags={"Tag"},
     *      description="Delete Tag",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Tag",
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
        /** @var Tag $tag */
        $tag = Tag::find($id);

        if (empty($tag)) {
           return $this->sendError(
                 __('messages.not_found', ['model' => __('models/tags.singular')])
           );
        }

        $tag->delete();

         return $this->sendResponse(
             $id,
             __('messages.deleted', ['model' => __('models/tags.singular')])
         );
    }
}
