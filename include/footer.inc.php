    <footer id="footer" <?php if(isset($stick)){echo "class=\"stick\"";}?>>
        <p>Auteurs : Maxime Grodet &amp; Antoine Qiu</p>
        <p><a class="credits" href="credits.php">Crédits</a></p>
        <p>Version du 29/04/2021</p>
<?php
if($current == 2){
    if(isset($_GET["search"]) && !empty($_GET["search"])){
        echo "\t\t<a class=\"up button\" href=\"#header\">UP</a>\n";
    }
}
else{
    echo "\t\t<a class=\"up button\" href=\"#header\">UP</a>\n";
}
?>
    </footer>
</body>
</html>