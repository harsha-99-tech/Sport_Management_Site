<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/home.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/features.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <title>News Carousel</title>

    <style>
        @media screen and (max-width: 992px) {

            .carousel-caption h1 {
                font-size: 1.7em !important;
            }

            .carousel-caption p {
                font-size: 1em !important;
            }
        }
    </style>

</head>

<body>

    <?php
    include 'slider_news.php';

    $slidesCount = count($newsRecords);

    // Indicators

    echo "<ol class='carousel-indicators'>";
    $indicators = "<li data-target='#carouselCaptions' data-slide-to='0' class='active'></li>";
    for ($i = 1; $i < $slidesCount; $i++) {
        $indicators .= "<li data-target='#carouselCaptions' data-slide-to='$i'></li>";
    }
    echo $indicators;
    echo "</ol>";
    echo "<div class='carousel-inner'>";

    // Slides

    $slides = "
    <div class='carousel-item active'>
        <img src='./assets/img/image0.jpg' class='d-block w-100' alt='Slide 1'>
        <div class='carousel-caption'>
            <h1><b>" . $newsRecords[0]['newsTitle'] . "</b></h1>
            <p style='font-size:1.5em;'>" . $newsRecords[0]['newsBody'] . "</p>
        </div>
    </div>";

    for ($count = 1; $count < $slidesCount; $count++) {
        $slides .= "
        <div class='carousel-item'>
            <img src='./assets/img/image$count.jpg' class='d-block w-100' alt='Slide $count'>
            <div class='carousel-caption'>
                <h1><b>" . $newsRecords[$count]['newsTitle'] . "</b></h1>
                <p style='font-size:1.5em;'>" . $newsRecords[$count]['newsBody'] . "</p>
            </div>
        </div>";
    }

    echo $slides;
    ?>

    </div>

</body>

</html>