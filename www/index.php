<?php
// DB connection info
$host = 'localhost'; // or your db host name or IP
$dbname = 'magazine063';
$user = 'magazine063';
$pass = 'gywkfh100!!';
$charset = 'utf8mb4';

$pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=$charset", $user, $pass, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
]);

$contents = $pdo->query("SELECT * FROM content_items ORDER BY timestamp DESC")->fetchAll();

$totalImages = count($contents);
$leftColumnCount = ceil($totalImages / 2);
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="js/scripts.js" defer></script>
    <title>매거진 063</title>

    <style>
        body, html {
            height: 100%;
            margin: 0;
            padding: 0;
            font-family: 'Noto Sans KR', sans-serif;
        }

        a {
            text-decoration: none;
        }

        .wrapper {
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .ad-column {
            display: none;
            background-color: #f5f5f5;
            padding: 20px;
            box-sizing: border-box;
        }

        .content-column {
            flex: 2;
            background-color: #ffffff;
            overflow-y: scroll;
        }

        .auth-buttons a {
            margin-left: 10px;
            text-decoration: none;
        }

        .image-row {
            padding: 20px;
            display: flex;
            gap: 10px;
            flex-direction: row;
        }

        .image-column {
            display: flex;
            flex-direction: column;
            width: 50%;
            gap: 10px;
        }

        .image-column h3{
            margin: 5px 0px 5px 0px;
            font-size: 16px;
            font-weight: 400;
            letter-spacing: -0.3px;
            color: black;
            display: block;
        }

        .image-column p{
            margin: 0px;
            font-size: 13px;
            font-weight: 400;
            letter-spacing: -0.3px;
            margin-bottom: 5px;
            color: rgb(158, 158, 158);
            display: block;
        }

        .image-container {
            background-size: cover;
            background-position: center;
        }
        
        <?php
foreach ($contents as $i => $content) {
    $imagePath = 'index_image/' . $content['image_filename'];
    echo ".image-container.image-$i {
        background-image: url('$imagePath');
    }\n";
}
?>

        @media screen and (min-width: 768px) {
            .wrapper {
                flex-direction: row;
            }

            .ad-column {
                display: block;
                flex: 1;
            }

            .content-column {
                max-width: 450px;
            }
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="ad-column">
            <!-- 광고 컨텐츠가 들어갈 공간 -->
        </div>
        <div class="content-column">
            <?php include 'header.php'; ?>
            <main>
                <div class="image-row">
                <div class="image-column">
                    <?php
                        for ($i = 0; $i < $leftColumnCount; $i++) {
                            $link = $contents[$i]['link'];  // 해당 이미지의 링크 가져오기
                            echo '<a href="' . $link . '">';  // 링크 시작
                            echo '<div class="image-container image-' . $i . '">';
                            echo '</div>';
                            echo '<h3>' . $contents[$i]['title'] . '</h3>';
                            echo '<p>' . $contents[$i]['subtitle'] . '</p>';
                            echo '</a>';  // 링크 종료
                        }
                    ?>
                </div>
                <div class="image-column">
                    <?php
                    for ($i = $leftColumnCount; $i < $totalImages; $i++) {
                        $link = $contents[$i]['link'];  // 해당 이미지의 링크 가져오기
                        echo '<a href="' . $link . '">';  // 링크 시작
                        echo '<div class="image-container image-' . $i . '">';
                        echo '</div>';
                        echo '<h3>' . $contents[$i]['title'] . '</h3>';
                        echo '<p>' . $contents[$i]['subtitle'] . '</p>';
                        echo '</a>';  // 링크 종료
                    }
                    ?>
                </div>
                </div>
            </main>
            <footer>
                <?php include 'footer.php'; ?>
            </footer>
        </div>
    </div>
</body>
</html>
