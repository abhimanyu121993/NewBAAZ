<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Baaz|Print Bill </title>
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
    <div class="container">
        <!-- <p class="text-center mt-2">Invoice</p> -->
        <center><button style="border:none;" onclick="window.print()">Print</button></center><br>
        <div class="container">
            </center>
            <table style="width:100%; margin:0 auto;">
                <tbody>
                    <tr>
                        <td colspan="4"><img src="{{ asset('upload/bazz_logo.png') }}" height="120px"
                                width="200px" /></td>

                        <td class="text-center" colspan="4"><span
                                style="font-size:50px;color:orange; font-weight:bolder; font-family:'Cambria';margin-right: 50px; text-align: center;">Tax
                                Invoice</span>
                        </td>
                        <td colspan="4">

                            <b> Invoice No. </b>
                            <b>
                                55445511
                            </b>
                        </td>

                    </tr>

            </table>
        </div>
        <div class="container">
            </center>
            <table>
                <tbody>
                    <div class="row">
                        <div class="col">
                            <h3 style="color:#010360">{{ $order->workshop_order->workshop->name ?? '' }}</h3>
                            <p style="color: black; padding: 0px !important;margin:0px !important">{{ $order->workshop_order->workshop->address ?? '' }}</p>
                            {{-- <p style="color: black; "> LUCKNOW 226010 </p> --}}
                        </div>
                        <div class="col">
                            <b>GSTIN:</b>-09DZNPK225R1ZJ<br>
                            <b>State:</b>-09-Uttar Pradesh<br>
                            <b>PAN:</b>-DZNPK2252R</span><br>
                        </div>
                        <div class="col">
                            <h3 style="color:#010360">BAAZ CAR SERVICES</h3>
                            <p>SECTOR-E LDA COLONY,<br>
                                KANPUR ROAD,LUCKNOW,<br>
                                Uttar Pradesh 226012 <br>
                                9889488880 <br>
                                info@baazservices.com</p>
                        </div>
                    </div>
        </div>
        <hr>
        <div class="container">
            <div class="row">
                <div class="col">
                    <b>Customer Name</b>
                    <p>{{ $order->user->name ?? '' }}</p>
                </div>
                <div class="col">
                    <b>Car:-</b>
                    <p>{{ $order->order_details[0]->model->brand->name}} {{ $order->order_details[0]->model->name ?? '' }}</p>
                </div>
                <div class="col">
                    <b>Shipping Address:-</b>
                    <p>{{ $order->user->userad[0]->address ?? '' }}</p>
                </div>
            </div>
        </div>
        <hr>
        <div class="container text-center">
            <div class="row">
                <div class="col d-flex">
                    <b> Place of Supply:</b>
                    <p>{{ $order->user->userad[0]->city ?? '' }} {{ $order->user->userad[0]->state ?? '' }}</p>

                </div>
                <div class="col d-flex"></div>
                <div class="col d-flex">
                    <b> Due Date:-</b>
                    <p>{{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y')}}</p>
                </div>
            </div>
        </div>
        <hr>
        <h2 style="text-align:center;color:#010360;">Service Charges</h2>
        <table class="table" style="width:100%; margin:0 auto; ">
            <thead>
                <tr>
                    <th scope="col">Sr.No</th>
                    <th scope="col">item</th>
                    <th scope="col">Rate/Item(&#8377)</th>
                    <th scope="col">Total(&#8377)</th>
                </tr>
            </thead>
            <tbody>
                @if ($serviceDetails)
                    @foreach ($serviceDetails->workshop_order_details as $sd)
                        @if ($sd->type == 'Service')
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $sd->service_charge->name ?? '' }}</td>
                                <td>{{ App\Models\Service::getServicePriceById($sd->service_charge->id, $order->order_details[0]->model->id )[0] }}</td>
                                <td>{{ App\Models\Service::getServicePriceById($sd->service_charge->id, $order->order_details[0]->model->id )[0] }}</td>
                            </tr>
                        @endif
                    @endforeach
                @else
                    <tr>
                        <td colspan="100%" class="text-center">No data found</td>
                    </tr>
                @endif
            </tbody>
        </table>
        <br>
        <h2 style="text-align:center; margin-top: 12px;color:#010360;">Labour Charges
        </h2>
        <table class="table" style="width:100%; margin:0 auto; ">
            <thead>
                <tr id="new">
                    <th scope="col">Sr.No</th>
                    <th scope="col">Name</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Price(&#8377)</th>
                    <!-- <th scope="col">TOTAL(&#8377)</th> -->
                </tr>
            </thead>
            <tbody>
                @if ($serviceDetails)
                    @foreach ($serviceDetails->workshop_order_details->where('type', 'ServiceCharge') as $sd)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $sd->labour_charge->name ?? '' }}</td>
                            <td>1</td>
                            <td>{{ $sd->amount ?? '' }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="100%" class="text-center">No data found</td>
                    </tr>
                @endif
            </tbody>
        </table><br>
        <h2 style="text-align:center; margin-top: 12px;color:#010360;">Spare Charges
        </h2>
        <table class="table" style="width:100%; margin:0 auto; ">
            <thead>
                <tr id="new">
                    <th scope="col">Sr.No</th>
                    <th scope="col">Name</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Price(&#8377)</th>
                    <!-- <th scope="col">TOTAL(&#8377)</th> -->
                </tr>
            </thead>
            <tbody>
                @if ($serviceDetails)
                    @foreach ($serviceDetails->workshop_order_details->where('type', 'OtherProduct') as $sd)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $sd->spare_charge->name ?? '' }}</td>
                            <td>1</td>
                            <td>{{ $sd->amount ?? '' }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="100%" class="text-center">No data found</td>
                    </tr>
                @endif
            </tbody>
        </table>
        <table class="table" style="width:100%; margin:0 auto;">
            <div class="container ">
                <div class="col mt-5">
                    <p><b>Remark :</b> {{ $order->remark ?? 'No Remark' }}</p>
                </div>
                <div style="float: right; height:auto;width:auto; ">
                    <div class="col"><br>

                        {{-- <div class="d-flex"><b>DISCOUNT</b>&nbsp;&nbsp;&nbsp;<p>&#8377 39</p><br></div> --}}
                        <div class="d-flex"><b>Total Amount </b>&nbsp;&nbsp;<p>&#8377
                                {{ isset($order->workshop_order->total_amount) ? $order->workshop_order->total_amount : 0 }}
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </table>
        <hr>
        <h4 style=" color: black;">Bank Details:</h4>
        <table class="table" style="width:100%;">
            <div class="row ">

                <div class="col-4 ">
                    <b>Account Number</b>
                    <p>88754545122145</p>
                    <b>IFSC</b>
                    <p>SBIN0023</p>

                </div>
                <div class="col-4">
                    <b>Bank Name</b>
                    <p>Bank Of Baroda</p>
                    <b>Branch Name</b>
                    <p>LDA COLONY LUCKNOW</p>
                </div>
                <div class="col-4" style="float: right; ">
                    <p>From BAAZ CAR SERVICES</p><br><br>
                    <hr>Authorised Signatory

                </div>

                <div style="height:auto;width:auto; margin-left: 1%;"> <br>
                    <p>Terms & Conditions:- Subject to Lucknow jurisdiction only</p>
                </div>
            </div>
        </table>
    </div>


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
