{{--
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
        border: 2px solid #7e7d7d1c !important;
    }

    @media print {

        body {margin-top: 2mm; margin-bottom: 12.7mm;
            margin-left: 12.7mm; margin-right: 12.7mm}

        @page{
            /*margin-left: 100px !important;*/
            /* margin: 500px !important;*/
        }

        .table-bordered, .table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th {
            border: 0.5px solid #7e7d7d1c !important;
        }

        span.receipt-copy {
            font-size: 22px;
            font-weight: 600;
            /*background: black;
            color: white;*/
            padding: 3px 15px;
        }
    }
</style>--}}
<link href="https://fonts.googleapis.com/css?family=Holtwood+One+SC|Fugaz+One|Lobster|Merienda|Righteous|Black+Ops+One|Gilda+Display" rel="stylesheet">

<style>
    body {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
        background-color: #FAFAFA;
        /*font: 12pt "Tahoma";*/
    }
    * {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
    }
    .page {
        width: 210mm;
        height: 296mm;
        margin: 10mm auto;
        border: 1px #D3D3D3 solid;
        border-radius: 5px;
        background: white;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }

    .page-content{
        background-color: transparent !important;
    }
    .subpage {
        width: 200mm;
        height: 286mm;
        margin: 10px auto;
        padding: 10px;
        /*height: 257mm;*/
    }

    .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
        padding: 4px !important;
    }

    @page {
        size: A4;
        margin: 0;
    }
    @media print {
        html, body {
            width: 210mm;
            height: 297mm;
        }
        .page {
            margin: 0;
            border: initial;
            border-radius: initial;
            width: initial;
            min-height: initial;
            box-shadow: initial;
            background: initial;
            /*page-break-after: always;*/
        }
    }

</style>