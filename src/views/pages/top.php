<?php $title = "トップ画面";
    $cssLink = "../sass/top.css";
?>
<?php include("../components/header.php"); ?>
    <section>
        <form action="">
            <input type="text" placeholder="room名">
            <input type="submit" value="検索">
        </form>
    </section>

    <section>
        <div class="room-box">
            <div>部屋1</div>
            <div>部屋1</div>
            <div>部屋1</div>
            <div>部屋1</div>
        </div>
    </section>

    <section>
        <button class="create-room-bottun">部屋を作る→</button>
    </section>

</body>

</html>