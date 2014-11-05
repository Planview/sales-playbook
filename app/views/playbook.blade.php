<!DOCTYPE html>
<html lang="en" ng-app>
<head>
    <meta charset="UTF-8">
    <title>Sales Playbook</title>
    {{ HTML::style('css/main.css') }}
</head>
<body>
    <div class="container">
        <header class="page-header">
            <h1 class="text-center">Interactive Sales Playbook</h1>
        </header>
        <div ng-controller="PlaybookCtrl" class="row" ng-cloak>
            <div class="col-sm-4">
                <form class="well">
                    <fieldset>
                        <legend>Search</legend>
                        <div class="form-group">
                            <label for="fullsearch">Search Everything</label>
                            <input type="text" ng-model="searchText" id="fullsearch" class="form-control">
                        </div>
                        <div src-playbook-select-multiple id="markets" collection="markets" collection-label="Markets" collection-model="filter.markets" item-label="name"></div>
                        <div src-playbook-select id="types" collection="types" collection-label="Types" collection-model="filter.document_type" item-label="name"></div>
                        <div src-playbook-select id="regionsCustomer" collection="operatingRegions" collection-label="Operating Regions" collection-model="filter.operating_region" item-label="name"></div>
                        <div src-playbook-select id="regionsPlanview" collection="planviewRegions" collection-label="Planview Regions" collection-model="filter.planview_region" item-label="name"></div>
                        <div src-playbook-select id="industries" collection="industries" collection-label="Industries" collection-model="filter.industry" item-label="name"></div>
                        <div src-playbook-select id="customers" collection="customers" collection-label="Customers" collection-model="filter.customer" item-label="name"></div>
                        <div src-playbook-select-multiple id="competitors" collection="competitors" collection-label="Competitors" collection-model="filter.competitors" item-label="name"></div>
                        <hr>
                        <button type="button" ng-click="resetCategories()" class="btn btn-default btn-block">
                            <span class="text-danger">
                                <span class="glyphicon glyphicon-remove"></span> Reset Categories
                            </span>
                        </button>
                    </fieldset>
                </form>
            </div>
            <div class="col-sm-8">
                <nav src-pagination collection="documents | filter:searchText" per-page="perPage" page="page"></nav>
                <div class="panel-group" id="documents">
                    <div class="panel panel-default" ng-repeat="doc in documents | filter:searchText | paging:{page: page, perPage: perPage}">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#documents" ng-href="#collapse@{{$index}}" ng-bind="doc.title"></a>
                                <span class="label label-warning pull-right" ng-show="doc.document_type.internal_only">INTERNAL USE ONLY</span>
                            </h4>
                        </div>
                        <div id="collapse@{{$index}}" class="panel-collapse collapse" ng-class="{in: $first}">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <dl class="dl-horizontal">
                                            <dt>Document Type</dt>
                                            <dd ng-bind="doc.document_type.name"></dd>
                                            <dt ng-show="doc.customer_verbose.operating_region">Operating Regions</dt>
                                            <dd ng-bind="doc.customer_verbose.operating_region.name"></dd>
                                            <dt ng-show="doc.customer_verbose.regionsPlanview">Planview Regions</dt>
                                            <dd ng-repeat="region in doc.customer_verbose.regionsPlanview" ng-bind="region.name"></dd>
                                            <dt ng-show="doc.customer_verbose.industry">Industries</dt>
                                            <dd ng-bind="doc.customer_verbose.industry.name"></dd>
                                        </dl>
                                    </div>
                                    <div class="col-md-6">
                                        <dl class="dl-horizontal">
                                        <dt ng-show="doc.customer_verbose.markets.length">Markets</dt>
                                        <dd ng-repeat="market in doc.customer_verbose.markets">@{{market.name}}</dd>
                                        <dt ng-show="doc.customer_verbose">Customer</dt>
                                        <dd>
                                            <span ng-bind="doc.customer_verbose.name"></span>
                                            <span ng-show="!doc.customer.can_use_name" class="label label-danger">Do Not Use Customer Name</span>
                                        </dd>
                                        <dt ng-show="doc.customer_verbose.competitors.length">Competitors</dt>
                                        <dd ng-repeat="competitor in doc.customer_verbose.competitors" ng-bind="competitor.name"></dd>
                                        </dl>
                                    </div>
                                </div>
                            <p class="text-center"><a ng-href="@{{doc.url}}" title="" target="_blank" class="btn btn-primary">Get this Document</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{ HTML::script('bower_components/requirejs/require.js', ['data-main' => '/js/main']) }}
</body>
</html>
