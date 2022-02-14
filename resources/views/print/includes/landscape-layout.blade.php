{{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.3.0/paper.css">--}}
<link rel="stylesheet" href="{{asset('assets/css/paper.css')}}">
<style>
    @page {
        /* margin-top: 5cm;
         margin-bottom: 5cm;*/
    }

    span.receipt-copy {
        font-family:'Alfa+Slab+One';
        font-size: 22px;
        font-weight: 600;
        /*background: #438EB9;
        color: white;*/
        padding: 3px 15px;
    }

    .table-bordered, .table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th {
        /*border: 2px solid #7e7d7d1c !important;*/
        /* border: 1px solid #444 !important;
         padding: 0px 3px 0px 5px;*/
    }


    @media print {

        body {
            margin-top: 6mm; margin-bottom: 6mm;
            margin-left: 12.7mm; margin-right: 6mm
        }

        @page{
            /*margin-left: 100px !important;*/
            /* margin: 500px !important;*/
        }

        .table-bordered, .table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th {
            border: 0.5px solid #7e7d7d1c !important;
            border: 1px solid #444 !important;
            padding: 0px 3px 0px 5px;

        }

        span.receipt-copy {
            font-size: 22px;
            font-weight: 600;
            /*background: black;
            color: white;*/
            padding: 3px 15px;
        }
    }
</style>