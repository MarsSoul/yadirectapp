document.addEventListener("DOMContentLoaded", function () {
    let currentPage = 1;
    let itemsPerPage = 50;

    function displayData() {
        const startIndex = (currentPage - 1) * itemsPerPage;
        const endIndex = startIndex + itemsPerPage;
        const pageData = reportData.slice(startIndex, endIndex);

        const tableBody = document.querySelector("#reportTable tbody");
        tableBody.innerHTML = "";

        pageData.forEach(row => {
            const tr = document.createElement("tr");
            for (const key in row) {
                if (row.hasOwnProperty(key)) {
                    const td = document.createElement("td");
                    td.textContent = row[key];
                    tr.appendChild(td);
                }
            }
            tableBody.appendChild(tr);
        });
    }

    displayData();

    document.getElementById("prevPage").addEventListener("click", () => {
        if (currentPage > 1) {
            currentPage--;
            displayData();
        }
    });

    document.getElementById("nextPage").addEventListener("click", () => {
        const maxPage = Math.ceil(reportData.length / itemsPerPage);
        if (currentPage < maxPage) {
            currentPage++;
            displayData();
        }
    });

    document.getElementById("firstPage").addEventListener("click", () => {
        currentPage = 1;
        displayData();
    });

    document.getElementById("lastPage").addEventListener("click", () => {
        const maxPage = Math.ceil(reportData.length / itemsPerPage);
        currentPage = maxPage;
        displayData();
    });

    function updateItemsPerPage() {
        const input = document.getElementById("itemsPerPage");
        const value = parseInt(input.value, 10);
        if (!isNaN(value) && value >= 1) {
            itemsPerPage = value;
            currentPage = 1;
            displayData();
        }
    }

    document.getElementById("updatePerPage").addEventListener("click", updateItemsPerPage);
});
