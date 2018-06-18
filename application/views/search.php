<!doctype html>
<html>
<head>
    <title>Autocomplete Suggestions</title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
</head>

<body>
<div id="w">
    <div id="content">
        <div id="searchfield">
            <div class="text-center">
                <input type="text" name="search" class="biginput" id="autocomplete" placeholder="Type here to search for places and hotels...">
            </div>
            <div id="places_list"></div>
            <div id="hotel_list"></div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/search.js"></script>
<script src="<?php echo $this->config->item('google_api') ?>?key=<?php echo $this->config->item('google_api_key') ?>&libraries=places&callback=initMap"
        async defer></script>
</body>
</html>