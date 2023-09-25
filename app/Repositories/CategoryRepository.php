<?php

namespace App\Repositories;

use App\Contracts\CategoryContract;

class CategoryRepository extends BaseRepository implements CategoryContract
{
    public function activeCategory(bool $pagination = true)
    {
        if (!$pagination) {
            return $this->model->where('is_active', true)->get();
        }
        return $this->model->where('is_active', true)->paginate(config('helpdesk.DEFAULT_PAGINATION_COUNT'));
    }
}
