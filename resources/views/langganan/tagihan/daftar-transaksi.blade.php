<div class="flex flex-col md:flex-row justify-between">
    <!-- Riwayat Transaksi Section -->
    <div class="w-full h-[756px] overflow-auto rounded-md shadow-lg border">
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 font-['Inter']">
                <thead class="border-b bg-[#F9F9F9]">
                    <tr>
                        <th class="py-4 px-6 text-black">Tanggal</th>
                        <th class="py-4 px-6 text-black">Transaksi</th>
                        <th class="py-4 px-6 text-black">Jumlah</th>
                        <th class="py-4 px-6 text-black text-center">Status</th>
                        <th class="py-4 px-6 text-black"></th>
                    </tr>
                </thead>
                <tbody id="history-container">
                    <!-- Data akan dimuat dengan AJAX -->
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="flex justify-end pr-7 py-10">
            <button id="prev-page" class="px-3 py-1 text-[#637381] border border-gray-200  text- rounded" disabled>
                 < </button>

                    <div id="page-buttons" class="flex gap-1"></div> <!-- Tempat tombol halaman -->

                    <button id="next-page" class="px-3 py-1  text-[#637381] border border-gray-200 rounded" disabled>></button>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script defer>
    $(document).ready(function() {
        let currentPage = 1;
        let totalPages = 1;
        let pageGroupStart = 1;

        function getStatusBadge(status) {
            switch (status) {
                case 'completed':
                    return `<span class='py-1 px-3 bg-green-100 text-green-800 rounded-full'>Dibayar</span>`;
                case 'canceled':
                    return `<span class='py-1 px-3 bg-red-100 text-red-800 rounded-full'>Gagal dibayar</span>`;
                case 'pending':
                    return `<span class='py-1 px-3 bg-yellow-100 text-yellow-800 rounded-full'>Menunggu Pembayaran</span>`;
                default:
                    return `<span class='py-1 px-3 bg-gray-100 text-gray-800 rounded-full'>Unknown</span>`;
            }
        }

        function fetchHistory(page) {
            $.ajax({
                url: "/history/fetch",
                type: "GET",
                data: {
                    page: page
                },
                success: function(response) {
                    let historyContainer = $("#history-container");
                    historyContainer.empty();
                    totalPages = response.pagination.last_page;

                    if (response.data.length > 0) {
                        response.data.forEach(item => {
                            let invoiceButton = item.status === 'completed' ? `
                                <form method="POST" action="{{ route('export.invoice') }}" target="_blank" onclick="event.stopPropagation();">
                                    @csrf
                                    <input type="hidden" name="generateId" value="${item.id}">
                                    <button type="submit" class="py-2 px-4 bg-white border rounded-full flex items-center justify-center gap-2">
                                        <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M14.707 7.793a1 1 0 0 0-1.414 0L11 10.086V1.5a1 1 0 0 0-2 0v8.586L6.707 7.793a1 1 0 1 0-1.414 1.414l4 4a1 1 0 0 0 1.416 0l4-4a1 1 0 0 0-.002-1.414Z" />
                                            <path d="M18 12h-2.55l-2.975 2.975a3.5 3.5 0 0 1-4.95 0L4.55 12H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2Zm-3 5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z" />
                                        </svg>
                                        Invoice
                                    </button>
                                </form>` : "";

                            historyContainer.append(`
                                <tr class="bg-white border-b cursor-pointer hover:bg-gray-50" onclick="window.location='/order/detail/${item.transaction_code}'">
                                    <td class="px-6 py-4 text-[13px]">${item.transaction_date}</td>
                                    <td class="px-3 py-4 text-[13px]">${item.transaction_name}<br>${item.transaction_code}</td>
                                    <td class="px-6 py-4 text-[13px]">Rp ${new Intl.NumberFormat('id-ID').format(item.amount_total)}</td>
                                    <td class="px-[10px] py-4 text-[13px] flex justify-center items-center">${getStatusBadge(item.status)}</td>
                                    <td class="px-6 py-4 text-[13px]">${invoiceButton}</td>
                                </tr>
                            `);
                        });

                        updatePagination();
                    } else {
                        historyContainer.html("<tr><td colspan='5' class='text-center py-4'>Tidak ada data riwayat.</td></tr>");
                    }
                },
                error: function() {
                    $("#history-container").html("<tr><td colspan='5' class='text-center py-4'>Gagal mengambil data.</td></tr>");
                }
            });
        }

        function updatePagination() {
            let pageButtonsContainer = $("#page-buttons");
            pageButtonsContainer.empty();

            let startPage = Math.max(1, currentPage - 2);
            let endPage = Math.min(totalPages, startPage + 4);

            for (let i = startPage; i <= endPage; i++) {
                let button = $(`<button class="px-3 py-1 border ${i === currentPage ? 'bg-blue-600 text-white font-bold' : 'bg-white'} rounded">${i}</button>`);
                button.on("click", function() {
                    currentPage = i;
                    fetchHistory(currentPage);
                });
                pageButtonsContainer.append(button);
            }

            $("#prev-page").prop("disabled", currentPage === 1);
            $("#next-page").prop("disabled", currentPage === totalPages);

            $("#prev-page").off("click").on("click", function() {
                if (currentPage > 1) {
                    currentPage--;
                    fetchHistory(currentPage);
                }
            });

            $("#next-page").off("click").on("click", function() {
                if (currentPage < totalPages) {
                    currentPage++;
                    fetchHistory(currentPage);
                }
            });
        }


        fetchHistory(currentPage);
    });
</script>