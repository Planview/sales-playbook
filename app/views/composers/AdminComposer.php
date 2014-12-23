<?php

class AdminComposer
{
    public function compose($view)
    {
        // cUser is short for current user
        return $view->with('cUser', Confide::user());
    }
}
