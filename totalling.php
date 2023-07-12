<?php
//1.  DB接続します
require_once('db_connect.php');

  // ２．データ取得SQL作成
  $stmt = $pdo->prepare("SELECT * FROM gs_bm_table");
  $status = $stmt->execute();
  
  if ($status == false) {
    // execute（SQL実行時にエラーがある場合）
    $error = $stmt->errorInfo();
    exit("ErrorQuery:".$error[2]);
  }

if ($stmt->rowCount() > 0) {
    // 評価ごとの回答数をカウント
    $ratingsCount = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $rating = intval($row['rating']);

        if (isset($ratingsCount[$rating])) {
            $ratingsCount[$rating]++;
        } else {
            $ratingsCount[$rating] = 1;
        }
    }

  // グラフ用のデータ準備
  $labels = range(1, 5);
  $data = array();
// $labelsの順序に合わせて$dataを設定
foreach ($labels as $label) {
  if (isset($ratingsCount[$label])) {
    $data[] = $ratingsCount[$label];
  } else {
    $data[] = 0;
  }
}


} else {
  echo 'まだアンケートがありません。';
}
$labels = range(1, 5);
?>

<!DOCTYPE html>
<html lang="jp">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>アンケート集計結果</title>
  <link rel="stylesheet" href="./css/totaling.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  
</head>
<body>
  <div class="main">
  <h1>⭐️星の数集計結果</h1>
  
  <?php if (isset($labels) && isset($data)) : ?>
    <canvas id="chart" style="border: 1px solid #ccc;"></canvas>
  <?php else : ?>
    <p>まだアンケートがありません。</p>
  <?php endif; ?>
  
  <a href="index.php" class="back-button">戻る</a>
  </div>
  <script>
   document.addEventListener('DOMContentLoaded', function () {
    var ctx = document.getElementById('chart').getContext('2d');
    var chart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: <?php echo json_encode($labels); ?>,
        datasets: [{
          label: '回答数',
          data: <?php echo json_encode($data); ?>,
          backgroundColor: 'rgba(60, 182, 182, 0.6)'
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true,
            precision: 0,
            ticks: {
              padding: 50,
              stepSize: 1
            }
          }
        },
        plugins: {
          legend: {
            display: false
          },
          layout: {
            padding: {
              left: 50,
              right: 50,
              top: 50,
              bottom: 50
            }
          }
        }
      }
    });
  });
  </script>
</body>
</html>
