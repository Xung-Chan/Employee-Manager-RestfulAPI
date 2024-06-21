var API = 'app/api/user.php';

function start() {
    handerinfo(readAll);
    handerCreate();

}
start();
let selectAll = document.querySelector('th input[type="checkbox"]');
selectAll.onchange = function () {
    let checkboxes = document.querySelectorAll('#data_table input[type="checkbox"]');
    checkboxes.forEach(checkbox => {
        checkbox.checked = selectAll.checked;
    });
}
function handerinfo(callback) {
    fetch(API)
        .then(function (response) {
            return response.json();
        })
        .then(callback)
        .catch(error => {
            console.error('Error fetching data:', error);
        });
}

function readAll(data) {
    let tbody = document.getElementById("data_table");
    tbody.innerHTML = "";
    data = data.responses;
    console.log(data);
    data.forEach((item) => {
        let row = document.createElement("tr");
        row.setAttribute("id", `item-${item.id}`);
        row.innerHTML = `
              <th>
              <input type="checkbox">
              </th>
              <td>${item.fullName}</td>
              <td>${item.username}</td>
              <td>${item.email}</td>
              <td>${item.address}</td>
              <td>${item.phone}</td>
              <td>${item.website}</td>
              <td>${item.company}</td>
              <td>
            <div class="hidden_button">
              <button onclick="showUpdate(${item.id})" class="btn btn-sm btn--pen pen" data-id="${item.id}" data-bs-toggle="modal" data-bs-target="#modalEdit">
                <i class="fas fa-pen"></i>
              </button>
             <button onclick="deleteSelect('${item.id}')" class="btn btn--trash trash">
                <i class="fas fa-trash"></i>
             </button>
             </div>
             </td>`;
        tbody.appendChild(row);
    });
}
function deleteSelected() {
    let checkboxes = document.querySelectorAll(
        '#data_table input[type="checkbox"]:checked'
    );

    if (checkboxes.length > 0) {
        if (confirm("DO YOU WANT TO DELETE ?")) {
            // Duyệt qua danh sách các checkbox từ cuối danh sách đến đầu danh sách
            Array.from(checkboxes).forEach(function (checkbox) {
                let row = checkbox.closest("tr");

                let id = row.id.split("-")[1];
                deleteSelect(id);
            });
            handerinfo(readAll);
        }
    }


}
function deleteSelect(id) {
    var options = {
        method: 'DELETE',
        headers: {
            'Content-type': 'application/json; charset=UTF-8',
        },

    };

    fetch(API + '/' + id, options)
        .then(function (response) {
            return response.ok;
        })
        .then(function () {
            handerinfo(readAll);
        });
}
function createEmployee(data, callback) {
    var options = {
        method: 'POST',
        headers: {
            'Content-type': 'application/json; charset=UTF-8',
        },
        body: JSON.stringify(data)
    };

    fetch(API, options)
        .then(function (response) {
            return response.json();
        })
        .then(callback);
}

function showUpdate(id) {
    fetch(API + '/' + id, {
        method: 'GET',
        headers: {
            'Content-type': 'application/json; charset=UTF-8',
        },
    })
        .then(function (response) {
            return response.json();
        })
        .then(function (data) {
            document.querySelector(".update_form .name").value = data.name;
            document.querySelector(".update_form .username").value = data.username;
            document.querySelector(".update_form .email").value = data.email;
            document.querySelector(".update_form .street").value = data.address.street;
            document.querySelector(".update_form .suite").value = data.address.suite;
            document.querySelector(".update_form .city").value = data.address.city;
            let buttonSave = document.querySelector(".save-button");
            buttonSave.onclick = () => {
                update(data.id)
            }
        }
        )
}
function update(id) {
    // Lấy giá trị mới từ các trường input trong form chỉnh sửa
    const name = document.querySelector(".update_form .name").value;
    const username = document.querySelector(".update_form .username").value;
    const email = document.querySelector(".update_form .email").value;
    const street = document.querySelector(".update_form .street").value;
    const suite = document.querySelector(".update_form .suite").value;
    const city = document.querySelector(".update_form .city").value;
    const zipcode = document.querySelector(".update_form .zipcode").value;
    const lng = document.querySelector(".update_form .lng").value;
    const lat = document.querySelector(".update_form .lat").value;
    const geo = {
        lat: lat,
        lng: lng
    };
    const address = {
        street: street,
        suite: suite,
        city: city,
        zipcode: zipcode,
        geo: geo
    };
    const phone = document.querySelector(".update_form .phone").value;
    const website = document.querySelector(".update_form .website").value;
    const namecompany = document.querySelector(".update_form .namecompany").value;
    const catchPhrase = document.querySelector(".update_form .catchPhrase").value;
    const bs = document.querySelector(".update_form .bs").value;
    const company = {
        name: namecompany,
        catchPhrase: catchPhrase,
        bs: bs,
    };
    if (email.trim() === "") {
        alert(" please fill EMAIL");
    }
    else if (street.trim() === "") {
        alert(" please fill STREET");
    }
    else {
        fetch(API + '/' + id, {
            method: 'PUT',
            headers: {
                'Content-type': 'application/json; charset=UTF-8',
            },
            body: JSON.stringify({
                name: name,
                username: username,
                email: email,
                address: address,
                phone: phone,
                website: website,
                company: company,
            })
        })
            .then(function (response) {
                return response.json();
            })
            .then(function () {
                handerinfo(readAll);
                alert("CHANGE SUCCESS")
                let myModal = bootstrap.Modal.getInstance(document.getElementById("modalEdit"));
                myModal.hide();
                handerinfo(readAll);
            })
            .catch(error => {
                alert("Contact not found.");
            });
    }
}

function handerCreate() {
    let createBtn = document.querySelector("#Create");
    createBtn.onclick = function () {
        const name = document.querySelector("#name").value;
        const username = document.querySelector("#username").value;
        const email = document.querySelector("#email").value;
        const address = {
            street: document.querySelector("#street").value,
            suite: document.querySelector("#suite").value,
            city: document.querySelector("#city").value,
            zipcode: document.querySelector("#zipcode").value,
            geo: {
                lat: document.querySelector("#lat").value,
                lng: document.querySelector("#lng").value
            }
        };

        const phone = document.querySelector("#phonenumber").value;
        const website = document.querySelector("#website").value;
        const company = {
            name: document.querySelector("#namecompany").value,
            catchPhrase: document.querySelector("#catchPhrase").value,
            bs: document.querySelector("#bs").value,
        };

        let formData = {

            name: name,
            username: username,
            email: email,
            address: address,
            phone: phone,
            website: website,
            company: company,
        };
        if (name.trim() === "") {
            alert(" please fill NAME ");
        }
        else if (email.trim() === "") {
            alert(" please fill EMAIL");
        }
        else if (phone.trim() === "") {
            alert(" please fill PHONE NUMBER");
        }
        else if (website.trim() === "") {
            alert(" please fill website");
        }
        else {
            createEmployee(formData, function () {
                handerinfo(readAll);
            });
            let myModal = bootstrap.Modal.getInstance(document.getElementById("exampleModal"));
            myModal.hide();
            alert("ADD SUCCESS");
        }
        fetch(API)
            .then(function (response) {
                return response.json();
            })
            .then((json) => console.log(json));
    }
}

