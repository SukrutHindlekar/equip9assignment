<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="http://placehold.it/64.png/000/fff">
    <!-- Retina iPad Touch Icon-->
    <link rel="apple-touch-icon" sizes="144x144" href="http://placehold.it/144.png/000/fff">
    <!-- Retina iPhone Touch Icon-->
    <link rel="apple-touch-icon" sizes="114x114" href="http://placehold.it/114.png/000/fff">
    <!-- Standard iPad Touch Icon-->
    <link rel="apple-touch-icon" sizes="72x72" href="http://placehold.it/72.png/000/fff">
    <!-- Standard iPhone Touch Icon-->
    <link rel="apple-touch-icon" sizes="57x57" href="http://placehold.it/57.png/000/fff">

    <!-- Styles -->
    <link href="<?php echo ASSETSPATH; ?>css\Chart.css" rel="stylesheet">
    <link href="<?php echo ASSETSPATH; ?>css\custom.css" rel="stylesheet">
    <link href="<?php echo ASSETSPATH; ?>css\track.css" rel="stylesheet">
    <link href="<?php echo ASSETSPATH; ?>css\lib\themify-icons.css" rel="stylesheet">
    <link href="<?php echo ASSETSPATH; ?>css\lib\owl.carousel.min.css" rel="stylesheet">
    <link href="<?php echo ASSETSPATH; ?>css\lib\owl.theme.default.min.css" rel="stylesheet">
    <link href="<?php echo ASSETSPATH; ?>css\lib\weather-icons.css" rel="stylesheet">
    <link href="<?php echo ASSETSPATH; ?>css\lib\mmc-chat.css" rel="stylesheet">
    <link href="<?php echo ASSETSPATH; ?>css\lib\sidebar.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>


    <link rel="stylesheet" href="<?php echo ASSETSPATH; ?>css/bootstrap.min.css">
    <script src="<?php echo ASSETSPATH; ?>js/bootstrap.min.js"></script>
    <script src="<?php echo ASSETSPATH; ?>js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="<?php echo ASSETSPATH; ?>css/style.css">

    <link href="<?php echo ASSETSPATH; ?>css/lib/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo ASSETSPATH; ?>css/lib/bootstrap.min.css" rel="stylesheet">


    <link href="<?php echo ASSETSPATH; ?>css/lib/unix.css" rel="stylesheet">



    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Equip9 Assignment</title>
    <link href="">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="<?= ASSETSPATH ?>js/sweetalert2.all.min.js"></script>

    <style type="text/css">
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap');

        /* password icon css */
        .field-icon {
            float: right;
            margin-right: 8px;
            margin-top: -13px;
            position: relative;
            z-index: 2;
            cursor: pointer;
        }

        #cover-spin {
            position: fixed;
            width: 100%;
            left: 0;
            right: 0;
            top: 0;
            bottom: 0;
            background-color: rgba(255, 255, 255, 0.7);
            z-index: 9999;
            display: none;
        }

        @-webkit-keyframes spin {
            from {
                -webkit-transform: rotate(0deg);
            }

            to {
                -webkit-transform: rotate(360deg);
            }
        }

        @keyframes spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }


        #cover-spin::after {
            content: '';
            display: block;
            position: absolute;
            left: 48%;
            top: 40%;
            width: 40px;
            height: 40px;
            border-style: solid;
            border-color: black;
            border-top-color: transparent;
            border-width: 4px;
            border-radius: 50%;
            -webkit-animation: spin .8s linear infinite;
            animation: spin .8s linear infinite;
        }

        .card {
            position: relative;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-direction: column;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid rgba(0, 0, 0, .125);
            border-radius: .0.75rem;
            border-top-left-radius: .75rem;
            border-bottom-right-radius: .75rem;

        }

        .expected-vs-actual {
            position: relative !important;
            -webkit-box-flex: 1 !important;
            -ms-flex: 1 1 auto !important;
            flex: 1 1 auto !important;
            max-height: calc(100vh) !important;
            overflow-y: auto !important;
            padding: 1rem !important;
        }

        .td-width {
            max-width: 200px;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }

        * {
            font-size: 12px;
            font-weight: bold !important;
            font-family: 'Roboto', 'Sans-serif';

        }

        /* Important part */
        .modal-dialog {
            overflow-y: initial !important
        }

        .modal-body {
            height: 80vh;
            overflow-y: auto;
        }
    </style>
</head>

<body>