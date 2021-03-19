<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
<!-- load cubeportfolio css file -->
<link rel="stylesheet" href="{{ asset('css/cubeportfolio.min.css') }}">
 
<!-- load latest jquery from google resources-->
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
 
<!-- load cubeportfolio jQuery plugin -->
<script type="text/javascript" src="{{ asset('js/jquery.cubeportfolio.min.js') }}"></script>

</head>
<body>
    <h2>首頁</h2>
    <div class="cbp-wrapper">
        <div id="filters-container">
            <!-- '*' means shows all item elements -->
            <div data-filter="*" class="cbp-filter-item cbp-filter-item-active">All</div>
            <div data-filter=".animation" class="cbp-filter-item">1</div>
            <div data-filter=".artwork" class="cbp-filter-item">2</div>
            <div data-filter=".illustration" class="cbp-filter-item">3</div>
        </div>
        <div id="grid-container">
            <div class="cbp-item animation">
                <a href="#" title="custom title1">
                    title1
                </a>
            </div>
            <div class="cbp-item artwork">
                <a href="#" title="custom title2">
                    title2
                </a>
            </div>
            <div class="cbp-item illustration">
                <a href="#" title="custom title3">
                    title3
                </a>
            </div>
        </div>
    </div>


    <script src="{{ asset('js/plugin.js') }}"></script>
</body>
</html>