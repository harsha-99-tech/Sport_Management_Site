<?php
    include 'slider_news.php';

    $slidesCount = count($newsRecords);

    //Indicators

    echo "<ol class='carousel-indicators'>";
    $indicators = "<li data-target='#carouselCaptions' data-slide-to='0' class='active'></li>";
    for($i = 1; $i<$slidesCount; $i++){
        $indicators = $indicators."
            <li data-target='#carouselCaptions' data-slide-to='$i'></li>
        "; 
    }
    echo $indicators;
    echo "</ol>";
    echo "<div class='carousel-inner'>";

    //Slides

    $slides ="
            <div class='carousel-item active'>
                <img src='./assets/img/image0.jpg' class='d-block w-100' alt='Slide 1'>
                <div class='carousel-caption'>
                    <h1><b>". $newsRecords[0]['newsTitle']."</b></h1>
                    <p style='font-size:1.5em;'>".$newsRecords[0]['newsBody']."</p>
                </div>
            </div>";
    
    for($count = 1; $count<$slidesCount; $count++){
        $slides = $slides."
            <div class='carousel-item'>
                <img src='./assets/img/image$count.jpg' class='d-block w-100' alt='Slide 1'>
                <div class='carousel-caption'>
                    <h1><b>". $newsRecords[$count]['newsTitle']."</b></h1>
                    <p style='font-size:1.5em;'>".$newsRecords[$count]['newsBody']."</p>
                </div>
            </div>";
    }

    echo $slides;
?>

