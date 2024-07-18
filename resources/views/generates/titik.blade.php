<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Capaian Pembelajaran - Chain Select</title>
    <link
        rel="stylesheet"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Capaian Pembelajaran - Chain Select</h2>
        <form>
            <div class="form-group">
                <label for="fase">Fase</label>
                <select id="fase" class="form-control">
                    <option value="">Select Fase</option>
                </select>
            </div>
            <div class="form-group">
                <label for="mata-pelajaran">Mata Pelajaran</label>
                <select id="mata-pelajaran" class="form-control" disabled>
                    <option value="">Select Mata Pelajaran</option>
                </select>
            </div>
            <div class="form-group">
                <label for="element">Element</label>
                <select id="element" class="form-control" disabled>
                    <option value="">Select Element</option>
                </select>
            </div>
            <div class="form-group">
                <label for="capaian-pembelajaran">Capaian Pembelajaran</label>
                <textarea id="capaian-pembelajaran" class="form-control" rows="5" readonly></textarea>
            </div>
            <div class="form-group">
                <label for="capaian-pembelajaran-redaksi">Capaian Pembelajaran Redaksi</label>
                <textarea id="capaian-pembelajaran-redaksi" class="form-control" rows="5" readonly></textarea>
            </div>
        </form>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            var API_URL = 'https://testing.brainys.oasys.id/api';
            // var API_URL = 'http://127.0.0.1:8000/api';

            // Fetch Fase
            $.ajax({
                url: API_URL + "/capaian-pembelajaran/fase",
                method: "POST",
                success: function (response) {
                    if (response.status === "success") {
                        response.data.forEach(function (item) {
                            $("#fase").append(new Option(item.fase, item.fase));
                        });
                    }
                },
            });

            // Fetch Mata Pelajaran based on Fase
            $("#fase").on("change", function () {
                let fase = $(this).val();
                $("#mata-pelajaran")
                    .prop("disabled", true)
                    .empty()
                    .append(new Option("Select Mata Pelajaran", ""));

                if (fase) {
                    $.ajax({
                        url: API_URL + "/capaian-pembelajaran/mata-pelajaran",
                        method: "POST",
                        contentType: "application/json",
                        data: JSON.stringify({ fase: fase }),
                        success: function (response) {
                            if (response.status === "success") {
                                $("#mata-pelajaran").prop("disabled", false);
                                response.data.forEach(function (item) {
                                    $("#mata-pelajaran").append(
                                        new Option(item.mata_pelajaran, item.mata_pelajaran)
                                    );
                                });
                            }
                        },
                    });
                }
            });

            // Fetch Element based on Mata Pelajaran and Fase
            $("#mata-pelajaran").on("change", function () {
                let fase = $("#fase").val();
                let mataPelajaran = $(this).val();
                $("#element")
                    .prop("disabled", true)
                    .empty()
                    .append(new Option("Select Element", ""));

                if (fase && mataPelajaran) {
                    $.ajax({
                        url: API_URL + "/capaian-pembelajaran/element",
                        method: "POST",
                        contentType: "application/json",
                        data: JSON.stringify({
                            fase: fase,
                            mata_pelajaran: mataPelajaran,
                        }),
                        success: function (response) {
                            if (response.status === "success") {
                                $("#element").prop("disabled", false);
                                response.data.forEach(function (item) {
                                    $("#element").append(
                                        new Option(item.element, item.element)
                                    );
                                });
                            }
                        },
                    });
                }
            });

            // Fetch Capaian Pembelajaran and Capaian Pembelajaran Redaksi based on Element
            $("#element").on("change", function () {
                let fase = $("#fase").val();
                let mataPelajaran = $("#mata-pelajaran").val();
                let element = $(this).val();

                if (fase && mataPelajaran && element) {
                    $.ajax({
                        url: API_URL + "/capaian-pembelajaran/final",
                        method: "POST",
                        contentType: "application/json",
                        data: JSON.stringify({
                            fase: fase,
                            mata_pelajaran: mataPelajaran,
                            element: element,
                        }),
                        success: function (response) {
                            if (response.status === "success") {
                                if (response.data) {
                                    $("#capaian-pembelajaran").val(response.data.capaian_pembelajaran || "No data available");
                                    $("#capaian-pembelajaran-redaksi").val(response.data.capaian_pembelajaran_redaksi || "No data available");
                                } else {
                                    $("#capaian-pembelajaran").val("No data available");
                                    $("#capaian-pembelajaran-redaksi").val("No data available");
                                }
                            } else {
                                $("#capaian-pembelajaran").val("Error retrieving data");
                                $("#capaian-pembelajaran-redaksi").val("Error retrieving data");
                            }
                        },
                    });
                }
            });
        });
    </script>
</body>
</html>
