<script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
<script>
    $(document).ready( function () {

        var table = $('#myTable').DataTable({
            scrollY: '50vh',
            scrollCollapse: true,
            "dom": '"top"i',
            "bPaginate": false,
            "bFilter": true,
            "bInfo": false,
            "bAutoWidth": true,
        });

        // Handle department filter change
        $('#dept-select').on('change', function () {
            var deptValue = $(this).val();

            // Clear existing search filter
            table.search('').draw();

            // Set new search filter
            if (deptValue !== 'Select Department') {
                table.column(0).search(deptValue, true, false).draw();
            }
        });

        $('#search-input').on('keyup', function() {
            var value = $(this).val().toLowerCase();
            $('#myTable tbody tr').filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
        $('#rq, #rq_prog').DataTable({
            "bPaginate": false,
            "bLengthChange": false,
            "bFilter": true,
            "bInfo": false,
            "bAutoWidth": true,
        });
        $('#deptTable').DataTable({
            "bPaginate": false,
            "bLengthChange": false,
            "bFilter": true,
            "bInfo": false,
            "bAutoWidth": true,
        });
        $('#courseTable').DataTable({
            "bPaginate": false,
            "bLengthChange": false,
            "bFilter": true,
            "bInfo": false,
            "bAutoWidth": true,
        });

        $('#certable').dataTable({
            "bPaginate": false,
            "bLengthChange": false,
            "bFilter": true,
            "bInfo": false,
            "bAutoWidth": true });
    });
</script>