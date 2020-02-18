<html>

<head>
    <title>Ajax JQuery Pagination in Codeigniter using Bootstrap</title>
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> -->


</head>

<body>
    <div class="container-fluid">
        <h3 align="center">รายการขอทำโอที</h3>

        <div class="row">
            <div class="col-md-12">
                <div align="center" id="pagination_link"></div>
                <div class="table-responsive" id="country_table"></div>
                <div align="center">
                    <span>รวมทั้งสิ้น</span>&nbsp;<span id="countTotal" class="p-3"></span>&nbsp;<span>รายการ</span>
                </div>
            </div>

        </div>

    </div>
</body>

</html>
<script>
    $(document).ready(function() {

        function load_country_data(page) {
            $.ajax({
                url: "<?php echo base_url(); ?>main/loadlistdata/" + page,
                method: "GET",
                dataType: "json",
                success: function(data) {
                    $('#country_table').html(data.country_table);
                    $('#pagination_link').html(data.pagination_link);
                    $('#countTotal').html(data.countTotal);
                }
            });
        }

        load_country_data(1);

        $(document).on("click", ".pagination li a", function(event) {
            event.preventDefault();
            var page = $(this).data("ci-pagination-page");
            load_country_data(page);
        });

    });
</script>