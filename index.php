<?php
session_start();
$mass = 50;
$len = 100;
$gravity = 10;
if (isset($_SESSION["auth"])) {
    $db = dba_open("savedparameters.db", 'c');
    if (dba_exists($_SESSION["user"], $db)) {
        $serialized_data = dba_fetch($_SESSION["user"], $db);
        $unserialized = unserialize($serialized_data);
        $mass = $unserialized[0];
        $len = $unserialized[1];
        $gravity = $unserialized[2];
    }
}
?>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Strona główna</title>
</head>

<body>
    <header>
        <h1>Ruch harmoniczny i wahadło matematyczne</h1>
        <nav>
            <a href=#>Strona domowa</a> |
            <?php
            if (isset($_SESSION["auth"])) {
                echo "<a href=" . "userpanel.php" . ">Panel użytkownika: " . $_SESSION['user'] . "</a> | ";
                echo "<a href=" . "logout.php" . ">Wyloguj się</a> | ";
            } else {
                echo "<a href=" . "login.php" . ">Logowanie</a> | ";
            }
            ?>
        </nav>
    </header>
    <div class="wrapper">
    <article>
            <div class="chapter">
                <br>
                <h2>Czym jest ruch drgający?</h2>
                Ruch drgający to rodzaj ruchu, w którym ciało porusza się okresowo wokół swojej pozycji równowagi,
                przechodząc przez cykle regularnych zmian w czasie. 
                Te cykle mogą być opisane matematycznie jako funkcje sinusoidalne.
                Drgania są powszechne i występują w różnych dziedzinach fizyki, inżynierii i przyrodzie.
                Podstawowymi wielkościami opisującymi ruch drgający są:
                <ul>
                    <li>Amplituda - maksymalne odchylenie ciała od pozycji równowagi.</li>

                    <li>Okres - Czas potrzebny do wykonania jednego pełnego cyklu drgań.</li>

                    <li>Częstotliwość - Liczba cykli drgań wykonanych w jednostce czasu.</li>

                    <li>Faza - Faza określa położenie ciała w określonym punkcie cyklu drgań</li>
                </ul>
            </div>
        </article>
        <br>
        <article id="wprowadzenie">
            <div class="chapter">
                <br>
                <h2>Czym jest ruch harmoniczny?</h2>
                Ruch harmoniczny jest szczególnym rodzajem ruchu drgającego, w którym wykres zależności wychylenia od czasu ma kształt sinusoidalny.
                Drgania dowolnego rodzaju, nawet bardzo złożone, można przedstawić w postaci sumy drgań harmonicznych o różnych częstotliwościach i amplitudach.
                Podstawowe równania opisujące ruch harmoniczny to:
                <ul>
                    <li>Wzór na położenie w ruchu harmonicznym: x(t)=Acos(ωt+ϕ)</li>

                    <li>Prędkość w ruchu harmonicznym: v(t)=-Aωsin(ωt+ϕ)</li>

                    <li>Przyspieszenie w ruchu harmonicznym: a(t)=-Aω<sup>2</sup>cos(ωt+ϕ)</li>
                </ul>
            </div>
        </article>
        <br>
        <article id="energia">
            <div class="chapter">
                <br>
                <h2>Energia w ruchu harmonicznym</h2>
                W ruchu harmonicznym, energia jest zachowana, co oznacza, że suma energii kinetycznej i energii potencjalnej pozostaje stała w czasie. 
                Całkowita energia w ruchu harmonicznym można wyrazić wzorem:
                <br>
                <p style="text-align: center;">E = E<sub>k</sub> + E<sub>p</sub></p>
                Wzór na energię kintetyczną można wyliczyć ze wzoru: E = &frac12;mv<sup>2</sup>
                <br>Pochylmy się nad klockiem połączonym ze sprężyną, który oscyluje w ruchu harmonicznym, przesuwając się po powierzchni bez tarcia.
                W jaki sposób możemy obliczyć energię potencjalną takiego oscylatora harmonicznego?
                <br>Wykorzystamy w tym celu wzór na energię potencjalną sprężystości<br>
                <p style="text-align: center;">E = &frac12;kx<sup>2</sup></p>
                Gdzie k to współczynnik sprężystości, a x to odkształcenie.
                <br>Po podstawieniu tych wzorów (oraz wzorów z poprzedniej sekcji) do wzoru na całkowitą energię otrzymamy:
                <p style="text-align: center;">E<sub>całkowita</sub> = &frac12;kA<sup>2</sup>cos<sup>2</sup>(ωt+ϕ) + &frac12;mA<sup>2</sup>ω<sup>2</sup>sin<sup>2</sup>(ωt+ϕ)
                <br>=&frac12;kA<sup>2</sup>cos<sup>2</sup>(ωt+ϕ) + &frac12;mA<sup>2</sup> k&frasl;m sin<sup>2</sup>(ωt+ϕ)
                <br>=&frac12;kA<sup>2</sup>cos<sup>2</sup>(ωt+ϕ) + &frac12;kA<sup>2</sup>sin<sup>2</sup>(ωt+ϕ)
                <br>=&frac12;kA<sup>2</sup>(cos<sup>2</sup>(ωt+ϕ) + sin<sup>2</sup>(ωt+ϕ))
                <br>=&frac12;kA<sup>2</sup>
            </p>
            Można zauważyć, że energia kinetyczna zmienia się jak funkcja sinus do kwadratu, natomiast energia potencjalna zmienia się jak funkcja cosinus do kwadratu.
            Energia całkowita jest oczywiście stała i zwiększa się wraz ze zwiększaniem się amplitudy drgań.
            <figure>
            <img src="wykresjpg.jpg" alt="Wykres" style="width:100%">
            <figcaption>Ilustracja 1 - Wykres energii kinetycznej, energii potencjalnej sprężystości i energii całkowitej układu w ruchu harmonicznym.</figcaption>
            </figure>
            </div>
        </article>
        <br>
        <article id="wahadlo">
            <div class="chapter">
                <br>
                <h2>Wahadło matematyczne</h2>
                Wahadło matematyczne to idealizowany model fizyczny wahadła, który jest często używany do analizy ruchu drgającego. 
                Jest to punktowe ciało o masie <i>m</i>, zawieszone na nieważkiej i nierozciągliwej nici o długości 
                <i>L</i>. Wahadło matematyczne jest jednym z najbardziej podstawowych przykładów ruchu harmonicznego.
                <br>Dla małych kątów okres drgań wahadła matematycznego zależy więc wyłącznie od jego długości i przyspieszenia grawitacyjnego. 
                Nie mają na niego wpływu ani masa ciężarka, ani amplituda maksymalnego kąta.
                Okres drgań wyraża się wzorem:
                <p style="text-align: center;">T = 2&pi;&radic;l/g</p>
                Poniżej możesz zapoznać się z symulacją wahadła matematycznego dla większych kątów - brana pod uwagę jest masa oraz można włączyć opory powietrza,
                w celu zaobserowania tłumionych drgań.
            </div>
        </article>
        <br>
    
        <div id="animacja">
            <canvas id="canvas" width="600" height="500"></canvas>
            <div id="animacjaInfo">
                <div id="massInfo">
                    <p>Masa</p>
                    <input type="range" min="1" max="100" value="50" class="slider" id="mass">
                    <p><span id="massVal"></span></p>
                    <br>
                </div>
                <div id="lenInfo">
                    <p>Długość</p>
                    <input type="range" min="50" max="250" value="150" class="slider" id="lenght">
                    <p><span id="lenVal"></span></p>
                    <br>
                </div>
                <div id="gravityInfo">
                    <p>Stała grawitacji</p>
                    <input type="range" step="0.01" min="5" max="15" value="10" class="slider" id="gravity">
                    <p><span id="gravityVal"></span></p>
                </div>
                <div id="dampingInfo">
                    Opory powietrza
                    <input type="checkbox" id="dampingCheck">
                </div>
                <div>
                    <?php
                    if (isset($_SESSION["auth"])) {
                        echo "<button onclick=" . "loadParams(" . $mass . "," . $len . "," . $gravity . ") " . "id=" . "loadParams" . ">Załaduj moje dane</button><br>";
                    } ?>
                </div>
            </div>
        </div>
    </div>
    <footer>Aleksandra Michalska 2024</footer>
    <script src="drawingscript.js"></script>
</body>

</html>