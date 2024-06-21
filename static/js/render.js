function renderElement(endPoint) {
    fetch(endPoint)
        .then((response) => response.json())
        .then((data) => {
            console.log(data);
            data = data.responses;
            let table = document.getElementById('data_table');
            let htmls = '';
            data.forEach((user) => {
                htmls += `<tr>
                        <td><input type="checkbox"></td>
                        <td>${user.fullName}</td>
                        <td>${user.username}</td>
                        <td>${user.email}</td>
                        <td>${user.address}</td>
                        <td>${user.phone}</td>
                        <td>${user.website}</td>
                        <td>${user.company}</td>
                        <td>
                            <button onclick="" class="btn btn-sm btn--pen pen" data-id="1" data-bs-toggle="modal" data-bs-target="#modalEdit">
                                <i class="fas fa-pen"></i>
                            </button>
                            <button onclick="" class="btn btn--trash trash">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>`
            })
            table.innerHTML = htmls;
        })
        .catch((error) => {
            console.error('Error fetching data:', error);
        })
}

renderElement('http://localhost:8080/EmployeeManagerTest/app/api/user.php');