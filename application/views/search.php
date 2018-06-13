<!doctype html>
<html>
<head>
    <title>Autocomplete Suggestions</title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="application/assets/css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
</head>

<body>
<div id="w">
    <div id="content">
        <div id="searchfield">
            <div class="text-center">
                <input type="text" name="search" class="biginput" id="autocomplete" placeholder="Start typing to search for places and hotels...">
            </div>
            <div id="places_list"></div>
            <div id="hotel_list"></div>
        </div>
    </div>
</div>

<script>

    var autocomplete;

    function initMap() {
        autocomplete = new google.maps.places.Autocomplete((document.getElementById('autocomplete')), {});
    }

    $(document).ready(function () {

        function boldString(str, find){
            var regex = new RegExp(find, 'g');
            return str.replace(regex, '<b>'+find+'</b>');
        }

        $('#autocomplete').typeahead({
            source: function (query, result) {

                var input = $('#autocomplete').val();
                $('#places_list').html('<h3>Location</h3>');

                $.ajax({
                    url: "<?php echo $this->config->item('base_url').'welcome'; ?>",
                    type: 'POST',
                    data : {'string' : input},
                    success: function(response){

                        if(response['success']) {

                            $('#hotel_list').html('<h3>Hotel</h3><table><tbody></tbody></table>');
                            var html_text = '';
                            var  data = response['list'];
                            for(var key in data) {
                                var str = data[key].address +  ', ' + data[key].city + ', ' + data[key].state + ', ' + data[key].country;
                                var result = boldString(str, input);
                                html_text += '<tr><td><i class="fa fa-map-marker icon"></i>   <span class="font-weight-700">' + data[key].name + '</span> - ' + result + '</td></tr>';
                            }
                            $('#hotel_list tbody').html(html_text);
                        }
                        else {
                            $('#hotel_list').html('');
                        }
                    },
                    error: function () {
                        $('#hotel_list').html('');
                    }
                });
            }
        });

        $('#autocomplete').keyup(function () {
            if ($(this).val() == '') {
                $('#hotel_list').html('');
                $('#places_list').html('');
            }
        });
    });
</script>

<script src="<?php echo $this->config->item('google_api') ?>?key=<?php echo $this->config->item('google_api_key') ?>&libraries=places&callback=initMap"
        async defer></script>
</body>
</html>