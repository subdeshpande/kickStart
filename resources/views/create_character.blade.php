<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
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
                font-size: 48px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 22px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            .error {
			    color: #D8000C;
                font-size: 18px;
		    }
            .success {
			    color: #4F8A10;
                font-size: 18px;
		    }
        </style>
    </head>
    <body>
        <form action="/api/create_character" method="post">
            <div class="flex-center position-ref full-height">
                <div class="content">
                    <div class="links">
                        <a href="/">Back</a>
                    </div>
                    @if(!empty($error))
                        @foreach ($error as $errorItem)
                            <div class="error">
                                {{ $errorItem }} 
                            </div>
                        @endforeach
                    @endif
                    @if(!empty($success))
                        <div class="success">
                            {{ $success }} 
                        </div>
                    @endif
                    <div class="title m-b-md">
                        Create Character
                    </div>
                    <div style="text-align: right;"> 
                        <div class="links">
                            <span style="text-align: right; width: 1000px;font-size: 20px; color: black">Name</span>
                            <input name="name" value="" class="from-control" style="width:300px; height:25px">
                        </div>  
                        <div class="links">
                            <span style="text-align: right; width: 1000px;font-size: 20px; color: black">Height</span>
                            <input name="height" value="" class="from-control" style="width:300px; height:25px">
                        </div> 
                        <div class="links">
                            <span style="text-align: right; width: 1000px;font-size: 20px; color: black">Mass</span>
                            <input name="mass" value="" class="from-control" style="width:300px; height:25px">
                        </div>
                        <div class="links">
                            <span style="text-align: right; width: 1000px;font-size: 20px; color: black">Hair Colour</span>
                            <input name="hair_color" value="" class="from-control" style="width:300px; height:25px">
                        </div>
                        <div class="links">
                            <span style="text-align: right; width: 1000px;font-size: 20px; color: black">Birth Year</span>
                            <input name="birth_year" value="" class="from-control" style="width:300px; height:25px">
                        </div>
                        <div class="links">
                            <span style="text-align: right; width: 1000px;font-size: 20px; color: black">Gender</span>
                            <input name="gender" value="" class="from-control" style="width:300px; height:25px">
                        </div>
                        <div class="links">
                            <span style="text-align: right; width: 1000px;font-size: 20px; color: black">Homeworld Name</span>
                            <input name="homeworld_name" value="" class="from-control" style="width:300px; height:25px">
                        </div>
                        <div class="links">
                            <span style="text-align: right; width: 1000px;font-size: 20px; color: black">Species Name</span>
                            <input name="species_name" value="" class="from-control" style="width:300px; height:25px">
                        </div>
                        <div class="links">
                            <button type="submit" class="btn btn-success" style="width:100px; height:50px; font-size: 20px;"><i class="fa-trash"></i> Create</button>
                        </div>    
                    </div>    
                </div>
            </div>
        </form>    
    </body>
</html>
