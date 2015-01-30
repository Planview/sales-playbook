<?php

class AdminComposer
{
    /**
     * Holds the built-up menu
     *
     * @var array
     */
    protected $menuItems;

    /**
     * Whether to use autorouting
     *
     * @var array
     */
    protected $auto;

    /**
     * Holds the name of the current route
     *
     * @var string
     */
    protected $current;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->menuItems = array();
        $this->auto = true;
        $this->current = Route::currentRouteName();

        $this->menuItems[] = [
            'title' => 'Dashboard',
            'link' => URL::route('admin.dashboard')
        ];
        $this->doPlaybookItems();
        $this->doPlaybookMetaItems();
        $this->doKickoffItems();
        $this->doUserItems();
    }

    /**
     * Returns the result of the composer
     *
     * @param   View    $view   The attached view
     * @return  View    The result of the composer
     */
    public function compose($view)
    {
        return $view
            ->with('sidebarMenu', $this->menuItems)
            ->with('sidebarAuto', $this->auto);
    }

    /**
     * Build the Users submenu
     *
     * @return void
     */
    protected function doUserItems()
    {
        $userItems = array();
        $permissions = ['manage_users', 'manage_roles', 'manage_permissions'];
        $sections = [
            'users' => ['Users', 'manage_users'],
            'roles' => ['Roles', 'manage_roles'],
            'permissions'   => ['Permissions', 'manage_permissions']
        ];

        if (!Entrust::user()->ability([], $permissions)) return;

        $this->doSectionLinks('Users', $sections);
    }

    /**
     * Set the item as active if it needs to be, and set the property
     *
     * @param  array    &$link  The link array that we should set active
     * @param  string   $route  The route to check against
     * @param  array    $except Any routes to exclude
     * @return boolean          If the route was set active
     */
    protected function maybeSetActive(&$link, $route, $except = [])
    {
        if (!$this->auto || strpos($this->current, $route) === false)
            return false;

        foreach ($except as $test) {
            if (strpos($this->current, $test)) return false;
        }

        $this->auto = false;
        $link['active'] = true;
        return true;
    }

    /**
     * Add the links for the playbook meta categories
     *
     * @return void
     */
    protected function doPlaybookMetaItems()
    {
        if (!Entrust::can('manage_playbook_meta')) return;

        $sections = [
            'document-types' => 'Document Types',
            'competitors' => 'Competitors',
            'markets' => 'Markets',
            'industries' => 'Industries',
            'operating-regions' => 'Operating Regions',
            'planview-regions' => 'Sales Regions',
            'planview-subregions' => 'Sales Subregions',
        ];

        $this->doSectionLinks('Playbook Categories', $sections);
    }

    protected function doPlaybookItems()
    {
        if (!Entrust::can('manage_playbook')) return;

        $sections = [
            'documents' => 'Documents',
            'customers' => 'Customers'
        ];

        $this->doSectionLinks('Playbook', $sections);
    }

    protected function doKickoffItems()
    {
        if (!Entrust::can('manage_kickoffs'))
            return;

        $sections = [
            'kickoffs' => 'Kickoffs'
        ];

        $this->doSectionLinks('Sales Kickoffs', $sections);
    }

    protected function doSectionLinks($sectionTitle, $links)
    {
        $items = array();

        foreach ($links as $id => $link) {
            if (is_array($link)) {
                if (!Entrust::can($link[1])) continue;
                $title = $link[0];
            } else {
                $title = $link;
            }

            $singleTitle = str_singular($title);

            $index = [
                'title' => "All $title",
                'link'  => URL::route("admin.{$id}.index")
            ];

            $this->maybeSetActive($index, "admin.{$id}", ['index', 'create']);

            $items[] = $index;

            $items[] = [
                'title' => "Add New $singleTitle",
                'link'  => URL::route("admin.{$id}.create")
            ];

            $items[] = 'divider';
        }

        array_splice($items, -1);

        $this->menuItems[] = [$sectionTitle, $items];
    }
}
