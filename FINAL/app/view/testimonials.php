<header id="header">
    <div class="section-title">
        <h1>Témoignages</h1>
    </div>
</header>

<div id="main-content" class="section-content">
    <div class="container">
        <div class="row">
            <?php
                if (Testimony::getTestimonialsList()) :
                    foreach(Testimony::getTestimonialsList() as $testimony) {
            ?>
            <div class="col-md-4 col-sm-6">
                <div class="testimonial-case">
                    <p><?php echo $testimony->description; ?></p>
                    <footer>
                        <cite><?php echo $testimony->author; ?></cite>
                        <?php echo $testimony->register_date; ?>
                    </footer>
                </div>
            </div>
            <?php
                    }
                else:
                    '<div class="col-md-12">Aucun témoignage n\'a encore été écrit.</div>';
                endif;
            ?>
        </div>

        <?php
            if (App::isLogged()) {
                echo '
                    <div class="row">
                        <div class="add-button col-md-12">
                ';
                
                if (App::isStudent()) {
                    echo '<a href="index.php?page=create-testimony&amp;type=student" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Ajouter un témoignage</a>';
                }

                if (App::isCompany()) {
                    echo '<a href="index.php?page=create-testimony&amp;type=company" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Ajouter un témoignage</a>';
                }

                echo '
                    </div>
                        </div>
                ';
            }
        ?>
    </div>
</div>