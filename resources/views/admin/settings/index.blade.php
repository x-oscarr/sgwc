@extends('builder.default')

@section('content')

    <section>
        <div class="jumbotron">
            <h1 class="display-3">Hello, world!</h1>
            <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
            <hr class="my-4">
            <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
            <p class="lead">
                <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
            </p>
        </div>
        <h3 class="blockcontent-title">General settings</h3>
        <div class="row">
            <div class="col-12 col-md-4 mb-2">
                {!! Form::label('pTitle', 'Page Title') !!}
                {!! Form::text('ptitle', null, [
                    'class' => 'form-control '.($errors->any() ? $errors->has('pTitle') ? 'is-invalid' : 'is-valid' : ""),
                    'placeholder' => '• SGWC •'
                ]) !!}
            </div>
            <div class="col-12 col-md-4 mb-2">
                {!! Form::label('gTitle', 'Index Title (support <span> tag)') !!}
                {!! Form::text('ptitle', null, [
                    'class' => 'form-control '.($errors->any() ? $errors->has('gTitle') ? 'is-invalid' : 'is-valid' : ""),
                    'placeholder' => 'Source<span>Game</span> Web Constructor'
                ]) !!}
            </div>
            <div class="col-12 col-md-4">
                {!! Form::label('projectName', 'Project Name') !!}
                {!! Form::text('ptitle', null, [
                    'class' => 'form-control '.($errors->any() ? $errors->has('ptitle') ? 'is-invalid' : 'is-valid' : ""),
                    'placeholder' => 'Source Game Web Constructor'
                ]) !!}
            </div>
        </div>
    </section>
    <section>
        <h3 class="blockcontent-title">Menu Items</h3>
        {!! Form::open(['method' => 'POST', 'id' => 'menuItemForm']) !!}
            <div class="row">
                <div class="col-12 col-md-4 d-flex align-items-start justify-content-between">
                    <div class="tasks-wrapper" id="new">
                        <div class="task-title"><h3>Меню</h3></div>
                        @foreach($menuItemsList as $key => $menuItems)
                            @foreach($menuItems as $menuItem)
                                <div class="task" data-id="{{ $menuItem->id }}">{!! $menuItem->text !!}</div>
                            @endforeach
                            @if (!$loop->last)
                                <div class="task-hr"><hr></div>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="col-12 col-md-8">
                    <div id="updateItemForm">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#parent">Parent</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#child">Child</a>
                            </li>
                        </ul>
                        <div id="myTabContent" class="tab-content pt-2">
                            <div class="tab-pane fade active show" id="parent">
                                <div class="row">
                                    {!! Form::hidden('itemId', null) !!}
                                    {!! Form::hidden('itemChild', null) !!}
                                    <div class="col-12 col-md-6 mb-3">
                                        {!! Form::label('siteModule', 'Web module') !!}
                                        {!! Form::select('siteModule', $siteModulesOptions, null, [
                                            'class' => 'form-control',
                                        ]) !!}
                                    </div>
                                    <div class="col-12 col-md-6mb-3">

                                    </div>
                                    <div class="col-12 mb-3">
                                        {!! Form::label('text', 'Menu item text') !!}
                                        {!! Form::text('text', null, [
                                            'class' => 'form-control'
                                        ]) !!}
                                    </div>
                                    <div class="col-12 col-md-6 mb-3">
                                        {!! Form::label('access', 'Access type') !!}
                                        {!! Form::select('access', [
                                             null => 'None',
                                            'auth' => 'Auth',
                                            'permission' => 'Permission',
                                            'role' => 'Role'
                                        ], null, [
                                            'class' => 'form-control'
                                        ]) !!}
                                    </div>
                                    <div class="col-12 col-md-6 mb-3">
                                        {!! Form::label('accessParams', 'Access params') !!}
                                        {!! Form::text('accessParams', null, [
                                            'class' => 'form-control'
                                        ]) !!}
                                    </div>
                                    <div class="col-12 col-md-6 mb-3">
                                        {!! Form::label('route', 'Route name') !!}
                                        {!! Form::text('route',null, [
                                            'class' => 'form-control'
                                        ]) !!}
                                    </div>
                                    <div class="col-12 col-md-6 mb-3">
                                        {!! Form::label('routeParams', 'Route params') !!}
                                        {!! Form::text('routeParams', null, [
                                            'class' => 'form-control'
                                        ]) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="child">
                                <div class="row" id="childItemForm">
                                    <div class="col-12 mb-3">
                                        {!! Form::label('childText', 'Menu item text') !!}
                                        {!! Form::text('childText', null, [
                                            'class' => 'form-control'
                                        ]) !!}
                                    </div>
                                    <div class="col-12 col-md-6 mb-3">
                                        {!! Form::label('childRoute', 'Route name') !!}
                                        {!! Form::text('childRoute',null, [
                                            'class' => 'form-control'
                                        ]) !!}
                                    </div>
                                    <div class="col-12 col-md-6 mb-3">
                                        {!! Form::label('childRouteParams', 'Route params') !!}
                                        {!! Form::text('childRouteParams', null, [
                                            'class' => 'form-control'
                                        ]) !!}
                                    </div>
                                </div>
                                <div id="childItemText" class="text-center p-2">
                                    <h4>No child element exists for this item</h4>
                                    <button type="button" class="btn btn-outline-secondary btn-lg mt-3" data-toggle="modal" data-target="#addChildItem"><i class="fas fa-plus"></i> Add child item</button>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div id="menuItemText">
                        <h4>Please select item for <br>change or add item</h4>
                    </div>
                    <div id="menuItemLoader" style="height: 100%">
                        @include('builder.loader')
                    </div>
                </div>
                <div class="col-12 d-flex justify-content-center mt-3">
                    <button type="button" class="btn btn-primary item-add" data-toggle="modal" data-target="#addItem"><i class="fas fa-plus"></i> Add item</button>
                    <button type="button" class="btn btn-secondary" id="saveItem">Save cahnges</button>
                </div>
            </div>
        {!! Form::close() !!}
    </section>
    <section>
        <h3 class="blockcontent-title">Database Settings</h3>
        <div class="row">
            <div class="ccol-12 col-md-4">
                {!! Form::hidden('childItemParentId', null) !!}
                <div class="mb-2">
                    {!! Form::label('dHost', 'Database Host') !!}
                    {!! Form::text('dHost', null, [
                        'class' => 'form-control '.($errors->any() ? $errors->has('dHost') ? 'is-invalid' : 'is-valid' : ""),
                        'placeholder' => 'localhost',
                        'readonly' => 'readonly'
                    ]) !!}
                </div>
                <div class="mb-2">
                    {!! Form::label('dUser', 'Database User') !!}
                    {!! Form::text('dUser', null, [
                        'class' => 'form-control '.($errors->any() ? $errors->has('dUser') ? 'is-invalid' : 'is-valid' : ""),
                        'placeholder' => 'root',
                        'readonly' => 'readonly'
                    ]) !!}
                </div>
                <div class="mb-2">
                    {!! Form::label('dPass', 'Database Password') !!}
                    {!! Form::password('dPass',[
                        'class' => 'form-control '.($errors->any() ? $errors->has('dPass') ? 'is-invalid' : 'is-valid' : ""),
                        'placeholder' => '********',
                        'readonly' => 'readonly'
                    ]) !!}
                </div>
            </div>
            <div class="col-12 col-md-8">

            </div>
        </div>
    </section>
@endsection

@section('sidebar')
    @include('admin.settings.sidebar')
@endsection

@section('modal.window')
    <div class="modal fade" id="addItem" tabindex="-1" role="dialog" aria-labelledby="addItemLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                {!! Form::open(['method' => 'post', 'id' => 'addItemForm']) !!}
                    <div class="modal-header">
                        <h5 class="modal-title" id="addItemLabel">Create new item</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body р-100">
                        <div class="form-group">
                            {!! Form::label('newSiteModule', 'Web module') !!}
                            {!! Form::select('newSiteModule', $siteModulesOptions, null, [
                                'class' => 'form-control',
                            ]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('newText', 'Menu item text') !!}
                            {!! Form::text('newText', null, [
                                'class' => 'form-control',
                                'placeholder' => 'Item text'
                            ]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('newAccess', 'Access type') !!}
                            {!! Form::select('newAccess', [
                                 null => 'None',
                                'auth' => 'Auth',
                                'permission' => 'Permission',
                                'role' => 'Role'
                            ], null, [
                                'class' => 'form-control'
                            ]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('newAccessParams', 'Access params') !!}
                            {!! Form::text('newAccessParams', null, [
                                'class' => 'form-control',
                                'placeholder' => 'page.settings'
                            ]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('newRoute', 'Route name') !!}
                            {!! Form::text('newRoute',null, [
                                'class' => 'form-control',
                                'placeholder' => 'admin.settings'
                            ]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('newRouteParams', 'Route params') !!}
                            {!! Form::text('newRouteParams', null, [
                                'class' => 'form-control',
                                'placeholder' => 'user=1&bool=true'
                            ]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('newType', 'Menu item type') !!}
                            {!! Form::select('newType', [
                                 1 => 'User menu item',
                                 2 => 'Admin menu item'
                            ], null, [
                                'class' => 'form-control'
                            ]) !!}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-outline-success" id="submitItem">Save</button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

    <div class="modal fade" id="addChildItem" tabindex="-1" role="dialog" aria-labelledby="addChildItemLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                {!! Form::open(['method' => 'post', 'id' => 'addChildItemForm']) !!}
                <div class="modal-header">
                    <h5 class="modal-title" id="addChildItemLabel">Create child item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body h-100">
                    <div class="mb-2">
                        <h5>Create child item by <b id="parentItemId"></b></h5>
                    </div>
                    {!! Form::hidden('newChildItemParentId', null) !!}
                    <div class="form-group">
                        {!! Form::label('newChildText', 'Menu item text') !!}
                        {!! Form::text('newChildText', null, [
                            'class' => 'form-control',
                            'placeholder' => 'Item text'
                        ]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('newChildRoute', 'Route name') !!}
                        {!! Form::text('newChildRoute',null, [
                            'class' => 'form-control',
                            'placeholder' => 'admin.settings'
                        ]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('newChildRouteParams', 'Route params') !!}
                        {!! Form::text('newChildRouteParams', null, [
                            'class' => 'form-control',
                            'placeholder' => 'user=1&bool=true'
                        ]) !!}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-outline-success" id="submitChildItem">Save</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.0/jquery-ui.min.js"></script>
    <script type="text/javascript">
        let modalCreateItemText = '<h2 class="text-center">Success! <i class="fas fa-check text-success"></i></h2><p class="text-center">Child menu item successfully create</p>';
        let modalCreateChildItemText = '<h2 class="text-center">Success! <i class="fas fa-check text-success"></i></h2><p class="text-center">Child menu item successfully create</p>';
        let modalPreloader = `@include('builder.loader')`;

        $('#updateItemForm').hide();
        $('#menuItemLoader').hide();

        $(function() {
            $('.task').draggable({
                helper: function() {var width = $(this).outerWidth();
                    return $(this).clone().appendTo("body").width(width-30);},
                zIndex:10
            });

        });

        $(".task").droppable({
            acept: function(el) {
                return el.hasClass("task")
            },
            drop: function(e, ui) {

                //e.target - принимающий
                //ui.draggable[0] - перетаскиваемый
                //console.log(ui.draggable[0]);
                $(e.target).after(ui.draggable[0]);

                $(this).removeClass("over");
            },
            over: function(e, ui) {
                $(this).addClass("over");
            },
            out: function(e, ui) {
                $(this).removeClass("over");
            },

        });
        // Display menu item form
        $(".task").click(function () {
            $('#menuItemText').hide();
            $('#updateItemForm').hide();
            $('#menuItemLoader').show();

            let menuItemId = $(this).data("id");

            $.ajax({
                type: "POST",
                url: '{{ route("settings.get.menu.item") }}',
                // dataType: 'json',
                data: {id: menuItemId},
                success: function(response) {

                    let menuItem = response.menuItem;
                    let childItem = response.childMenuItem;

                    // parent Item
                    $("#menuItemForm select[name='siteModule']").val(menuItem.site_module_id);
                    $("#menuItemForm select[name='access']").val(menuItem.access);
                    $("input[name='itemId']").val(menuItem.id);
                    $("input[name='text']").val(menuItem.text);
                    $("input[name='accessParams']").val(menuItem.access_params);
                    $("input[name='route']").val(menuItem.route);
                    $("input[name='routeParams']").val(menuItem.route_params);

                    //child Item
                    if(childItem) {
                        $("input[name='itemChild']").val(true);
                        $("input[name='childText']").val(childItem.text);
                        $("input[name='childRoute']").val(childItem.route);
                        $("input[name='childRouteParams']").val(childItem.route_params);

                        $("#childItemForm").show();
                        $("#childItemText").hide();
                    }
                    else {
                        $("input[name='itemChild']").val(false);
                        $("input[name='newChildItemParentId']").val(menuItem.id);
                        $("#parentItemId").html(menuItem.text);

                        $("#childItemText").show();
                        $("#childItemForm").hide();
                    }

                    $('#menuItemLoader').hide();
                    $('#updateItemForm').show();
                },
                error: function(response) {
                    console.log(response);
                }
            });
        });

        // Save item
        $("#saveItem").click(function () {
            let itemsPosition = updatePositionItems();
            sendItemData({
                "itemData": $("#menuItemForm").serializeArray(),
                "itemChildData": $("#childItemForm").serializeArray(),
                "itemsPosition": itemsPosition
            });
        });
        // Add item
        $("#submitItem").click(function () {
            let result = sendItemData({
                "itemData": $("#addItemForm").serializeArray()
            });
            console.log(result);

        });
        // Add Child Item
        $("#submitChildItem").click(function () {
            let result = sendItemData({
               "itemChildData": $("#addChildItemForm").serializeArray()
            });
            console.log(result);

        });

        function sendItemData(data) {
            $.ajax({
                type: "POST",
                url: '{{ route("settings.update.menu.item") }}',
                // dataType: 'json',
                data: data,
                success: function(response) {
                    return response
                },
                error: function(response) {
                    console.log(response);
                }
            });
        }

        function updatePositionItems() {
            let menuItem = $('.task');
            menuItemsPosition = [];
            for(let i = 0; i < menuItem.length; i++) {
                //console.log('position = '+i+'; id = '+$(menuItem[i-1]).data('id'));
                menuItemsPosition.push({
                    "id": $(menuItem[i]).data('id'),
                    "position": i+1
                });
            }
            return menuItemsPosition;
        }

    </script>
@endsection
