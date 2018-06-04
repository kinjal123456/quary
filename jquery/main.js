$(function () {
    ScrollTable('table.table-condensed');
    //$(window).resize(onResize);
});

function ScrollTable(scrollcontainer){
    var dataTable = $(scrollcontainer).dataTable({
        sDom: 'frtiS',
        sScrollX: '100%',
        bAutoWidth: false,
        bScrollCollapse: true,
        bPaginate: false,
        bFilter: false,
        bInfo: false,
        bSort: false,
        bDeferRender: true
    });

    var onResize = function () {
        var oSettings = dataTable.fnSettings();
        dataTable.fnDraw();
    };

    var firstDraw = false;
    new FixedColumns(dataTable, {
        iLeftWidth: 100,
        fnDrawCallback: function () {
            if (firstDraw) return;
            firstDraw = true;
            onResize();
        }
    });
}