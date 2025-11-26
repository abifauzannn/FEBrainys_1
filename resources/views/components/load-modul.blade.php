<div class="mb-4 form-group">
    <label for="history">Load Modul Ajar</label>

    <div class="relative w-full mt-3 custom-select-wrapper">
        <button type="button" id="history-btn" class="w-full custom-select-button">
            <span id="history-btn-text" class="custom-select-text">Pilih Modul Ajar</span>
            <svg class="custom-select-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="6 9 12 15 18 9"></polyline>
            </svg>
        </button>

        <input type="hidden" id="history" name="history">

        <div id="history-dropdown" class="hidden custom-select-dropdown">
            <div class="custom-select-search">
                <input type="text" id="history-search" class="custom-select-search-input"
                    placeholder="Cari Modul...">
            </div>

            <ul id="history-list" class="custom-select-list">
                <li class="custom-select-empty">Loading...</li>
            </ul>
        </div>
    </div>
</div>


<script>
    (function() {

        let historyData = [];
        let loading = false;
        let loaded = false;

        const btn = $("#history-btn");
        const dropdown = $("#history-dropdown");
        const list = $("#history-list");
        const search = $("#history-search");

        const skeleton = `<li class='custom-select-empty animate-pulse'>Sedang memuat modul...</li>`;
        const errorState = `
        <li class="custom-select-empty text-red-600">
            Gagal memuat.
            <button id="history-retry" class="text-blue-600 underline ml-1">Retry</button>
        </li>
    `;

        function truncate(text, max = 32) {
            return text.length > max ? text.substring(0, max) + "..." : text;
        }

        function fetchHistory() {
            if (loading || loaded) return;

            loading = true;
            list.html(skeleton);

            $.ajax({
                url: "{{ route('loadModul') }}",
                method: "GET",
                timeout: 7000,
                success: (res) => {
                    loading = false;
                    loaded = true;

                    const items = res.data.items;

                    if (!items.length) {
                        list.html(`<li class='custom-select-empty'>Tidak ada modul</li>`);
                        return;
                    }

                    historyData = items;

                    list.html(
                        items.map(i => `
                        <li class="history-item custom-select-item" data-id="${i.id}">
                            ${i.name} - ${i.subject}
                        </li>
                    `).join("")
                    );

                    $(".history-item").on("click", function() {
                        selectHistory($(this).data("id"));
                    });
                },
                error: () => {
                    loading = false;
                    list.html(errorState);
                    $("#history-retry").on("click", fetchHistory);
                }
            });
        }

        function selectHistory(id) {
            const item = historyData.find(x => x.id == id);
            $("#history").val(id);
            $("#history-btn-text").text(truncate(item.name + " - " + item.subject));
            closeDropdown();
        }

        function closeDropdown() {
            dropdown.addClass("hidden");
            btn.removeClass("active");
        }

        // buka dropdown
        btn.on("click", function(e) {
            e.stopPropagation();

            const open = !dropdown.hasClass("hidden");

            $(".custom-select-dropdown").addClass("hidden");
            $(".custom-select-button").removeClass("active");

            if (!open) {
                dropdown.removeClass("hidden");
                btn.addClass("active");

                search.focus();
                fetchHistory();
            }
        });

        // search
        let sTimeout;
        search.on("input", function() {
            clearTimeout(sTimeout);
            sTimeout = setTimeout(() => {
                const q = this.value.toLowerCase();
                $(".history-item").each(function() {
                    $(this).toggle($(this).text().toLowerCase().includes(q));
                });
            }, 120);
        });

        // klik di luar
        document.addEventListener("click", (e) => {
            if (!e.target.closest(".custom-select-wrapper")) closeDropdown();
        });

    })();
</script>
