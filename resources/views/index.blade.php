@extends('layouts.app')

@section('content')
<div class="container">
<div id="container">
<body>
    <h1>Gerenciador de Despesas</h1>

    <h2>Categorias</h2>
    <div id="categories">
        <input type="text" id="categoryName" placeholder="Nome da Categoria">
        <input type="number" id="categoryValue" placeholder="Valor da Categoria">
        <button onclick="addCategory()">Adicionar Categoria</button>
    </div>

    <h2>Despesas</h2>
    <table id="expenses">
        <tr>
        </tr>
    </table>

    <script>
        const categories = [];
        
        function addCategory() {
            const categoryName = document.getElementById('categoryName').value;
            const categoryValue = parseFloat(document.getElementById('categoryValue').value);

            if (categoryName && !isNaN(categoryValue)) {
                categories.push({ name: categoryName, value: categoryValue });
                updateCategoriesTable();
                document.getElementById('categoryName').value = '';
                document.getElementById('categoryValue').value = '';
            }
        }

        function updateCategoriesTable() {
            const table = document.getElementById('expenses');
            table.innerHTML = `
                <tr>
                    <th>Categoria || </th>
                    <th>Valor || </th>
                    <th>Ações</th>
                </tr>
            `;

            categories.forEach((category, index) => {
                const row = table.insertRow();
                const cell1 = row.insertCell(0);
                const cell2 = row.insertCell(1);
                const cell3 = row.insertCell(2);

                cell1.innerHTML = category.name;
                cell2.innerHTML = category.value.toFixed(2);
                cell3.innerHTML = `<button onclick="editCategory(${index})">Editar</button> <button onclick="deleteCategory(${index})">Apagar</button>`;
            });
        }

        function editCategory(index) {
            const newName = prompt('Novo nome da categoria:');
            const newValue = parseFloat(prompt('Novo valor da categoria:'));

            if (newName && !isNaN(newValue)) {
                categories[index].name = newName;
                categories[index].value = newValue;
                updateCategoriesTable();
            }
        }

        function deleteCategory(index) {
            if (confirm('Tem certeza de que deseja apagar esta categoria?')) {
                categories.splice(index, 1);
                updateCategoriesTable();
            }
        }
    </script>
</div>
@endsection
