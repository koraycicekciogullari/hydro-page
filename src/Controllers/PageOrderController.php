<?php

namespace Koraycicekciogullari\HydroPage\Controllers;

use App\Http\Controllers\Controller;
use Koraycicekciogullari\HydroPage\Models\Page;
use Illuminate\Http\Request;

class PageOrderController extends Controller
{
    /**
     * @param Request $request
     */
    public function __invoke(Request $request)
    {
        foreach ($request->all() as $index => $id){
            Page::find($id)->update(['order' => $index]);
        }
    }
}
