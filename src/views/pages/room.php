<?php ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../sass/global.css">
    <link rel="stylesheet" href="../sass/room.css">
</head>

<body>
    <header>
        <div class="room-header">
            <div class="room-back">←</div>
            <div class="room-name">部屋1</div>
        </div>
    </header>

    <section class="content">
        <div class="say right">
            <div class="chatting">
                <div class="sc">
                    <p>サンプルサンプルサンプルサンプルサンプル</p>
                </div>
            </div>
        </div>
        <div class="say left" id="b">
            <p class="face_icon">
                <img src="../freePage images/m.jpeg" alt="m" width="110">
                <span>かずき</span>
            </p>
            <div class="chatting">
                <div class="sc">
                    <p>サンプルサンプルサンプルサンプルサンプル</p>
                </div>
            </div>
        </div>
    </section>

    <section>
        <form action="">
            <input type="text" placeholder="Aa">
            <input type="submit" value="送信">
        </form>
    </section>
</body>

</html>