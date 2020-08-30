<?php

namespace Grutto\News\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NewsCategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'category_id' => $this->category_id,
            'category_title' => $this->parent ? $this->parent->title : '',
            'title' => $this->title,
            'slug' => $this->slug,
            'news' => $this->news,
        ];
    }
}
