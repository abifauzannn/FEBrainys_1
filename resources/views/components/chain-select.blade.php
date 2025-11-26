<div>
    <p id="schoolLevel" class="hidden">{{ session('user')['school_level'] }}</p>

    <!-- FASE DROPDOWN -->
    <div class="mb-4 form-group">
        <label for="fase">Fase (Kelas)</label>
        <div class="relative w-full mt-3 custom-select-wrapper">
            <button type="button" id="faseBtn" class="w-full custom-select-button">
                <span id="faseBtnText" class="custom-select-text">Select Fase</span>
                <svg class="custom-select-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2">
                    <polyline points="6 9 12 15 18 9"></polyline>
                </svg>
            </button>
            <input type="hidden" id="fase" name="fase" required>

            <div id="faseDropdown" class="hidden custom-select-dropdown">
                <div class="custom-select-search">
                    <input type="text" id="faseSearch" class="custom-select-search-input" placeholder="Cari Fase...">
                </div>
                <ul id="faseList" class="custom-select-list">
                    <li class="custom-select-empty">Loading...</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- MATA PELAJARAN DROPDOWN -->
    <div class="mb-4 form-group lg:max-w-[500px]">
        <label for="mata-pelajaran">Mata Pelajaran</label>
        <div class="relative w-full mt-3 custom-select-wrapper">
            <button type="button" id="mataBtn" class="w-full custom-select-button" disabled>
                <span id="mataBtnText" class="custom-select-text">Select Mata Pelajaran</span>
                <svg class="custom-select-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2">
                    <polyline points="6 9 12 15 18 9"></polyline>
                </svg>
            </button>
            <input type="hidden" id="mata-pelajaran" name="mata-pelajaran" required>

            <div id="mataDropdown" class="hidden custom-select-dropdown">
                <div class="custom-select-search">
                    <input type="text" id="mataSearch" class="custom-select-search-input"
                        placeholder="Cari Mata Pelajaran...">
                </div>
                <ul id="mataList" class="custom-select-list">
                    <li class="custom-select-empty">Select Fase terlebih dahulu</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- ELEMEN CAPAIAN DROPDOWN -->
    <div class="mb-4 form-group">
        <label for="element">Elemen Capaian</label>
        <div class="relative w-full mt-3 custom-select-wrapper">
            <button type="button" id="elementBtn" class="w-full custom-select-button" disabled>
                <span id="elementBtnText" class="custom-select-text">Select Element</span>
                <svg class="custom-select-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2">
                    <polyline points="6 9 12 15 18 9"></polyline>
                </svg>
            </button>
            <input type="hidden" id="element" name="element" required>

            <div id="elementDropdown" class="hidden custom-select-dropdown">
                <div class="custom-select-search">
                    <input type="text" id="elementSearch" class="custom-select-search-input"
                        placeholder="Cari Element...">
                </div>
                <ul id="elementList" class="custom-select-list">
                    <li class="custom-select-empty">Select Mata Pelajaran terlebih dahulu</li>
                </ul>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        const API_URL = 'https://be.brainys.oasys.id/api';
        const sessionLevel = $("#schoolLevel").text().trim();

        // Data storage
        let faseData = [];
        let mataData = {};
        let elementData = {};

        // Helper: Format text untuk button
        function truncateText(text, maxLength = 30) {
            return text.length > maxLength ? text.substring(0, maxLength) + '...' : text;
        }

        // Initialize dropdowns
        function initDropdown(triggerId, dropdownId, listId, searchId) {
            const trigger = document.getElementById(triggerId);
            const dropdown = document.getElementById(dropdownId);
            const search = document.getElementById(searchId);
            const list = document.getElementById(listId);

            trigger.addEventListener('click', (e) => {
                e.preventDefault();
                const isOpen = !dropdown.classList.contains('hidden');
                closeAllDropdowns();
                if (!isOpen) {
                    dropdown.classList.remove('hidden');
                    trigger.classList.add('active');
                    search.focus();
                }
            });

            search.addEventListener('input', (e) => {
                const query = e.target.value.toLowerCase();
                const items = list.querySelectorAll('.custom-select-item');
                items.forEach(item => {
                    const text = item.textContent.toLowerCase();
                    item.style.display = text.includes(query) ? 'block' : 'none';
                });
            });
        }

        function closeAllDropdowns() {
            document.querySelectorAll('.custom-select-dropdown').forEach(el => {
                el.classList.add('hidden');
            });
            document.querySelectorAll('.custom-select-button').forEach(el => {
                el.classList.remove('active');
            });
        }

        // Load Fase
        $.ajax({
            url: API_URL + "/capaian-pembelajaran/fase",
            method: "POST",
            success: function(response) {
                if (response.status === "success") {
                    faseData = response.data.filter(i => {
                        if (sessionLevel === "sd" || sessionLevel === "paketa") {
                            return i.fase.includes("Fase A") || i.fase.includes("Fase B") || i.fase
                                .includes("Fase C");
                        }
                        if (sessionLevel === "smp" || sessionLevel === "paketb") {
                            return i.fase.includes("Fase D");
                        }
                        if (sessionLevel === "sma" || sessionLevel === "smk" || sessionLevel ===
                            "paketc") {
                            return i.fase.includes("Fase E") || i.fase.includes("Fase F");
                        }
                        return true;
                    });

                    const faseList = document.getElementById('faseList');
                    faseList.innerHTML = faseData.map(item =>
                        `<li class="custom-select-item" data-value="${item.fase}">${item.fase}</li>`
                    ).join('');

                    // Attach event listeners
                    document.querySelectorAll('#faseList .custom-select-item').forEach(item => {
                        item.addEventListener('click', () => selectFase(item.dataset.value));
                    });
                }
            }
        });

        function selectFase(value) {
            document.getElementById('fase').value = value;
            document.getElementById('faseBtnText').textContent = truncateText(value);
            closeAllDropdowns();
            document.getElementById('faseBtn').classList.remove('active');

            // Load Mata Pelajaran
            $.ajax({
                url: API_URL + "/capaian-pembelajaran/mata-pelajaran",
                method: "POST",
                contentType: "application/json",
                data: JSON.stringify({
                    fase: value
                }),
                success: function(response) {
                    if (response.status === "success") {
                        mataData[value] = response.data;
                        const mataList = document.getElementById('mataList');
                        mataList.innerHTML = response.data.map(item =>
                            `<li class="custom-select-item" data-value="${item.mata_pelajaran}">${item.mata_pelajaran}</li>`
                        ).join('');

                        document.getElementById('mataBtn').disabled = false;
                        document.getElementById('mataBtn').classList.remove('active');
                        document.getElementById('mataBtnText').textContent = 'Select Mata Pelajaran';
                        document.getElementById('mata-pelajaran').value = '';

                        document.querySelectorAll('#mataList .custom-select-item').forEach(item => {
                            item.addEventListener('click', () => selectMata(item.dataset.value));
                        });
                    }
                }
            });
        }

        function selectMata(value) {
            document.getElementById('mata-pelajaran').value = value;
            document.getElementById('mataBtnText').textContent = truncateText(value);
            closeAllDropdowns();
            document.getElementById('mataBtn').classList.remove('active');

            const fase = document.getElementById('fase').value;

            // Load Element
            $.ajax({
                url: API_URL + "/capaian-pembelajaran/element",
                method: "POST",
                contentType: "application/json",
                data: JSON.stringify({
                    fase,
                    mata_pelajaran: value
                }),
                success: function(response) {
                    if (response.status === "success") {
                        const elementList = document.getElementById('elementList');
                        elementList.innerHTML = response.data.map(item =>
                            `<li class="custom-select-item" data-value="${item.element}">${item.element}</li>`
                        ).join('');

                        document.getElementById('elementBtn').disabled = false;
                        document.getElementById('elementBtn').classList.remove('active');
                        document.getElementById('elementBtnText').textContent = 'Select Element';
                        document.getElementById('element').value = '';

                        document.querySelectorAll('#elementList .custom-select-item').forEach(item => {
                            item.addEventListener('click', () => selectElement(item.dataset.value));
                        });
                    }
                }
            });
        }

        function selectElement(value) {
            document.getElementById('element').value = value;
            document.getElementById('elementBtnText').textContent = value;
            closeAllDropdowns();
            document.getElementById('elementBtn').classList.remove('active');
        }

        // Initialize
        initDropdown('faseBtn', 'faseDropdown', 'faseList', 'faseSearch');
        initDropdown('mataBtn', 'mataDropdown', 'mataList', 'mataSearch');
        initDropdown('elementBtn', 'elementDropdown', 'elementList', 'elementSearch');

        // Close dropdowns when clicking outside
        document.addEventListener('click', (e) => {
            const isClickInside = e.target.closest('.custom-select-wrapper');
            if (!isClickInside) {
                closeAllDropdowns();
            }
        });

        const toggle = document.getElementById("disableToggle");
        const group = document.getElementById("toggleHiddenGroup");

        const fase = document.getElementById('fase');
        const mapel = document.getElementById('mata-pelajaran');
        const element = document.getElementById('element');
        const topik = document.getElementById('topik_pembelajaran');

        toggle.addEventListener("change", function() {
            if (this.checked) {
                group.style.display = "none";

                if (fase) fase.value = "";
                if (mapel) mapel.value = "";
                if (element) element.value = "";
                if (topik) topik.value = "";

                // Reset text button-nya juga
                const faseBtnText = document.getElementById("faseBtnText");
                const mataBtnText = document.getElementById("mataBtnText");
                const elementBtnText = document.getElementById("elementBtnText");

                if (faseBtnText) faseBtnText.textContent = "Select Fase";
                if (mataBtnText) mataBtnText.textContent = "Select Mata Pelajaran";
                if (elementBtnText) elementBtnText.textContent = "Select Element";

            } else {
                group.style.display = "block";
            }
        });
    </script>
</div>
