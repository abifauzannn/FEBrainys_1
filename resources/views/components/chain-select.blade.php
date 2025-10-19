<p id="schoolLevel" class="hidden">{{ session('user')['school_level'] }}</p>

<div class="mb-4 form-group">
    <label for="fase" class="text-gray-900 text-base font-['Inter'] mb-[30px] leading-normal font-semibold">Fase
        (Kelas)</label>
    <select id="fase" name="fase" required
        class="bg-white mt-[10px] font-['Inter'] shadow appearance-none border border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        <option value="" class="">Select Fase</option>
    </select>
</div>

<div class="mb-4 form-group">
    <label for="mata-pelajaran"
        class="text-gray-900 text-base font-['Inter'] mb-[30px] leading-normal font-semibold">Mata Pelajaran
    </label>
    <select id="mata-pelajaran"
        name="mata-pelajaran"class="bg-white font-['Inter'] mt-[10px] shadow appearance-none  border border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        required disabled>
        <option value="" class="font">Select Mata Pelajaran</option>
    </select>
</div>

<div class="mb-4 form-group">
    <label for="element" class="text-gray-900 text-base font-['Inter'] mb-[30px] leading-normal font-semibold">Elemen
        Capaian
    </label>
    <select id="element"
        name="element"class="bg-white font-['Inter'] mt-[10px] shadow appearance-none  border border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        required disabled>
        <option value="" class="font">Select Element</option>
    </select>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        var API_URL = 'https://be.brainys.oasys.id/api';
        var sessionLevel = $("#schoolLevel").text().trim();
        console.log("Session Level:", sessionLevel); // Ambil session dari HTML
        // var API_URL = 'http://127.0.0.1:8000/api';

        // Fetch Fase
        $.ajax({
            url: API_URL + "/capaian-pembelajaran/fase",
            method: "POST",
            success: function(response) {
                console.log("Fase Response:", response); // Debugging di Console

                if (response.status === "success") {
                    let filteredData = response.data;

                    // Filter hanya untuk SD (Fase A, B, C)
                    if (sessionLevel === "sd" || sessionLevel === "paketa") {
                        filteredData = response.data.filter(item =>
                            item.fase.includes("Fase A") ||
                            item.fase.includes("Fase B") ||
                            item.fase.includes("Fase C")
                        );
                    }

                    if (sessionLevel === "smp" || sessionLevel === "paketb") {
                        filteredData = response.data.filter(item =>
                            item.fase.includes("Fase D")
                        );
                    }

                    if (sessionLevel === "sma" || sessionLevel === "smk" ||
                        sessionLevel === "paketc") {
                        filteredData = response.data.filter(item =>
                            item.fase.includes("Fase E") || item.fase.includes("Fase F")
                        );
                    }


                    // Tambahkan opsi ke dropdown
                    filteredData.forEach(function(item) {
                        $("#fase").append(new Option(item.fase, item.fase));
                    });
                }
            },
        });

        // Fetch Mata Pelajaran based on Fase
        $("#fase").on("change", function() {
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
                    data: JSON.stringify({
                        fase: fase
                    }),
                    success: function(response) {
                        if (response.status === "success") {
                            $("#mata-pelajaran").prop("disabled", false);
                            response.data.forEach(function(item) {
                                $("#mata-pelajaran").append(
                                    new Option(item.mata_pelajaran, item
                                        .mata_pelajaran)
                                );
                            });
                        }
                    },
                });
            }
        });

        // Fetch Element based on Mata Pelajaran and Fase
        $("#mata-pelajaran").on("change", function() {
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
                    success: function(response) {
                        if (response.status === "success") {
                            $("#element").prop("disabled", false);
                            response.data.forEach(function(item) {
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
        $("#element").on("change", function() {
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
                    success: function(response) {
                        if (response.status === "success") {
                            if (response.data) {
                                $("#capaian-pembelajaran").val(response.data
                                    .capaian_pembelajaran || "No data available");
                                $("#capaian-pembelajaran-redaksi").val(response.data
                                    .capaian_pembelajaran_redaksi || "No data available"
                                );
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
