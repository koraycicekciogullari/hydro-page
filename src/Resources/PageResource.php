<?php

namespace Koraycicekciogullari\HydroPage\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $id
 * @property mixed $title
 * @property mixed $description
 * @property mixed $content
 * @property mixed $slug
 * @property mixed $media
 * @property mixed $show_in_menu
 * @property mixed $show_in_footer
 */
class PageResource extends JsonResource
{
    /**
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id'                =>  $this->id,
            'title'             =>  $this->title,
            'description'       =>  $this->description,
            'content'           =>  $this->content,
            'slug'              =>  $this->slug,
            'show_in_menu'      =>  $this->show_in_menu,
            'show_in_footer'    =>  $this->show_in_footer,
            'image'             =>  collect($this->media)->whereIn('collection_name', 'default')->first(),
            'gallery'           =>  collect($this->media)->whereIn('collection_name', 'gallery')
                ->sortBy('order_column')->all(),
        ];
    }
}
