function showSection(sectionId) {
    document.querySelectorAll('.section').forEach(section => {
        section.classList.remove('active');
    });

    document.getElementById(sectionId).classList.add('active');
}

function deleteRow(button) {
    const row = button.parentElement.parentElement;
    row.remove();
}

function addRow() {
    const table = document.getElementById("perguntasTable").getElementsByTagName('tbody')[0];
    const rowCount = table.rows.length + 1;
    const newRow = table.insertRow();

    newRow.innerHTML = `
        <td>${rowCount}</td>
        <td><input type="text" name="pergunta[${rowCount}]" placeholder="Digite a nova pergunta"></td>
        <td><input type="checkbox" name="ativo[${rowCount}]"></td>
        <td><button type="button" class="action-btn" onclick="deleteRow(this)">Excluir</button></td>
    `;
}

function toggleSubTable(button) {
    const parentRow = button.closest('tr');
    const subTableRow = parentRow.nextElementSibling;
    
    if (subTableRow.style.display === "none" || subTableRow.style.display === "") {
        subTableRow.style.display = "table-row";
    } else {
        subTableRow.style.display = "none";
    }
}