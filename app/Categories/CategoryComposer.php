<?php
namespace App\Categories;
use Illuminate\View\View;
use App\Category;
class CategoryComposer
{
    public function compose(View $view)
    {
        $categories = Category::orderBy('name')->get()->split(2);
        $view->with('categories', $categories);
    }
}