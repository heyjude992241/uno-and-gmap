<!DOCTYPE html>
<html>
    <head>
        <title>Simple Map</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" />
        <link href="{!! asset('jqueryui-custom/jquery-ui.min.css') !!}" rel="stylesheet" />
        <meta name="viewport" content="initial-scale=1.0">
        <meta charset="utf-8">
        <style>
            /* Always set the map height explicitly to define the size of the div
            * element that contains the map. */
            #map {
                height: 100%;
            }
            /* Optional: Makes the sample page fill the window. */
            html, body {
                height: 100%;
                margin: 0;
                padding: 0;
                overflow-x: hidden;
            }
            .row{
                height: 100%;
            }

            .container{
                height: 100%;
            }

            .col-sm-2, .col-sm-10{
                padding: 0;
            }

            .col-sm-2{
                overflow-y: scroll;
                overflow-x: scroll;
            }

            .navbar-brand {
                color:azure !important;
            }

            nav{
                margin-bottom: 20px;
            }

            .recenter{
                height: 30px;
                width: 30px;
            }


        </style>
    </head>
    <body>
        <div class="row">
            <div class="col-sm-10">
                <div id="map"></div>
            </div>
            <div class="col-sm-2">
                <nav class="navbar navbar-light bg-success">
                    <a class="navbar-brand" href="#">Control Panel</a>
                    <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#uploadModal">+</button>
                </nav>
                <div class="container">
                    <button type="button" id="btnCenter" class="btn btn-dark btn-sm">
                        <img src="{!! asset('img/aim.png') !!}" class="recenter" alt="recenter" /> Recenter
                    </button>
                    <table class="table table-striped">
                        <tr>
                            <th>#</th>
                            <th>lat</th>
                            <th>lng</th>
                        </tr>
                        <tr>
                            <td colspan="3">No data available</td>
                        </tr>
                    </table>
                    <div class="wrapper">
                        Map scale: <span id="scale">15</span>
                        <div id="slider"></div>
                    </div>
                </div>

            </div>
        </div>

        <div id="uploadModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    {!! Form::open(['id'=> 'formMap','class'=>'form-horizontal']) !!}
                    <div class="modal-body">
                        {!! Form::file('upload', ['class'=>'form-control']) !!}
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="submit">Upload</button>
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="{!! asset('jqueryui-custom/jquery-ui.min.js') !!}"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <script>
            var map, marker;
            var center = {lat: 2.976035, lng: 101.7381326}
            function initMap() {

                map = new google.maps.Map(document.getElementById('map'), {
                    center: center,
                    zoom: 15
                });
                marker = new google.maps.Marker({position: center, map: map})
            }
            $(function(){
                $('#slider').slider({
                    orientation: "horizontal",
                    range: "max",
                    min: 0,
                    max: 18,
                    value: 15,
                    slide: (event, ui) => {
                        console.log("Slide action");
                        $('#scale').html(ui.value);
                        map.setZoom(ui.value);
                    }
                });

                $('#formMap').on('submit', function(e){
                    e.preventDefault();
                    console.log("Submit form");
                });

                $('#btnCenter').on('click', function(event){
                    map.setCenter(center)
                });
            })
            </script>
            <script src="https://maps.googleapis.com/maps/api/js?key={!! config('app.google_maps_api') !!}&callback=initMap"
            async defer></script>
    </body>
</html>
