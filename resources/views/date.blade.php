<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Coding Challenge : Kaiyum2012</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Custom JS -->
        <script src="{{ asset('js/app.js') }}"> </script>
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    </head>
    <body>
        <div class="container flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    Coding Challenge
                   <div class="sub-title" > Date Diff Calculator </div>
                </div>
                <form id="form">
                    <div class="form-group">
                    <label for="startDate">Start Date:</label> 
                        <input type="date" id="startDate"/></br>
                    </div>
                    <div class="form-group">
                    <label for="endDate"> End Date: </label>  
                        <input type="date" id="endDate"/>
                    </div>
                    <div class="form-group">
                        <input class="btn btn-primary" type="submit" text="Calculate"/>
                        <a class="btn btn-outline-secondary" href="#" id="btn-date-history"> History </a>
                    </div>
                    <div class="form-group">
                        
                    </div>
                </form>
                <div class="row justify-content-md-center">
                    <div class="col-md-auto">
                        <div class="flash-message"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="history"> 
            <h1>History</h1>
            <hr>
            <div id="records">
                <p>No History</p>
            </div>
        </div>

        @if(config('app.env') == 'local')
            <script src="http://localhost:35729/livereload.js"></script>
        @endif
        <script type="text/javascript">
            $('#form').on('submit',function(event){
                event.preventDefault();
                let startDate = $('#startDate').val();
                let endDate = $('#endDate').val();
                $.ajax({
                    url: "/date/calculate",
                    type:"POST",
                    data:{
                        "_token": "{{ csrf_token() }}",
                        sDate:startDate,
                        eDate:endDate,
                    },
                    success:function(response){
                        console.log(response);
                        let result = JSON.parse(response);
                        if(result['success']){
                        $('div.flash-message').html("<p class='alert alert-success'> difference in days =" + result['days'] + "</p>");
                        }
                        // Refresh history
                        renderHistory(event);
                    },
                    error:function(response){
                        // Default response HTTP 422 from laravel on form validation error
                        if(response.status == 422){
                            let x = JSON.parse(response.responseText);
                            let errors = x['errors'];
                            $('div.flash-message').html("")
                            $.each(errors, function (key, value) {
                                $('div.flash-message').append("<p class='alert alert-danger'>"+ value +"</p>");
                            });
                        }
                    }
                });
            });

            $('#btn-date-history').on('click',function(event){
                event.preventDefault();
                console.log("history");
                
                renderHistory(event);
            });

            function renderHistory(){
                $.ajax({
                    url: "/date/history",
                    type:"GET",
                    data:{
                        "_token": "{{ csrf_token() }}",
                    },
                    success:function(response){
                        // console.log(response);
                        $('div.history #records').html("");    
                        let result = JSON.parse(response);
                        $.each(result,function(key,value){
                            let x = '<div class="card"><div class="card-body"><h5 class="card-title"> Days:'+ value['days']  +'</h5>'+
                            '<p class="card-text">Start date : <strong>'+ value['start_date']  +'</strong></p>'+
                            '<p class="card-text">end date : <strong>'+ value['end_date']  +'</strong></p></div>';
                            $('div.history #records').append(x);
                        });
                    }
                });
            }
        </script>
    </body>
</html>
