<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="desktop.css">
    <link rel="stylesheet" href="mobile.css">
    <title>CV</title>
</head>
<style>
    body {
        padding: 0;
        margin: 0 auto;
        font-size: .8rem;
    }
    header {
        position: fixed;
        width: 100%;
        z-index: 2;
        margin-left: 0;
        margin-top: 3rem;
        background-color: white;
        padding: 1rem;
        color: white;
    }
    #headerContent {
        height: 150px;
        width: 100%;
        background-color: #078a8a;
        display: flex;
    }
    #photoProfil {
        align-self: center;
        margin-left: 1rem;
    }

    #basics {
        margin-left: 2rem;
    }
    aside {
        width: 150px;
        height: 100vh;
        position: fixed;
        z-index: 1;
        top: 0;
        background-color: black;
        color: white;
    }
    #skills {
        margin: 35vh 1rem 0 1rem;
    }
    .progressBar {
        margin-top: .5rem;
        width: 80px;
        height: .2rem;
        border: 1px solid rgba(255, 255, 255, .5);
    }
    .progressBar div {
        background-color: green;
        height: 100%;
        position: relative;
        z-index: 3;
    }

    section {
        margin-left: 150px;
        padding: 14rem 1rem;
    }
    .titleSection {
        background-color: #078a8a;
        padding: .2rem;
        color: white;
    }
    #works li {
        padding: 1rem 0;
        line-height: 1.2rem;
    }
</style>
<body>
<?php
$datas = json_decode(file_get_contents('datas.json'));
?>
<header>
    <div id="headerContent">
        <img src="./assets/me.jpg" alt="photo de profil" height="125" id="photoProfil">
        <div id="basics">
            <?php
            foreach ($datas->basics as $key => $value) {
                if ($key === "name") {
                    echo("<h1>{$value}</h1>");
                } else {
                    echo("<img src='./assets/{$key}.ico'/> {$value}<br>");
                }
            }
            ?>
        </div>
    </div>
</header>
<aside>
    <div id="skills">
        <?php
        foreach ($datas->skills as $skill) {
            echo("{$skill->name} : <br> <div class='progressBar'><div data-width='{$skill->level}'></div></div><br>");
        }
        ?>
    </div>
</aside>
<section>
    <div id="profil">
        <h3 class="titleSection">Profil</h3>
        <?= $datas->profile ?>
    </div>
    <div id="works">
        <h3 class="titleSection">Expériences professionnels</h3>
        <ul>
        <?php
            foreach ($datas->works as $work) {
                $string = "<li>";
                 if ($work->name !== null) $string .= "<strong>{$work->name}</strong>";
                 if ($work->years !== null) $string .= "<br>- {$work->years}";
                 if ($work->company !== null) $string .= "<br>- {$work->company}";
                 $string .= '<br>';
                foreach ($work->missions as $mission) {
                    $string .= "{$mission}<br>";
                }
                $string .= "</li>";
                echo($string);
            }
        ?>
        </ul>
    </div>
    <div id="courses">
        <h3 class="titleSection">Formations</h3>
        <?php
            foreach ($datas->courses as $course) {
                echo("{$course}<br>");
            }
        ?>
    </div>
</section>
<script>
    function progressBarSizes (windowWidth) {
        const progressBars = document.querySelectorAll('.progressBar')
        progressBars.forEach(elem => {
            const div = elem.querySelector('div')
            if (windowWidth > 1200) {
                const width = parseFloat(div.getAttribute('data-width')) * 15
                div.style.width = width + 'px'
            } else {
                const width = parseFloat(div.getAttribute('data-width')) * 8
                div.style.width = width + 'px'
            }
        })
    }

    function headerSize (windowWidth) {
        const bodyWidth = document.body.clientWidth
        const header = document.querySelector('header')
        header.style.width = bodyWidth + 'px'
    }

    (function init () {
        document.querySelector('#skills').setAttribute('data-initial-width', window.innerWidth.toString())
        progressBarSizes(window.innerWidth)
        headerSize(window.innerWidth)
    })()

    window.addEventListener('resize', function (e) {
        progressBarSizes(window.innerWidth)
        headerSize(window.innerWidth)
    })
</script>
</body>
</html>