<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="./assets/index.css">
  <title>Document</title>
</head>

<body>
  <div id="content_wrapper">
    <div class="form first">
      <div>
        <h3>Cтатистика работы в сети выбранного клиента</h3>
        <select name="id_client">
          <?php
          require 'conn.php';
          $dbh = conn();

          $clients_data_query = $dbh->query("SELECT `id_client`, `name` FROM `client`");
          $clients_data = $clients_data_query->fetchAll(PDO::FETCH_ASSOC);

          foreach ($clients_data as $data) {
            $id_client = $data['id_client'];
            $name = $data['name'];
            echo "<option value=\"$id_client\">$name</option>";
          }
          ?>
        </select>
        <br>
        <input id="first__btn" type="button" value="Получить">
      </div>
      <br>
      <hr>
      <div id="form__output"></div>
    </div>

    <div class="form second">
      <div id="second__input">
        <h3>Cтатистика работы в сети за указанный промежуток времени</h3>
        <?php
        $period_query = $dbh->query("SELECT DATE(MIN(`start`)) AS `min`, DATE(MAX(`stop`)) AS `max` FROM `seance`");
        $period = $period_query->fetch(PDO::FETCH_ASSOC);

        $min_date = $period['min'];
        $max_date = $period['max'];
        ?>
        <div>
          <span>C</span>
          <input class="datetime" type="date" name="from_date" min="<?php echo $min_date ?>" max="<?php echo $max_date ?>">
          <input class="datetime" type="time" name="from_time">
        </div>
        <div>
          <span>По</span>
          <input class="datetime" type="date" name="to_date" min="<?php echo $min_date ?>" max="<?php echo $max_date ?>">
          <input class="datetime" type="time" name="to_time">
        </div>
        <input id="second__btn" type="button" value="Получить">
      </div>
      <br>
      <hr>
      <div id="form__output"></div>
    </div>

    <div class="form third">
      <div>
        <h3>Вывести список клиентов с отрицательным балансом счета</h3>
        <input id="third__btn" type="button" value="Вывести">
      </div>
      <br>
      <hr>
      <div id="form__output"></div>
    </div>
  </div>
</body>
<script src="./assets/index.js"></script>

</html>