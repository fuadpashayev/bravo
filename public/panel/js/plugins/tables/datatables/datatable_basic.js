
var DatatableBasic = function() {


    var _componentDatatableBasic = function(manualTableClass=null) {
        if (!$().DataTable) {
            console.warn('Warning - datatables.min.js is not loaded.');
            return;
        }

        // Setting datatable defaults
        $.extend( $.fn.dataTable.defaults, {
            autoWidth: false,
            columnDefs: [{

                width: 100,
                // targets: [0]
            }],
            dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
            language: {
                search: `_INPUT_`,
                searchPlaceholder: pashayev.translate('common.typeToFilter'),
                lengthMenu: `<span>${pashayev.translate('common.show')}:</span> _MENU_`,
                paginate: { 'first': 'First', 'last': 'Last', 'next': $('html').attr('dir') == 'rtl' ? '&larr;' : '&rarr;', 'previous': $('html').attr('dir') == 'rtl' ? '&rarr;' : '&larr;' }
            },
            fnPreDrawCallback: function( oSettings ) { // before draw
                let selects = $(document).find('.form-check-input-styled');
                selects.uniform();
            },
            fnDrawCallback: function(){ //after draw
                $(document).find('[name="selecteds"]').trigger('selected');
            }
        });

        //Pashayev Datatable

        $('.datatable-with-row-group').DataTable({
            columnDefs: [
                {
                    targets: 'no-sort',
                    orderable: false
                },

                {
                    targets:$('.datatable-with-row-group').data("group"),
                    visible:true
                }

            ],
            rowGroup: {
                dataSrc: $('.datatable-with-row-group').data("group")
            }
        });

        // Basic datatable
        $('.datatable-basic').DataTable({
            columnDefs: [{
                targets: 'no-sort',
                orderable: false,
            }],
            order: [[ 1, "asc" ]]
        });

        $('.datatable-basic-no-order').DataTable({
            columnDefs: [{
                targets: 'no-sort',
                orderable: false,
            }]
        });

        if(manualTableClass){
            $(manualTableClass).DataTable({
                columnDefs: [{
                    targets: 'no-sort',
                    orderable: false,
                }],
                order: [[ 1, "asc" ]]
            });
        }


        $.fn.table = function(order=null,sort='asc'){
            this.DataTable({
                columnDefs : [{
                    targets: 'no-sort',
                    orderable: false,
                }],
                order: [[ order||1, sort ]]
            });
        };


        // Alternative pagination
        $('.datatable-pagination').DataTable({
            pagingType: "simple",
            language: {
                paginate: {'next': $('html').attr('dir') == 'rtl' ? 'Next &larr;' : 'Next &rarr;', 'previous': $('html').attr('dir') == 'rtl' ? '&rarr; Prev' : '&larr; Prev'}
            }
        });

        // Datatable with saving state
        $('.datatable-save-state').DataTable({
            stateSave: true
        });

        // Scrollable datatable
        var table = $('.datatable-scroll-y').DataTable({
            autoWidth: true,
            scrollY: 300
        });

        // Resize scrollable table when sidebar width changes
        $('.sidebar-control').on('click', function() {
            table.columns.adjust().draw();
        });
    };

    // Select2 for length menu styling
    var _componentSelect2 = function() {
        if (!$().select2) {
            console.warn('Warning - select2.min.js is not loaded.');
            return;
        }

        // Initialize
        $('.dataTables_length select').select2({
            minimumResultsForSearch: Infinity,
            dropdownAutoWidth: true,
            width: 'auto'
        });
    };


    //
    // Return objects assigned to module
    //

    return {
        init: function() {
            _componentDatatableBasic();
            _componentSelect2();
        },
        initManually: function(tableClass){
            _componentDatatableBasic(tableClass);
            _componentSelect2();
        }
    }
}();


// Initialize module
// ------------------------------

document.addEventListener('DOMContentLoaded', function() {
    DatatableBasic.init();
});
