@extends('layouts.app')

@section('content')




    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/cldrjs/0.4.4/cldr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cldrjs/0.4.4/cldr/event.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cldrjs/0.4.4/cldr/supplemental.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cldrjs/0.4.4/cldr/unresolved.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn3.devexpress.com/jslib/21.1.4/css/dx.common.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn3.devexpress.com/jslib/21.1.4/css/dx.light.css" />
    <script src="https://cdn3.devexpress.com/jslib/21.1.4/js/dx.all.js"></script>

    <script>

    $(function() {

        var store = new DevExpress.data.CustomStore({
        key: "id",
        load: function (loadOptions) {
            var deferred = $.Deferred(),
                args = {};

            [
                "skip",
                "take",
                "requireTotalCount",
                "requireGroupCount",
                "sort",
                "filter",
                "totalSummary",
                "group",
                "groupSummary"
            ].forEach(function(i) {
                if (i in loadOptions && isNotEmpty(loadOptions[i]))
                    args[i] = JSON.stringify(loadOptions[i]);
            });
            $.ajax({
                headers: {
        'Accept': 'application/json',
        'X-Requested-With': 'XMLHttpRequest',
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        'Authorization': "Bearer " + "{{ $token }}",
    },
    type: 'GET',
    url: 'api/item',
                dataType: "json",
                data: args,
                success: function(result) {
                    deferred.resolve(result.results, {
                        totalCount: result.results.length,
                        summary: result.summary,
                        groupCount: result.groupCount
                    });
                },
                error: function() {
                    deferred.reject("Data Loading Error");
                },
                timeout: 5000
            });

            return deferred.promise();
        }
    });


    $("#gridContainer").dxDataGrid({
        editing: {
            allowUpdating: true,
            allowAdding: true,
            allowDeleting: true,
            popup: {
            onContentReady: function (e) {
                var buttons = e.component.content().parent().find(".dx-button");

                buttons.eq(0).dxButton("instance").on("click", function () {
                    DevExpress.ui.notify("Custom logic goes here", "success", 1000)
                });


            }
        },
            mode: 'popup'
        },
        dataSource: store,


        paging: {
            pageSize: 10
        },
        pager: {
            showPageSizeSelector: true,
            allowedPageSizes: [10, 25, 50, 100]
        },
        remoteOperations: false,
        searchPanel: {
            visible: true,
            highlightCaseSensitive: true
        },
        groupPanel: { visible: true },
        grouping: {
            autoExpandAll: false
        },
        allowColumnReordering: true,
        rowAlternationEnabled: true,
        showBorders: true,
        columns: [

            {
                dataField: "packet_name",
                caption: "PAKET",
                groupIndex: 0,

            },
            {
                dataField: "name",
                caption: "ITEM",

            },
            {
                dataField: "unit",
                caption: "UNIT",
            },
            {
                dataField: "hasil",
                caption: "HASIL",

            },
            {
                caption: "NORMAL VALUE",
                dataField: "nilai_normal",

            },
            {
                caption: "Keterangan",
                dataField: "keterangan",

            }
        ],
        onContentReady: function(e) {
            if(!collapsed) {
                collapsed = true;
                e.component.expandRow(["EnviroCare"]);
            }
        }
    });
});

var discountCellTemplate = function(container, options) {
    $("<div/>").dxBullet({
        onIncidentOccurred: null,
        size: {
            width: 150,
            height: 35
        },
        margin: {
            top: 5,
            bottom: 0,
            left: 5
        },
        showTarget: false,
        showZeroLevel: true,
        value: options.value * 100,
        startScaleValue: 0,
        endScaleValue: 100,
        tooltip: {
            enabled: true,
            font: {
                size: 18
            },
            paddingTopBottom: 2,
            customizeTooltip: function() {
                return { text: options.text };
            },
            zIndex: 5
        }
    }).appendTo(container);
};

var collapsed = false;

</script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('List Paket') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="demo-container">
        <div id="gridContainer"></div>
    </div>



                </div>
            </div>
        </div>
    </div>
</div>
@endsection
