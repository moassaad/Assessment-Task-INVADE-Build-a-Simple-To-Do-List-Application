<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PaginateResource extends JsonResource
{
    private $resourceClass;
    
    public function __construct($resource, string $resourceClass=null)
    {
        parent::__construct($resource);
        $this->resourceClass = $resourceClass;
    }

    public function collect($resource)
    {
        return $this->resourceClass::collection($resource);
    }
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "current_page"=>$this->currentPage(),
            "items"=>$this->collect($this->items()),
            "first_page_url"=>$this->url(1),
            "from"=>$this->firstItem(),
            "last_page"=>$this->lastPage(),
            "last_page_url"=>$this->url($this->lastPage()),
            "links"=>$this->linkCollection(),
            "next_page_url"=>$this->nextPageUrl(),
            "path"=>$this->path(),
            "per_page"=>$this->perPage(),
            "prev_page_url"=>$this->previousPageUrl(),
            "to"=>$this->lastItem(),
            "total"=>$this->total(),
        ];
    }
}
