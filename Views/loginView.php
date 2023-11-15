<link type="text/css" rel="stylesheet" href="/../css/bootstrap.css">
<div class="container">
    <div class="row">
        <div class="col-md-4 col-sm-4 offset-4">
            <h2>Вход в систему</h2>
            <form method="post" action="/user/check">
                <div class="mb-3">
                    <label for="username" class="form-label">Имя пользователя</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Пароль</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Войти</button>
                </div>
            </form>
            <?php if (isset($_SESSION['message'])){
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            } ?>
        </div>
    </div>
</div>
