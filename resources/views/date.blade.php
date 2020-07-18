<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Coding Challenge : Kaiyum2012</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Custom libs -->
        <script src="{{ asset('js/app.js') }}"> </script>
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    Leap Year Coding Challenge
                </div>
                <div>
                <form id="form">
                    Start Date: <input type="date" id="startDate" />
                    End Date: <input type="date" id="endDate"/>
                    <br/>
                    <input type="submit" text="Calculate"/>
                    </form>
                </div>
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
                    },
                });
            });
        </script>
    </body>
</html>
