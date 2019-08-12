<?php
class CategoriesController extends Controller
{

    public $view = 'categories';

    public function index($data)
    {
        $goods = Good::getGoods(isset($data['id']) ? $data['id'] : 0);
        return ['goods' => $goods];
    }
}