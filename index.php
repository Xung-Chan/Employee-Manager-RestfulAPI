<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="static/css/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="static/font-awesome/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="static/css/api.css">
    <script src="static/js/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="static/js/jQuery/jquery.min.js"></script>
    <title>Trang chủ</title>
</head>

<body>
    <div class="big_box m-4">
        <div class="row bg-primary">
            <div class="col col-6 m-auto text-w hite">
                <div class="fs-3"> Manage <span class="fw-bold"> Employees </span> </div>
            </div>
            <button onclick="deleteSelected()" class=" btn btn-danger col col-2  m-2 delete_employees">
                <i class="fas fa-minus-circle"></i>
                Delete
            </button>
            <button id="addnew" class=" btn btn-success col col-2  m-auto m-2  " data-bs-toggle="modal"
                data-bs-target="#exampleModal">

                <i class="fas fa-plus-circle"></i>
                Add New Employee

            </button>

        </div>
        <div>
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-success " id="exampleModalLabel">
                                <i class="fas fa-file-signature"></i>New Employee
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="create-form">

                                <label for=" name"> <i class="fas fa-user-circle"></i>Name </label>
                                <input name="fullName" type="text" id="name" class="name mb-3" placeholder="Full name"
                                    name="Employeename">
                                <label for="username"><i class="fas fa-user-circle"></i> username</label>
                                <input type="text" name="username" id="username" class="username  mb-3 "
                                    placeholder="username">

                                <label for="email"> <i class="fas fa-envelope"></i> Email</label>
                                <input name="email" type="text" id="email" class="email  mb-3 " placeholder="Email "
                                    name="Employeeemail">

                                <label for="address"><i class="fas fa-map-marker-alt"></i>Address</label>
                                <input name="address" type="text" id="address" class="address  mb-3 "
                                    placeholder="street">



                                <label for="phonenumber"> <i class="fas fa-phone"></i> Employee's Phone</label>
                                <input name="phone" type="text" class="phone" id="phonenumber" placeholder="Phone">

                                <label for="website"> <i class="fas fa-tv"></i> website</label>
                                <input name="website" type="text" class="website" id="website" placeholder="website">

                                <label for="namecompany"> <i class="fas fa-building"></i> company name</label>
                                <input name="company" type="text" class="namecompany" id="namecompany"
                                    placeholder="company name">

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <submit id="create-button" class="btn btn-primary">
                                <i class="fas fa-user-plus"> Create</i>
                            </submit>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal  fade" id="modalEdit" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-success" id="modalEditLabel">
                            <i class="fas fa-user-edit"></i>
                            Employee Infomation
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body row modal_center">
                        <form class="update_form">

                            <label for=" name"> <i class="fas fa-user-circle"></i>Name </label>
                            <input type="text" id="name" class="name mb-3" placeholder="Full name" name="Employeename">

                            <label for="username"><i class="fas fa-user-circle"></i> username</label>
                            <input type="text" id="username" class="username  mb-3 " placeholder="username">

                            <label for="email"> <i class="fas fa-envelope"></i> Email</label>
                            <input type="text" id="email" class="email  mb-3 " placeholder="Email "
                                name="Employeeemail">

                            <label for="street"><i class="fas fa-map-marker-alt"></i>street</label>
                            <input type="text" id="street" class="street  mb-3 " placeholder="street">

                            <label for="suite"><i class="fas fa-map-marker-alt"></i>suite</label>
                            <input type="text" id="suite" class="suite  mb-3 " placeholder="suite">

                            <label for="city"><i class="fas fa-map-marker-alt"></i>city</label>
                            <input type="text" id="city" class="city  mb-3 " placeholder="city">

                            <label for="zipcode"><i class="fas fa-map-marker-alt"></i>zipcode</label>
                            <input type="text" id="zipcode" class="zipcode  mb-3 " placeholder="zipcode">


                            <label for="lat"> <i class="fas fa-map-marker-alt"></i>Latitude:</label>
                            <input type="text" id="lat" class="lat" name="lat" placeholder="Latitude">

                            <label for="lng"><i class="fas fa-map-marker-alt"></i>Longitude:</label>
                            <input type="text" id="lng" class="lng" name="lng" placeholder="Longitude">

                            <label for="phonenumber"> <i class="fas fa-phone"></i> Employee's Phone</label>
                            <input type="text" class="phone" id="phonenumber" placeholder="Phone">

                            <label for="website"> <i class="fas fa-tv"></i> website</label>
                            <input type="text" class="website" id="website" placeholder="website">

                            <label for="namecompany"> <i class="fas fa-building"></i> company name</label>
                            <input type="text" class="namecompany" id="namecompany" placeholder="company name">

                            <label for="catchPhrase"> <i class="fas fa-building"></i> catchPhrase</label>
                            <input type="text" class="catchPhrase" id="catchPhrase" placeholder="catchPhrase">

                            <label for="bs"> <i class="fas fa-building"></i> bs</label>
                            <input type="text" class="bs" id="bs" placeholder="bs">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <submit class="btn btn-success save-button">Save
                        </submit>
                    </div>

                </div>
            </div>
        </div>

        <table class="table table-striped table-hover">
            <thead>
                <th>
                    <input type="checkbox">
                </th>
                <th>ID</th>
                <th>Name</th>
                <th>Username</th>
                <th>Email</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Website</th>
                <th>Company</th>
                <th>Action</th>
            </thead>
            <tbody id="data_table">

            </tbody>

        </table>
        <div class="row text-center">
            <div class=" col-7  text-start" id="quantity-show">
                Showing <span class="fw-bold">5 </span> out of <span class="fw-bold">25 </span> entries
            </div>
            <ul class="d-flex justify-content-end" id="pagination-user"></ul>
        </div>
    </div>

    <script src="static/js/jQuery/jquery.twbsPagination.min.js"></script>
    <script src="static/js/render.js"> </script>
    <script>
        renderUsers('app/api/user.php?page=1');
        document.getElementById('create-button').addEventListener('click', function (e) {
            e.preventDefault();
            let formData = new FormData(document.getElementById('create-form'));
            fetch('app/api/user.php', {
                method: 'POST',
                body: formData,
            })
                .then(response => response.json())
                .then((response) => {
                    console.log(response);
                    $('#pagination-user').twbsPagination('destroy');
                    renderUsers('app/api/user.php?page=1', 1);
                })
                .catch((error) => { console.error('Post error:' + error) })
        })  
    </script>

</body>

</html>