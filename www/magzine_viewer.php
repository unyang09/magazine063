<?php
$folderName = key($_GET);
$folderPath = 'magazine_images/' . ($folderName ? $folderName : 'default');

$images = glob($folderPath . '/*.{jpg,jpeg,png,gif}', GLOB_BRACE);
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width = 1050, user-scalable = no" />
<script type="text/javascript" src="/turnjs/js/jquery.min.js"></script>
<script type="text/javascript" src="/turnjs/js/turn.min.js"></script>
<link rel="stylesheet" href="/turnjs/css//magazine.css">
</head>
<body>

<div class="flipbook-viewport">
    <div class="container">
        <div class="flipbook">
            <?php
            // 이미지 파일 경로 설정
            $folderPath = 'magazine_images/' . ($folderName ? $folderName : 'default');
            $files = glob($folderPath . '/*.jpg');

            // 각 이미지 파일에 대해 페이지를 생성합니다.
            foreach ($files as $file) {
                echo '<div><img src="' . $file . '" alt="Page Image"></div>';
            }
            ?>
        </div>
    </div>
</div>


<script type="text/javascript">

function loadApp() {

	// Create the flipbook

	$('.flipbook').turn({
			// Width

			width:922,
			
			// Height

			height:600,

			// Elevation

			elevation: 50,
			
			// Enable gradients

			gradients: true,
			
			// Auto center this flipbook

			autoCenter: true

	});
}

// Load turn.js

loadApp()

</script>

</body>
</html>
