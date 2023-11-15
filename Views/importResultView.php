<link type="text/css" rel="stylesheet" href="/../css/bootstrap.css">
<div class="container">
    <div style="float: right;">
        <a href="/user/logout">Выйти из системы</a>
    </div>
    <h3>Импорт успешно завершен</h3>
    <h4>Список людей, у которых есть питомцы старше 3 лет</h4>

    <ul class="list-group">
    <?php
    foreach ($data as $row){
    ?>
        <li class="list-group-item">
            <?= $row['fio'] ?>
        </li>
    <?php
    }
    ?>
    </ul>
</div>
