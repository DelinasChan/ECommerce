<?php

namespace App\Http\Composers;

class GlobalComposer{
    public function compose($view)
    {   
        $view->with('DASHBOARD_PATH','assets/dashboard');
    }
}
