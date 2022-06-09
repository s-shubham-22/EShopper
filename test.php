<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/double_range_slider.css">
</head>
<body>
    <div class="row">
        <section class="range-slider container">
            <span class="output outputOne"></span>
            <span class="output outputTwo"></span>
            <span class="full-range"></span>
            <span class="incl-range"></span>
            <input name="rangeOne" value="0" min="0" max="100" step="1" type="range">
            <input name="rangeTwo" value="100" min="0" max="100" step="1" type="range">
        </section>
    </div>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="./js/double_range_slider.js"></script>
</body>
</html>