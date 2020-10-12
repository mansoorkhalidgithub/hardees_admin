<?php

namespace  App\Http\view\composers;

use App\Order;
use Illuminate\View\View;

class OrderComposer
{
    public function compose(View $view)
    {
        $view->with('model', Order::where('status', '!=', 1)->orderBy('id', 'DESC')->get()->each->append('riderName'));
    }
}
