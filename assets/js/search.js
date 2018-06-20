var autocomplete;

function initMap() {
    autocomplete = new google.maps.places.Autocomplete((document.getElementById('autocomplete')), {});
}

$(document).ready(function () {

    function boldString(str, find){
        var regex = new RegExp(find, 'gi');
        var tymps = regex.exec(str);
        if(tymps != null){
            find = tymps[0];
        }
        return str.replace(regex, '<b>'+find+'</b>');
    }

    $('#autocomplete').focus(function() {
        $('#hotel_list').css('display','block');
        $('#places_list').css('display','block');
    });

    $('#autocomplete').typeahead({
        source: function (query, result) {

            var input = $('#autocomplete').val();
            $('.pac-container').css('display','block');
            $('.pac-logo:after').css('display','block');
            $('#places_list').html('<h3>Location</h3>');

            $.ajax({
                url: '/api/v1/search/hotelList?string='+input,
                type: 'GET',

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
            $('.pac-container').css('display','none!important');
            $('.pac-logo:after').css('display','none!important');
        }
    });

    $('#autocomplete').blur(function() {
        $('#hotel_list').css('display','none');
        $('#places_list').css('display','none');
    });
});