<?php

namespace Koraycicekciogullari\HydroPage\Controllers;

use App\Http\Controllers\Controller;
use Koraycicekciogullari\HydroPage\Requests\PageStoreRequest;
use Koraycicekciogullari\HydroPage\Requests\PageUpdateRequest;
use Koraycicekciogullari\HydroPage\Resources\PageCollection;
use Koraycicekciogullari\HydroPage\Resources\PageResource;
use Koraycicekciogullari\HydroPage\Models\Page;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

/**
 *
 */
class PageController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('role_or_permission:admin|root|page index')->only(['index']);
        $this->middleware('role_or_permission:admin|root|page store')->only(['store']);
        $this->middleware('role_or_permission:admin|root|page show')->only(['show']);
        $this->middleware('role_or_permission:admin|root|page update')->only(['update']);
        $this->middleware('role_or_permission:admin|root|page destroy')->only(['destroy']);
    }

    /**
     * @return PageCollection
     */
    public function index(): PageCollection
    {
        return new PageCollection(Page::all()->sortBy('order'));
    }

    /**
     * @throws FileIsTooBig
     * @throws FileDoesNotExist
     */
    public function store(PageStoreRequest $request): PageResource
    {
        return new PageResource(Page::create($request->validated())->addMediaFromRequest('image')->toMediaCollection());
    }

    /**
     * @param Page $page
     * @return PageResource
     */
    public function show(Page $page): PageResource
    {
        return new PageResource($page->load('media'));
    }

    /**
     * @param PageUpdateRequest $request
     * @param Page $page
     * @return PageResource
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function update(PageUpdateRequest $request, Page $page): PageResource
    {
        $page->update($request->validated());
        if($request->hasFile('image')){
            $page->clearMediaCollection();
            $page->addMediaFromRequest('image')->toMediaCollection();
        }
        return new PageResource($page->load('media'));
    }

    /**
     * @param Page $page
     */
    public function destroy(Page $page)
    {
        $page->clearMediaCollection();
        $page->delete();
    }
}
