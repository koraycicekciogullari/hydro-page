<?php

namespace Koraycicekciogullari\HydroPage\Controllers;

use App\Http\Controllers\Controller;
use Koraycicekciogullari\HydroPage\Models\Page;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Throwable;

class PageGalleryController extends Controller
{
    /**
     * @throws FileIsTooBig
     * @throws FileDoesNotExist
     */
    public function update(Request $request, $id): JsonResponse
    {
        if($request->hasFile('image')){
            $product = Page::find($id);
            return response()->json(
                $product
                    ->addMediaFromRequest('image')
                    ->usingFileName($product->slug . '-' . time().rand(0,999999999) . '.webp')
                    ->toMediaCollection('gallery')
            );
        }
        Media::setNewOrder($request->all());
        return response()->json(true);
    }

    /**
     * @throws Throwable
     */
    public function destroy($id): JsonResponse
    {
        return response()->json(Media::findByUuid($id)->deleteOrFail());
    }
}
