<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .invoice {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .invoice h1 {
            text-align: center;
        }

        .invoice table {
            width: 100%;
            border-collapse: collapse;
        }

        .invoice th,
        .invoice td {
            padding: 8px;
            border: 1px solid #ddd;
        }

        .invoice .text-right {
            text-align: right;
        }

        .invoice .text-center {
            text-align: center;
        }

        .invoice .subtotal {
            border-top: 2px solid #000;
            font-weight: bold;
        }
    </style>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
</head>

@php
    use Carbon\Carbon;
    $currentDate = Carbon::now('Asia/Kolkata')->format('d-m-Y');

    $client_materials = $client_materials->get();
    $client_materials_first = $client_materials->first();
    $i=1;
@endphp

<body>

    <!-- Invoice 1 - Bootstrap Brain Component -->
    <section class="py-3 py-md-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-9 col-xl-8 col-xxl-7">
                    <div class="row gy-3 mb-3">
                        <div class="col-6">
                            <h2 class="text-uppercase text-endx m-0">Material Chalan</h2>
                        </div>
                        <div class="col-6">
                            <a class="d-block text-end" href="#!">
                                <img src="{{ URL::to('/') }}/img/bright_footer.jpg" class="img-fluid"
                                    alt="BootstrapBrain Logo" width="135" height="44">
                            </a>
                        </div>
                        <div class="col-6">
                            <h4>From</h4>
                            <address>
                                <strong>Beliance Energy</strong><br>
                                635 - Rk world tower<br>
                                Shital park,150 feet ring road, rajkot - 360 006<br>
                                India<br>
                                Phone: 8511651364<br>
                                Email: info@beliance.in
                            </address>
                            {{-- <hr> --}}
                        </div>
                        <div class="col-2"></div>
                        @if ($client_materials_first)
                        <div class="col-4">
                            <h4 class="row">
                                <span class="col-6" style="align-items: center">To</span>
                                {{-- <span class="col-6 text-sm-end">INT-001</span> --}}
                            </h4>
                            <div class="row">
                                <span class="col-6">Consumer Number</span>
                                <span class="col-6 text-sm-end">{{ $client_materials_first->consumer_number  }}</span>
                                <span class="col-6">Name</span>
                                <span class="col-6 text-sm-end">{{ $client_materials_first->sell_product_client->name }}</span>
                                <span class="col-6">KW</span>
                                <span class="col-6 text-sm-end">{{ $client_materials_first->sell_product_client->kw }}</span>
                                <span class="col-6">Report Date</span>
                                <span class="col-6 text-sm-end">{{ $currentDate}}</span>
                            </div>
                        </div>
                        @endif
                        
                        <hr style="border: none; border-top: 5px solid black;">


                    </div>

                    @if ($client_materials_first)
                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-uppercase">Sr.No.</th>
                                            <th scope="col" class="text-uppercase">Product Name</th>
                                            <th scope="col" class="text-uppercase">Quantity</th>
                                            <th scope="col" class="text-uppercase">Date</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-group-divider">
                                        @foreach ($client_materials as $client_material)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $client_material->product_name }}</td>
                                            <td>{{ $client_material->product_quantity }}</td>
                                            <td>{{ $client_material->date }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @else
                        <h1 style="color: red">Material added first</h1>
                    @endif



                </div>
            </div>
        </div>
    </section>

</body>

</html>
