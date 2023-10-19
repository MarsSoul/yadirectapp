// report_view

function sortTable(table, column, order) {
    const tbody = table.querySelector('tbody');
    const rows = Array.from(tbody.querySelectorAll('tr'));

    rows.sort((rowA, rowB) => {
        const cellA = rowA.querySelectorAll('td')[column].textContent;
        const cellB = rowB.querySelectorAll('td')[column].textContent;

        if (order === 'asc') {
            return cellA.localeCompare(cellB, undefined, { numeric: true });
        } else {
            return cellB.localeCompare(cellA, undefined, { numeric: true });
        }
    });

    rows.forEach(row => tbody.appendChild(row));
}

document.addEventListener('DOMContentLoaded', function () {
    // const table = document.querySelector('table');
    const table = document.querySelector('#reportTable');
    if (table) {
        const headers = table.querySelectorAll('thead th');

        headers.forEach((th, column) => {
            th.addEventListener('click', function () {
                const currentOrder = th.getAttribute('data-order');
                const order = currentOrder === 'asc' ? 'desc' : 'asc';

                headers.forEach(header => header.removeAttribute('data-order'));
                th.setAttribute('data-order', order);

                sortTable(table, column, order);
            });
        });
    }
});

// report_view end
// =====================================================================================================================
// groups_view

document.addEventListener('DOMContentLoaded', function () {
    const groupList = document.querySelector('.group-list');
    if (groupList) {
        const groups = Array.from(groupList.querySelectorAll('.group'));
        const sortButtons = document.querySelectorAll('button[data-sort]');

        sortButtons.forEach(button => {
            button.addEventListener('click', function () {
                const sortField = this.getAttribute('data-sort');
                const sortOrder = this.getAttribute('data-order');

                groups.sort(function (groupA, groupB) {
                    const p1 = getGroupTotal(groupA, sortField);
                    const p2 = getGroupTotal(groupB, sortField);
                    // console.log(sortField);
                    if (sortOrder === 'asc') {
                        return p1 - p2;
                    } else {
                        return p2 - p1;
                    }
                });

                groupList.innerHTML = '';

                groups.forEach(group => groupList.appendChild(group));

                if (sortOrder === 'asc') {
                    this.setAttribute('data-order', 'desc');
                } else {
                    this.setAttribute('data-order', 'asc');
                }
            });
        });

        function getGroupTotal(groupElement, field) {
            const dataElement = groupElement.querySelector(`span[data-field="${field}"]`);
            // console.log(dataElement);
            if (dataElement) {
                // const number = parseInt(dataElement.textContent, 10);
                const number = parseFloat(dataElement.textContent, 10);
                // console.log(number);
                if (!isNaN(number)) {
                    return number;
                }
            }
            return 0;
        }
    }
});

// groups_view end
// =====================================================================================================================
// group_view

document.addEventListener('DOMContentLoaded', function () {
    const groupList = document.querySelector('.ad-list');
    if (groupList) {
        const groups = Array.from(groupList.querySelectorAll('.ad'));
        const sortButtons = document.querySelectorAll('button[data-sort]');

        sortButtons.forEach(button => {
            button.addEventListener('click', function () {
                const sortField = this.getAttribute('data-sort');
                const sortOrder = this.getAttribute('data-order');

                groups.sort(function (groupA, groupB) {
                    const p1 = getGroupTotal(groupA, sortField);
                    const p2 = getGroupTotal(groupB, sortField);
                    // console.log(sortField);
                    if (sortOrder === 'asc') {
                        return p1 - p2;
                    } else {
                        return p2 - p1;
                    }
                });

                groupList.innerHTML = '';

                groups.forEach(group => groupList.appendChild(group));

                if (sortOrder === 'asc') {
                    this.setAttribute('data-order', 'desc');
                } else {
                    this.setAttribute('data-order', 'asc');
                }
            });
        });

        function getGroupTotal(groupElement, field) {
            const dataElement = groupElement.querySelector(`span[data-field="${field}"]`);
            // console.log(dataElement);
            if (dataElement) {
                // const number = parseInt(dataElement.textContent, 10);
                const number = parseFloat(dataElement.textContent, 10);
                // console.log(number);
                if (!isNaN(number)) {
                    return number;
                }
            }
            return 0;
        }
    }
});
// group_view end