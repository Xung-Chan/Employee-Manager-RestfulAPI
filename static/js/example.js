let data = [

    {
        id: 2,
        name: "Dominique Perrier",
        email: "dominiqueperrier@mail.com",
        address: "Obere Str, 57, Berlin, Geemany",
        phone: " (313) 555-5735",
    }, {
        id: 1,
        name: "Thomas Hardy",
        email: "thomashardy@mail.com",
        address: "89 Chiaroscuro Rd, Porland, USA",
        phone: "(171) 555-2222",
    },
    {
        id: 3,
        name: "Maria Anders",
        email: "marianders@mail.com",
        address: "25, rue Lauriston, Paris, France",
        phone: "(204) 619-5731",
    },
    {
        id: 4,
        name: "Fran Wilson",
        email: "franwilson@mail.com",
        address: "C/ Araquil, 67, Madrid, Spain",
        phone: "(204)619-5731",
    },
    {
        id: 5,
        name: "Martin Blank",
        email: "martinblank@mail.com",
        address: " Via Monte Bianco 34 , Turin, italy",
        phone: "(480) 631_2097",
    },
];
function readAll() {
    let tbody = document.getElementById("data_table");
    data.forEach(function (item) {
        let row = document.createElement("tr");
        row.setAttribute("id", `item-${item.id}`);
        row.innerHTML = `
          <th >
          <input type="checkbox"  >
          </th>
          <td> ${item.name}</td>
          <td> ${item.email}</td>
          <td> ${item.address}</td>
          <td> ${item.phone}</td>
          <td>
        <div class="hidden_button">
          <button onclick="showUpdate(${item.id})"  class="btn btn-sm  btn--pen pen"  data-id="${item.id}"  data-bs-toggle="modal"
          data-bs-target="#modalEdit"> <i class="fas fa-pen "> </i> </button>
         <button  onclick="deleteSelect(${item.id})"  class="btn btn--trash trash"> <i class="fas fa-trash "></i></button>
         </div>
         </td>`;
        tbody.appendChild(row);
    });
}


document.addEventListener("DOMContentLoaded", readAll());

// Funtion DELETE all data
function deleteAll() {
    let tbody = document.getElementById("data_table");
    tbody.innerHTML = "";
}
//DELETE BY ICON
function deleteSelect(id) {
    if (confirm("DO YOU WANT TO DELETE?")) {
        let row = document.querySelector(`[id="item-${id}"]`);
        row.parentNode.removeChild(row);
        let index = data.findIndex(function (item) {
            return item.id == id;
        });
        if (index > -1) {
            data.splice(index, 1);
        }
    }
}
//delete by checked
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
                row.parentNode.removeChild(row);
                let index = data.findIndex(function (item) {
                    return item.id == id;
                });
                if (index !== -1) {
                    data.splice(index, 1);
                }
            });
        }
    }


}

// ADD employee

function add() {

    const name = document.querySelector(".name").value;
    const email = document.querySelector(".email").value;
    const address = document.querySelector(".address").value;
    const phone = document.querySelector(".phone").value;
    const idnext = data.length + 1;
    let newObj = {
        id: idnext,
        name: name,
        email: email,
        address: address,
        phone: phone,
    };
    if (name.trim() === "") {
        alert(" please fill NAME");
    }
    else if (email.trim() === "") {
        alert(" please fill EMAIL");
    }
    else if (phone.trim() === "") {
        alert(" please fill PHONE NUMBER");
    }

    else {
        data.push(newObj);
        alert("ADD SUCCESS");
        deleteAll();
        readAll();
        clear();
        let myModal = bootstrap.Modal.getInstance(document.getElementById("exampleModal"));
        myModal.hide();
    }
}
function clear() {
    document.querySelector(".name").value = "";
    document.querySelector(".email").value = "";
    document.querySelector(".address").value = "";
    document.querySelector(".phone").value = "";
}

// Edit employee infomation
function showUpdate(id) {
    const user = data.find((entry) => entry.id === id);
    const name = user["name"];
    const email = user["email"];
    const address = user["address"];
    const phone = user["phone"];
    document.querySelector(".update_form .name").value = name;
    document.querySelector(".update_form .email").value = email;
    document.querySelector(".update_form .address").value = address;
    document.querySelector(".update_form .phone").value = phone;
    let buttonSave = document.querySelector(".save-button");
    buttonSave.onclick = () => {
        update(id)
    }

}
function update(id) {
    // Lấy giá trị mới từ các trường input trong form chỉnh sửa
    const name = document.querySelector(".update_form .name").value;
    const email = document.querySelector(".update_form .email").value;
    const address = document.querySelector(".update_form .address").value;
    const phone = document.querySelector(".update_form .phone").value;
    if (name.trim() === "") {
        alert(" please fill NAME ");
    }
    else if (email.trim() === "") {
        alert(" please fill EMAIL");
    }
    else if (phone.trim() === "") {
        alert(" please fill PHONE NUMBER");
    }
    else {
        let userIndex = data.findIndex(function (item) {
            return item.id === id;
        });
        if (userIndex !== -1) {
            // Cập nhật thông tin của người dùng trong mảng data
            data[userIndex].name = name;
            data[userIndex].email = email;
            data[userIndex].address = address;
            data[userIndex].phone = phone;
            deleteAll();
            readAll();
            alert("CHANGE SUCCESS")
            let myModal = bootstrap.Modal.getInstance(document.getElementById("modalEdit"));
            myModal.hide();

        } else {
            alert("Contact not found.");
        }
    }
}