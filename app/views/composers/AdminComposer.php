<?php

class AdminComposer
{
    public function compose($view)
    {
        // cUser is short for current user
        return $view->with(
            'sidebarMenu',
            [
                [
                    'title' => 'Hello World',
                    'link'  => URL::route('admin.dashboard')
                ],
                [
                    'Users',
                    [
                        [
                            'title' => 'All Users',
                            'link'  => URL::route('admin.users.index')
                        ],
                        [
                            'title' => 'Add New User',
                            'link'  => URL::route('admin.users.create')
                        ]
                    ]
                ]
            ]);
    }
}
