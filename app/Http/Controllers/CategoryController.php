<?php

namespace App\Http\Controllers;

use App\Contracts\CategoryContract;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    public function __construct(private CategoryContract $categoryContract)
    {
    }

    public function fetchCategory()
    {
        try {
            $data = $this->categoryContract->activeCategory(false);
            return $this->successResponse($data);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }
}
