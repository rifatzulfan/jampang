<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>JAMPANG | UABVUB</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/form-pinjam.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}" type="text/css">

    <link href="https://api.fontshare.com/v2/css?f[]=satoshi@900,700,500,300,400&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.5/index.global.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <!-- jQuery UI library -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/smoothness/jquery-ui.css" />
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>

</head>

<body>

    @yield('content')


    <script>
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    </script>
    <script>
        $(document).ready(function() {
            // Handle dropdown item click event
            $(".dd-menu li").click(function() {
                // Get selected status
                var status = $(this).data("status");
                // Show/hide table rows based on selected status
                if (status == "all") {
                    $("#myTable tbody tr").show();
                } else {
                    $("#myTable tbody tr")
                        .hide()
                        .filter(function() {
                            // Compare search term with status text
                            var statusText = $(this)
                                .find("td")
                                .filter(function() {
                                    return $(this)
                                        .text()
                                        .toLowerCase()
                                        .includes(status.toLowerCase());
                                })
                                .first()
                                .text()
                                .toLowerCase();
                            return statusText === status.toLowerCase();
                        })
                        .show();
                }
            });
        });
    </script>

    <script>
        function exportTableToCSV(filename) {
            var csv = [];
            var rows = $("#myTable").find("tr");

            // Loop through each row and extract the data
            rows.each(function(index, element) {
                var row = [];
                $(this)
                    .find("td")
                    .each(function() {
                        row.push($(this).text());
                    });
                csv.push(row.join(","));
            });

            // Create a blob object and trigger a download
            var blob = new Blob([csv.join("\n")], {
                type: "text/csv;charset=utf-8;",
            });
            if (navigator.msSaveBlob) {
                // IE 10+
                navigator.msSaveBlob(blob, filename);
            } else {
                var link = document.createElement("a");
                if (link.download !== undefined) {
                    // feature detection
                    // Browsers that support HTML5 download attribute
                    var url = URL.createObjectURL(blob);
                    link.setAttribute("href", url);
                    link.setAttribute("download", filename);
                    link.style.visibility = "hidden";
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                } else {
                    // Browsers that do not support HTML5 download attribute
                    alert(
                        "Your browser does not support this feature. Please use a modern browser to export the table as CSV."
                    );
                }
            }
        }

        $(document).ready(function() {
            // Handle export button click event
            $("#exportBtn").click(function() {
                exportTableToCSV("table.csv");
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $("#cari").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable tbody tr")
                    .filter(function() {
                        // Exclude table head row
                        return !$(this).hasClass("thead-row");
                    })
                    .each(function() {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                    });
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>