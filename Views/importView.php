<link type="text/css" rel="stylesheet" href="/../css/bootstrap.css">
<div class="container">
    <div class="row">
        <div class="col-md-8 col-sm-8 offset-2">
            <div style="float: right;">
                <a href="/user/logout">Выйти из системы</a>
            </div>
            <h3>Импорт XML файла в базу данных</h3>

            <form id="uploadFileForm" action="/import/load" method="post" enctype="multipart/form-data">
                <div>
                    <input type="file" class="btn btn-primary" form="uploadFileForm" title="Выбрать файл" name="file_to_load" accept=".xml" >
                    <button type="submit" class="btn btn-primary" form="uploadFileForm" >Загрузить</button>
                </div>
            </form>
        <?php if (isset($_SESSION['loaded'])) { ?>
            <h4>Файл успешно загружен!</h4>
            <?php unset($_SESSION['loaded']) ?>
        <?php }  ?>
        <a href="/result">Список людей, у которых есть питомцы старше 3 лет</a>

</div>