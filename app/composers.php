<?php

View::composers([
    'AdminComposer' => ['admin.partials.sidebar']
]);

View::composer('admin.customers.form', function ($view)
{
    return $view
        ->with('markets', Market::optionsList())
        ->with('industries', Industry::optionsList())
        ->with('competitors', Competitor::optionsList())
        ->with('opRegions', OperatingRegion::optionsList())
        ->with('pvRegions', PlanviewRegion::optionsListSubregions());
});
