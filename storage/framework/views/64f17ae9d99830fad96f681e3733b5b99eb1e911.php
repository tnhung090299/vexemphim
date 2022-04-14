<!doctype html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Styles -->
    <style type="text/css">
        .cardWrap {
          width: 32em;
          margin: 1em auto;
          color: #fff;
          font-family: sans-serif;
        }

        .card {
          background: linear-gradient(to bottom, #e84c3d 0%, #e84c3d 26%, #ecedef 26%, #ecedef 100%);
          height: 12em;
          float: left;
          position: relative;
          padding: 1em;
          margin-top: 32px;
        }

        .cardLeft {
          border-top-left-radius: 8px;
          border-bottom-left-radius: 8px;
          width: 21em;
        }

        .cardRight {
          width: 6.5em;
          border-left: .18em dashed #fff;
          border-top-right-radius: 8px;
          border-bottom-right-radius: 8px;
        }
        .cardRight:before, .cardRight:after {
          content: "";
          position: absolute;
          display: block;
          width: .9em;
          height: .9em;
          background: #fff;
          border-radius: 50%;
          left: -.5em;
        }
        .cardRight:before {
          top: -.4em;
        }
        .cardRight:after {
          bottom: -.4em;
        }

        h1 {
          font-size: 1.1em;
          margin-top: 0;
        }
        h1 span {
          font-weight: normal;
        }

        .title, .name, .seat, .time {
          text-transform: uppercase;
          font-weight: normal;
        }
        .title h2, .name h2, .seat h2, .time h2 {
          font-size: .9em;
          color: #525252;
          margin: 0;
        }
        .title span, .name span, .seat span, .time span {
          font-size: .7em;
          color: #a2aeae;
        }

        .title {
          margin: 2em 0 0 0;
        }

        .name, .seat {
          margin: .7em 2em 0 0;
        }

        .time {
          margin: .7em 0 0 1em;
        }

        .seat, .time {
          float: left;
        }

        .eye {
          position: relative;
          width: 2em;
          height: 1.5em;
          background: #fff;
          margin: 0 auto;
          border-radius: 1em/0.6em;
          z-index: 1;
        }
        .eye:before, .eye:after {
          content: "";
          display: block;
          position: absolute;
          border-radius: 50%;
        }
        .eye:before {
          width: 1em;
          height: 1em;
          background: #e84c3d;
          z-index: 2;
          left: 8px;
          top: 4px;
        }
        .eye:after {
          width: .5em;
          height: .5em;
          background: #fff;
          z-index: 3;
          left: 12px;
          top: 8px;
        }

        .number {
          text-align: center;
          text-transform: uppercase;
        }
        .number h3 {
          color: #e84c3d;
          margin: .9em 0 0 0;
          font-size: 2.5em;
        }
        .number span {
          display: block;
          color: #a2aeae;
        }

        .barcode {
          height: 2em;
          width: 0;
          margin: 0 0 0 .8em;
        }
    </style>
</head>
<body>
    <?php $__currentLoopData = $bill->tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="cardWrap">
            <div class="card cardLeft">
                <h1><span><?php echo e($ticket->showtime->room->cinema->name); ?></span></h1>
                <div class="title">
                    <h2><?php echo e($ticket->showtime->movie->name); ?></h2>
                    <span>phim</span>
                </div>
                <div class="name">
                    <h2><?php echo e($ticket->showtime->room->cinema->address); ?></h2>
                    <span>địa chỉ</span>
                </div>
                <div class="seat">
                    <h2><?php echo e($ticket->showtime->room->name); ?></h2>
                    <span>phòng</span>
                </div>
                <div class="seat">
                    <h2><?php echo e($Qr = $ticket->seatCol->seat_name); ?></h2>
                    <span>ghế</span>
                </div>
                <div class="time">
                    <h2><?php echo e(\Carbon\Carbon::parse($ticket->showtime->timestart)->format('d/m/Y')); ?></h2>
                    <span>ngày</span>
                </div>
                <div class="time">
                    <h2><?php echo e(\Carbon\Carbon::parse($ticket->showtime->timestart)->format('h:i')); ?></h2>
                    <span>giờ</span>
                </div>
            </div>
            <div class="card cardRight">
                <div class="eye"></div>
                <div class="number">
                    <h3><?php echo e($ticket->seatCol->seat_name); ?></h3>
                    <span>ghế</span>
                </div>
                <div class="barcode"><?php echo QrCode::backgroundColor(236, 237, 239)->size(80)->generate($bill->code . '/' . $Qr);; ?></div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</body>
</html>
<?php /**PATH D:\wampp\www\vexemphim\resources\views\admin\invoice.blade.php ENDPATH**/ ?>