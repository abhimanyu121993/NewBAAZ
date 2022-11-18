<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Baaz|Print Jobcard </title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('upload/bazz_logo.png') }}">
    <link href="img/logo.png" type="images/x-icon" rel="shortcut icon">
    <link href="fonts/algeria.ttf">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Custom fonts for this template-->
    <!-- <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
    <!-- Custom styles for this template-->

    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <style>
        table tr,
        th,
        td {
            /* border: 1px solid black; */
            /* border-collapse:collapse; */
            padding: 7px 8px;

        }

        table tr th {

            font-size: 15px;
            background-color: #f1c26c;
            color: #010360;
        }

        table tr td {
            font-size: 17px;

        }

        table {
            border-collapse: collapse;
        }

        @font-face {
            font-family: "ALGERIA";
            src: url("fonts/ALGERIA.TTF");
        }

        b {
            color: #010360;
        }

        #new {
            background-color: #010360;
        }
    </style>
</head>

<body>
    @if ($jobcard)
        @if ($jobcard->status == 1)
            <div class="container">
                <!-- <p class="text-center mt-2">Invoice</p> -->
                <center><button style="border:none;" onclick="window.print()">Print</button></center><br>

                <div class="container">
                    <div class="row">
                        <div class="col text-center">
                            <img src="{{ asset('upload/bazz_logo.png') }}" height="100" width="200"/>
                            <h4 style="text-align:center; margin-top: 12px;">BAAZ JOBCARD</h4>
                        </div>
                        <div class="col">
                            <img src="{{ asset('Backend/assets/images/vector_car.png') }}" height="200" width="500"/>
                        </div>
                    </div>
                    <br />
                    <div class="row text-center">
                        <div class="col">
                            <b>Relationship Manager Name</b>
                            <p>{{ $jobcard->rmname }}</p>
                        </div>
                        <div class="col">
                            <b>Relationship Manager Number</b>
                            <p>{{ $jobcard->rmno }}</p>
                        </div>
                        <div class="col">
                            <b>Jobcard Created Date</b>
                            <p>{{ \Carbon\Carbon::parse($jobcard->created_at)->format('d/m/Y') }}</p>
                        </div>
                    </div>
                </div>
                <br />
                <table class="table" style="width:100%; margin:0 auto; ">
                    <thead>
                        <tr id="new">
                            <th scope="col">Registered Vehicle Number</th>
                            <th scope="col">Odometer Reading</th>
                            <th scope="col">Manufacturing Year</th>
                            <th scope="col">Arrival Mode</th>
                            <th scope="col">Mechanic Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $jobcard->regno }}</td>
                            <td>{{ $jobcard->odometer_reading }}</td>
                            <td>{{ $jobcard->manufacturing_year }}</td>
                            <td>{{ $jobcard->arrival_mode }}</td>
                            <td>{{ $jobcard->mechanic_name }}</td>
                        </tr>
                    </tbody>
                </table>
                <br />
                <table class="table" style="width:100%; margin:0 auto; ">
                    <thead>
                        <tr id="new">
                            <th scope="col">Walkin Date</th>
                            <th scope="col">Walkin Time</th>
                            <th scope="col">Customer Name</th>
                            <th scope="col">Customer Phone</th>
                            <th scope="col">Customer Email</th>
                            <th scope="col">Customer Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $jobcard->walkin_date }}</td>
                            <td>{{ $jobcard->walkin_time }}</td>
                            <td>{{ $jobcard->cust_name }}</td>
                            <td>{{ $jobcard->cust_phone }}</td>
                            <td>{{ $jobcard->cust_email }}</td>
                            <td>{{ $jobcard->cust_address }}</td>
                        </tr>
                    </tbody>
                </table>
                <br />
                <table class="table" style="width:100%; margin:0 auto; ">
                    <thead>
                        <tr id="new">
                            <th scope="col">Fuel Level</th>
                            <th scope="col">Floor Mat</th>
                            <th scope="col">Wheel Cap</th>
                            <th scope="col">Head Rest</th>
                            <th scope="col">Mud Flap</th>
                            <th scope="col">Battery</th>
                            <th scope="col">Interior Inventory Check</th>
                            <th scope="col">Document</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $jobcard->fuel_level }}</td>
                            <td>{{ $jobcard->floor_mat }}</td>
                            <td>{{ $jobcard->wheel_cap }}</td>
                            <td>{{ $jobcard->head_rest }}</td>
                            <td>{{ $jobcard->mud_flap }}</td>
                            <td>{{ $jobcard->battery->name ?? '' }}</td>
                            <td>{{ $jobcard->interior_inventory }}</td>
                            <td>{{ $jobcard->document }}</td>
                        </tr>
                    </tbody>
                </table>
                <br />
                <table class="table" style="width:100%; margin:0 auto; ">
                    <thead>
                        <tr id="new">
                            <th scope="col" class="text-center">Voice of customer</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">{{ $jobcard->voc }}</td>
                        </tr>
                    </tbody>
                </table>

            </div>
        @endif
    @else
        <div class="container">
            <h2 style="text-align:center; margin-top: 12px;">BAAZ JOBCARD</h2>
            <br />
            <hr />
            <h5 class="text-center">Jobcard Not Available</h5>
        </div>
    @endif





    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>

</body>

</html>
