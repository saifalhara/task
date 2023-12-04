<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.datatables.net/v/bs5/dt-1.13.8/datatables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    <title>Dashboard</title>
</head>

<body>
    @csrf
    <h1 class="text-center  my-5 py-3">View All Users </h1>
    <div class="container">
        <div class="row">
            <div class="col-10 mx-auto p-4 border mb-5">
                <table class="table">
                    <thead class="bg-dark text-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">User Name </th>
                            <th scope="col">Email</th>
                            <th scope="col">Actions</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($allUsers as $user) : ?>
                            <tr>
                                <td class="user-id"> <?php echo $i;
                                                        $i++; ?></td>
                                <td class="text-center"><?php echo $user->user_name  ?></td>
                                <td class="text-center"><?php echo $user->email ?></td>
                                <td>
                                    <button class="btn btn-info" onclick="showEditFeild(<?php echo $user->id ?> )" data-username="<?php echo $user->user_name ?>" data-email="<?php echo $user->email ?>">Edit</button>
                                </td>
                                <td>
                                    <button class="btn btn-danger" onclick="deleteUser(<?php echo $user->id ?>)" id="delete">Delete</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="d-flex justify-content-end mr-4">
                    <button onclick="showAddFeild()" class="btn btn-primary">Add User</button>
                </div>
            </div>

        </div>
    </div>
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="alert alert-danger mt-3" role="alert" id="errorMessage" style="display: none;"></div>
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editUserForm">
                        <input type="text" class="form-control" id="id" hidden>
                        <div class="mb-3">
                            <label for="editUsername" class="form-label">Username:</label>
                            <input type="text" class="form-control" id="editUsername" required>
                        </div>
                        <div class="mb-3">
                            <label for="editEmail" class="form-label">Email:</label>
                            <input type="email" class="form-control" id="editEmail" required>
                        </div>
                        <div class="mb-3">
                            <button type="submit" id="editbtn" onclick="editUser()" class="btn btn-primary">Save changes</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="alert alert-danger mt-3" role="alert" id="errorMessageAdd" style="display: none;"></div>
                <div class="modal-header">
                    <h5 class="modal-title" id="userModalLabel">Add User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addUserForm" >
                        <input type="text" class="form-control" id="id" hidden>
                        <div class="mb-3">
                            <label for="userName" class="form-label">Username:</label>
                            <input type="text" class="form-control" id="addUserName" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control" id="addEmail" required>
                        </div>
                        <div class="mb-3">
                            <label for="paswword" class="form-label">Password:</label>
                            <input type="password" class="form-control" id="addPassword" required>
                        </div>
                        <div class="mb-3">
                            <button type="submit" id="addBtn" onclick="addUser()" class="btn btn-primary">Save changes</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="{{ asset('js/dashboard.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

</html>
