<script src="{{ asset('assets/backend/assets/libs/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/backend/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/backend/assets/libs/metismenu/metisMenu.min.js') }}"></script>
<script src="{{ asset('assets/backend/assets/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('assets/backend/assets/libs/node-waves/waves.min.js') }}"></script>


<!-- apexcharts -->
<script src="{{ asset('assets/backend/assets/libs/apexcharts/apexcharts.min.js') }}"></script>

<!-- jquery.vectormap map -->
<script src="{{ asset('assets/backend/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ asset('assets/backend/assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-us-merc-en.js') }}"></script>

<!-- Required datatable js -->
<script src="{{ asset('assets/backend/assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/backend/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

<script src="{{ asset('assets/backend/assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
<script src="{{ asset('assets/backend/assets/libs/datatables.net-select/js/dataTables.select.min.js') }}"></script>

<!-- Responsive examples -->
<script src="{{ asset('assets/backend/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/backend/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

<!-- Datatable init js -->
<script src="{{ asset('assets/backend/assets/js/pages/datatables.init.js') }}"></script>

<script src="{{ asset('assets/backend/assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<!-- Table Editable plugin -->
<script src="{{ asset('assets/backend/assets/libs/table-edits/build/table-edits.min.js') }}"></script>

<script src="{{ asset('assets/backend/assets/js/pages/table-editable.init.js') }}"></script>

<!--tinymce js-->
<script src="{{ asset('assets/backend/assets/libs/tinymce/tinymce.min.js') }}"></script>

<!-- init js -->
<script src="{{ asset('assets/backend/assets/js/pages/form-editor.init.js') }}"></script>

<!-- App js -->
<script src="{{ asset('assets/backend/assets/js/app.js') }}"></script>

<script src="{{ asset('assets/backend/assets/js/code.js') }}"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" ></script>

<script>
    @if(Session::has('message'))
    var type = "{{ Session::get('alert-type','info') }}"
    switch (type){
        case 'info' :
            toastr.info("{{ Session::get('message') }}");
            break;

        case 'success' :

            toastr.success("{{ Session::get('message') }}");
            break;

        case 'warning' :
            toastr.warning("{{ Session::get('message') }}");
            break;

        case 'error' :
            toastr.error("{{ Session::get('message') }}");
            break;
    }
    @endif
</script>
