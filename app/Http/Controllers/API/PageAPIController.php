<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePageAPIRequest;
use App\Http\Requests\API\UpdatePageAPIRequest;
use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\PageResource;
use Response;

/**
 * Class PageController
 * @package App\Http\Controllers\API
 */

class PageAPIController extends AppBaseController
{
    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/pages",
     *      summary="Get a listing of the Pages.",
     *      tags={"Page"},
     *      description="Get all Pages",
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
     *                  @SWG\Items(ref="#/definitions/Page")
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
        $query = Page::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $pages = $query->get();

         return $this->sendResponse(
             PageResource::collection($pages),
             __('messages.retrieved', ['model' => __('models/pages.plural')])
         );
    }

    /**
     * @param CreatePageAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/pages",
     *      summary="Store a newly created Page in storage",
     *      tags={"Page"},
     *      description="Store Page",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Page that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Page")
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
     *                  ref="#/definitions/Page"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreatePageAPIRequest $request)
    {
        $input = $request->all();

        /** @var Page $page */
        $page = Page::create($input);

        return $this->sendResponse(
             new PageResource($page),
             __('messages.saved', ['model' => __('models/pages.singular')])
        );
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/pages/{id}",
     *      summary="Display the specified Page",
     *      tags={"Page"},
     *      description="Get Page",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Page",
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
     *                  ref="#/definitions/Page"
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
        /** @var Page $page */
        $page = Page::find($id);

        if (empty($page)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/pages.singular')])
            );
        }

        return $this->sendResponse(
            new PageResource($page),
            __('messages.retrieved', ['model' => __('models/pages.singular')])
        );
    }

    /**
     * @param int $id
     * @param UpdatePageAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/pages/{id}",
     *      summary="Update the specified Page in storage",
     *      tags={"Page"},
     *      description="Update Page",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Page",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Page that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Page")
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
     *                  ref="#/definitions/Page"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdatePageAPIRequest $request)
    {
        /** @var Page $page */
        $page = Page::find($id);

        if (empty($page)) {
           return $this->sendError(
               __('messages.not_found', ['model' => __('models/pages.singular')])
           );
        }

        $page->fill($request->all());
        $page->save();

        return $this->sendResponse(
             new PageResource($page),
             __('messages.updated', ['model' => __('models/pages.singular')])
        );
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/pages/{id}",
     *      summary="Remove the specified Page from storage",
     *      tags={"Page"},
     *      description="Delete Page",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Page",
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
        /** @var Page $page */
        $page = Page::find($id);

        if (empty($page)) {
           return $this->sendError(
                 __('messages.not_found', ['model' => __('models/pages.singular')])
           );
        }

        $page->delete();

         return $this->sendResponse(
             $id,
             __('messages.deleted', ['model' => __('models/pages.singular')])
         );
    }
}
