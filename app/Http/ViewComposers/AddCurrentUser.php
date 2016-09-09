<?php
namespace Emutoday\Http\ViewComposers;
use Illuminate\View\View;

class AddCurrentUser
{
    public function compose(View $view)
    {
        $view->with('currentUser', auth()->user() );
    }
}
