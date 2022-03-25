<?php

namespace App\Http\Controllers;

use App\DataTables\TagDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateTagRequest;
use App\Http\Requests\UpdateTagRequest;
use App\Models\Tag;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class TagController extends AppBaseController
{
    /**
     * Display a listing of the Tag.
     *
     * @param TagDataTable $tagDataTable
     *
     * @return Response
     */
    public function index(TagDataTable $tagDataTable)
    {
        return $tagDataTable->render('admin.tags.index');
    }

    /**
     * Show the form for creating a new Tag.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.tags.create');
    }

    /**
     * Store a newly created Tag in storage.
     *
     * @param CreateTagRequest $request
     *
     * @return Response
     */
    public function store(CreateTagRequest $request)
    {
        $input = $request->all();

        /** @var Tag $tag */
        $tag = Tag::create($input);

        Flash::success(__('messages.saved', ['model' => __('models/tags.singular')]));

        return redirect(route('admin.tags.index'));
    }

    /**
     * Display the specified Tag.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Tag $tag */
        $tag = Tag::find($id);

        if (empty($tag)) {
            Flash::error(__('models/tags.singular').' '.__('messages.not_found'));

            return redirect(route('admin.tags.index'));
        }

        return view('admin.tags.show')->with('tag', $tag);
    }

    /**
     * Show the form for editing the specified Tag.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Tag $tag */
        $tag = Tag::find($id);

        if (empty($tag)) {
            Flash::error(__('messages.not_found', ['model' => __('models/tags.singular')]));

            return redirect(route('admin.tags.index'));
        }

        return view('admin.tags.edit')->with('tag', $tag);
    }

    /**
     * Update the specified Tag in storage.
     *
     * @param int $id
     * @param UpdateTagRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTagRequest $request)
    {
        /** @var Tag $tag */
        $tag = Tag::find($id);

        if (empty($tag)) {
            Flash::error(__('messages.not_found', ['model' => __('models/tags.singular')]));

            return redirect(route('admin.tags.index'));
        }

        $tag->fill($request->all());
        $tag->save();

        Flash::success(__('messages.updated', ['model' => __('models/tags.singular')]));

        return redirect(route('admin.tags.index'));
    }

    /**
     * Remove the specified Tag from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Tag $tag */
        $tag = Tag::find($id);

        if (empty($tag)) {
            Flash::error(__('messages.not_found', ['model' => __('models/tags.singular')]));

            return redirect(route('admin.tags.index'));
        }

        $tag->delete();

        Flash::success(__('messages.deleted', ['model' => __('models/tags.singular')]));

        return redirect(route('admin.tags.index'));
    }
}
