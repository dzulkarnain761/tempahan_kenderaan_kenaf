<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editable Table Row</title>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 8px;
        }
    </style>
</head>
<body>

    <table id="myTable">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td contenteditable="true">John Doe</td>
                <td contenteditable="true">john@example.com</td>
                <td><button onclick="saveRow(this)">Save</button></td>
            </tr>
            <tr>
                <td contenteditable="true">Jane Smith</td>
                <td contenteditable="true">jane@example.com</td>
                <td><button onclick="saveRow(this)">Save</button></td>
            </tr>
        </tbody>
    </table>

    <script>
        function saveRow(button) {
            var row = button.closest('tr');  // Get the row of the clicked button
            var cells = row.querySelectorAll('td');

            // Loop through the cells and print the updated data
            for (let i = 0; i < cells.length - 1; i++) {
                console.log(cells[i].textContent);  // Save or process the new values here
            }

            // Disable editing after saving (optional)
            row.querySelectorAll('td[contenteditable]').forEach(cell => {
                cell.setAttribute('contenteditable', 'false');
            });
            
            // Optionally, you can send the updated data to a server here using AJAX.
        }
    </script>

</body>
</html>
