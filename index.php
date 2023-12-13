<?php
require_once __DIR__ . '/db.php';
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Демо Bootstrap</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <style>
        a {
            text-decoration: none;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col">
            <div class="logo my-3"><a href="."><i class="bi bi-database-fill-gear"></i> Панель администратора</a></div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#addUser">Добавить пользователя</button>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <table class="table table-striped table-hover mt-3">
                <thead>
                <tr class="table-success text-white">
                    <th scope="col">ID</th>
                    <th scope="col">Имя</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Права</th>
                    <th scope="col">Действия</th>
                </tr>
                </thead>
                <tbody>
                <?php if($users): ?>

                <?php foreach ($users as $user):?>
                <tr>
                    <th scope="row"><?=$user['id'] ?></th>
                    <td class="userId"><?=$user['name'] ?></td>
                    <td class="userEmail"><?=$user['email'] ?></td>
                    <td class="userRole"><?=$_ru[$user['role']] ?></td>
                    <td><a class="editUser" href="#" data-bs-toggle="modal" data-bs-target="#editUser" data-user-id="<?=$user['id'] ?>" data-user-name="<?=$user['name'] ?>" data-user-email="<?=$user['email'] ?>" data-user-role="<?=$user['role'] ?>">
                            <i class="bi bi-pencil-square text-primary"></i> <span class="text-primary">Edit</span>
                        </a> |
                        <a class="deleteUser" href="?delete=<?=$user['id'] ?>">
                            <i class="bi bi-trash text-danger"></i> <span class="text-danger">Delete</span>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php else: ?>
                <tr>
                    <th>Пользователи отсутствуют</th>
                </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!--  modal: add user-->
<div class="modal fade" id="addUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Добавить пользователя</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <div class="modal-body">
                <form action="." method="POST">
                    <div class="mb-3">
                        <label for="exampleInputName" class="form-label">Имя пользователя</label>
                        <input type="text" name="name" class="form-control" id="exampleInputName" aria-describedby="emailHelp" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail" class="form-label">Адрес электронной почты</label>
                        <input type="email" name="email" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputRole" class="form-label">Роль пользователя</label>
                        <select class="form-select" name="role" id="exampleInputRole" aria-label="Роль пользователя" required>
                            <option value="Reader">Читатель</option>
                            <option value="Editor">Редактор</option>
                            <option value="Administrator">Администратор</option>
                        </select>
                    </div>
                    <button type="submit" name="create" class="btn btn-primary">Отправить</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!--  modal: edit user-->
<div class="modal fade" id="editUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Редактировать пользователя</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <div class="modal-body">
                <form action="." method="POST">
                    <input type="text" name="id" class="form-control" id="exampleInputId" hidden="hidden">
                    <div class="mb-3">
                        <label for="exampleInputName" class="form-label">Имя пользователя</label>
                        <input type="text" name="name" class="form-control" id="exampleInputName" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail" class="form-label">Адрес электронной почты</label>
                        <input type="email" name="email" class="form-control" id="exampleInputEmail" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputRole" class="form-label">Роль пользователя</label>
                        <select class="form-select" name="role" id="exampleInputRole" aria-label="Роль пользователя" required>
                            <option value="Reader">Читатель</option>
                            <option value="Editor">Редактор</option>
                            <option value="Administrator">Администратор</option>
                        </select>
                    </div>
                    <button type="submit" name="update" class="btn btn-primary">Отправить</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script>
    // Редактирование пользователя
    const editButtons = document.querySelectorAll('a.editUser');
    const editForm = document.getElementById('editUser');
    editButtons.forEach((el) => el.addEventListener('click', prepareEditForm));
    function prepareEditForm(e) {
        editForm.querySelector('#exampleInputId').value = this.getAttribute('data-user-id');
        editForm.querySelector('#exampleInputName').value = this.getAttribute('data-user-name');
        editForm.querySelector('#exampleInputEmail').value = this.getAttribute('data-user-email');
        editForm.querySelector('#exampleInputRole').value = this.getAttribute('data-user-role');
    }

    // Удаление пользователя
    const deleteButtons = document.querySelectorAll('a.deleteUser');
    deleteButtons.forEach((el) => el.addEventListener('click', alertDeleteUser));
    function alertDeleteUser(e) {
        if (confirm('Вы уверены что хотите удалить пользователя?')) {
            return true;
        } else {
            e.preventDefault();
        }
    }
</script>
</body>
</html>
