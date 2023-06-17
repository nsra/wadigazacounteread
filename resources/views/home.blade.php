<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>بلدية وادي غزة - تطبيق قراءة العداد</title>
        <link rel="stylesheet" href='{{ asset("./css/bootstrap.rtl.min.css") }}' />
        <link rel="stylesheet" href='{{ asset("./css/style.css") }}' />

    </head>
    <body class="antialiased" dir="rtl">
        <div class="relative flex justify-center mt-5 sm:items-center sm:pt-0">
            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                <br>
                <div class="text-center">
                    <h3> تطبيق قراءة العدادات </h3>
                </div>
                <div class="flex text-center mt-5 pt-8 sm:pt-0">
                    <img src= '{{ asset("./images/Asset1.png")}}' width="170px" alt="">
                </div>
                <div class="container py-5" style="padding-right: 20%; padding-left: 20%">
                    <div class=" row">
                        <div class="col-md-3 text-center mt-2">
                            <a class="btn btn-success" href="./counterforths"> موقع 00-06 </a>
                        </div>
                        <div class="col-md-3 text-center mt-2">
                            <a class="btn btn-success" href="./counterseconds"> مــــوقـــع 07 </a>
                        </div>
                        <div class="col-md-3 text-center mt-2">
                            <a class="btn btn-success" href="./counterthirds"> مــــوقـــع 08 </a>
                        </div>
                        <div class="col-md-3 text-center mt-2">
                            <a class="btn btn-success" href="./counters"> مــــوقـــع 09 </a>
                        </div>
                    </div>

                </div>
                <br>

                <div class="flex justify-center mt-4 sm:items-center sm:justify-between">
                    
                    <div class="ml-4 text-center text-sm text-gray-500 sm:ml-0">
                        CountersReading Application v1.6.0
                        <br>
                        Eng. Entesar k. ElBanna 
                        <br>
                        Copyright &copy; {{date('Y')}} Municipality Of WadiGaza
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
