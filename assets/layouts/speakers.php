<?php
include("../../php/config.php");
$query = "SELECT * FROM `ponentes`";
$resultado = $cnt->prepare($query);
$resultado->execute();
while ($speaker = $resultado->fetch(PDO::FETCH_ASSOC)) {
    $speakers[] = $speaker;
}
$count = 0; ?>
<section class="container my-4">
    <h2 class="py-5"> Participants</h2>
    <div class="row row-cols-1 row-cols-md-4 g-4">
        <?php foreach ($speakers as $speaker) : ?>

        <div class="col mb-4 wow fadeInUp" data-wow-delay="<?php echo $count . "s" ?>">
            <div class="card h-100 border-0">
                <img src="https://<?php echo $_SERVER['HTTP_HOST'] ?>/assets/images/ponentes/<?php echo $speaker['IMG'] ?>"
                    class="card-img-top" style='filter: grayscale(100%);'
                    alt="<?php echo $speaker['NAME'] . " " . $speaker['LASTNAME'] ?>">
                <div class="card-body bg-light" style="border-bottom: 2px solid #002776">
                    <h5 class="card-title" style="font-size:16px;color:#002776">
                        <?php echo $speaker['NAME'] . " " . $speaker['LASTNAME'] ?></h5>
                    <p class="card-text" style="line-height:normal;font-size:14px"><?php echo $speaker['CHARGE'] ?></p>
                </div>
            </div>
        </div>

        <?php if ($count < 0.6) : $count = $count + 0.2;
            else : $count = 0;
            endif;
        endforeach; ?>
    </div>
</section>