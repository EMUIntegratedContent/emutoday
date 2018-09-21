<?php
namespace Emutoday\Http\ViewComposers;
use Illuminate\View\View;

class AddCurrentUser
{
    public function compose(View $view)
    {
        //var_dump(auth()->user());
        $view->with('currentUser', auth()->user() );
    }
}
