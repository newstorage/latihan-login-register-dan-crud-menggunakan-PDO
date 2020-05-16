<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo $page_title; ?></title>
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />


    <!-- our custom CSS -->
    <link rel="stylesheet" href="css/custom.css" />
    <style type="text/css" media="print">
        @media print {
            .print-area {
                background-color: white;
                height: 100%;
                width: auto;
                position: absolute;
                top: 0;
                bottom: 0;
                left: 0;
                right: 0;
                z-index: 1500;
                visibility: visible;
            }

            .noprint {
                visibility: hidden;
            }

            @page {
                /* size: portrait;*/
                /* margin: 1cm;*/
                size: auto;
                /* auto is the initial value */
                margin: 0;
                /* this affects the margin in the printer settings */
            }

            /*IF print-area parent element is position:absolute*/
            .ui-dialog,
            .ui-dialog .ui-dialog-content {
                position: unset !important;
                visibility: hidden;
            }

            html {
                background-color: #FFFFFF;
                margin: 0px;
                /* this affects the margin on the html before sending to printer */
            }
        }
    </style>
</head>

<body>

    <!-- container -->
    <div class="container">

        <?php
        // show page header
        echo "<div class='page-header'>
                <h1>{$page_title}</h1>
            </div>";
        ?>