
<div class ="centrage" >
    <div id="slogan">
        <p>Le bureau d'archictecture <span>Crearchitech</span> allie création et techniques.<br />
            Construction, rénovation et design intérieur.</p>
    </div>

    <div class="slider-wrapper theme-dark">

        <div id="slider" class="nivoSlider">

            <?php
                if (is_array($result_slider) && !empty($result_slider))
                {
                    foreach ($result_slider as $res_sl)
                    {
                        $denomination = convertFromDB($res_sl["denomination"]);
                        $photo        = convertFromDB($res_sl["photo"]);
                        $is_visible   = convertFromDB($res_sl["is_visible"]);
                        if ($is_visible == 1)
                        {
                            ?>
                            <img src="upload/slider/<?php echo($photo); ?>" alt="<?php echo($denomination); ?>"/>
                            <?php
                        }
                        else
                        {
                            echo("Transaction from DATABASE in failure !");
                        }
                    }
                }
            ?>
        </div>
    </div>

    <div class="devide">
        <img src="img/divider_bg.png" alt="devide"/>
    </div>
    <!--
    <section  id="idtex">

        <article class="texcadre marging">
            <div class="num">1</div>

            <div>
                <h2>construction</h2>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras molestie leo nisi, eu gravida erat dictum at. Nunc a neque lacinia, cursus neque a, porta quam. Cras id eleifend dolor. Fusce nibh dui, euismod in ultrices eget, sagittis non lacus. Cras auctor quam ut sagittis ullamcorper.                   </p>
            </div>

        </article>
        <article class="texcadre marging">
            <div class="ncl num">2</div>
            <div>
                <h2>rénovation</h2>
                <p>
                    Pellentesque dignissim iaculis enim et dapibus. Sed lacinia laoreet lectus eu sagittis. Sed egestas ac lectus ut facilisis. Nullam commodo dictum tortor a imperdiet. Praesent euismod orci et lorem facilisis, vitae mattis dolor pellentesque. Integer a mi nisl.
                </p>
            </div>

        </article>
        <article class="texcadre marging">
            <div class="ncl num">3</div>
            <div>
                <h2>intérieur</h2>
                <p>
                    Donec at placerat diam. Mauris sagittis ante orci, sit amet blandit nulla iaculis a. Curabitur ullamcorper tincidunt nibh, et aliquam purus scelerisque ac. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. In porttitor id ex quis consequat.
                </p>
            </div>

        </article>
-->
        <?php
           if (is_array($result_categorie) && !empty($result_categorie))
            {
                foreach ($result_categorie as $c)
                {
                    $categorie             = convertFromDB($c["categorie"]);
                    $description_categorie = convertFromDB($c["description"]);
                    $categorie_id          = convertFromDB($c["projet_categorie_id"]);
                    $is_visible            = convertFromDB($c["is_visible"]);
                    if ($is_visible == 1)
                    {
                        ?>
                        <article class="texcadre marging">
                            <div class="ncl num"><?php echo($categorie_id); ?></div>
                            <h3><?php echo($categorie); ?></h3>
                            <p class="color_grey"><?php echo($description_categorie); ?></p>
                        </article>
                        <?php
                    }
                    else
                    {
                        echo("Transaction from DATABASE in failure !");
                    }
                }
            }
        ?>
    </section>
</div>

<!--  ****************** -->
<!--  Nos travaux        -->
<!--  ****************** -->

<div class="centrage" id="travxline">
    <div class="travx">
        <h3>Travaux récents</h3>
    </div>
    <div class="trd">
    <!--    <img src="img/divider_bg.png" alt=""/>   -->
    </div>

</div>
<!--
<div  class="centrage" id="imago">

    <div class="activ amr">
        <img src="img/big-our-8.jpg" alt="Pré Maho" width="295" height="200"/>
        <h4><a href="#">pré maho</a></h4>
        <span></span>
        <p>Mars 2014<br />Projet Lafabrique du Pré-maho</p>
    </div>

    <div class="activ amr">

        <img src="img/big-our-2.jpg" alt="Design Intérieur" width="295" height="200"/>
        <h4><a href="#">design intérieur</a></h4>
        <span></span>
        <p>Février 2014<br />Refonte d'une cuisine</p>
    </div>


    <div class="activ">
        <img src="img/big-our-4.jpg" alt="Home design" width="295" height="200"/>
        <h4><a href="#">architecture design</a></h4>
        <span></span>
        <p>Janvier 2014<br />Home Design, la rénovation intelligente </p>
    </div>

</div> -->

<?php
    if (is_array($result_projet) && !empty($result_projet))
    {
        ?>
        <div  class="centrage" id="imago">

            <?php
            foreach ($result_projet as $p)
            {
                $titre_projet       = convertFromDB($p["titre"]);
                $description_projet = convertFromDB($p["description"]);
                $date_projet        = convertDate2FR($p["date_projet"]);
                $photo_projet       = convertFromDB($p["photo"]);
                $is_visible         = convertFromDB($p["is_visible"]);

                if ($is_visible == 1)
                {
                    ?>
                    <article class="activ amr">
                        <div>
                            <img src="upload/projet/<?php echo($photo_projet); ?>"/>
                        </div>
                        <h4><a href="#"><?php echo($titre_projet); ?></a></h4>
                        <p class="color_grey"><?php echo($date_projet); ?><br /><?php echo($description_projet); ?></p>
                    </article>
                    <?php
                }
                else
                {
                    echo("");
                }
            }
            ?>
        </div>
        <?php
    }
?>
<!--  ****************** -->
<!--  Footer & Copyright -->
<!--  ****************** -->

<!--  <footer>
 /*      the footer and }); the copyright banner have been extracted from here and set into the "\inc" folder */
      </footer> -->
<?php
    include_once('../inc/footer.php');
?>
</body>
</html>
