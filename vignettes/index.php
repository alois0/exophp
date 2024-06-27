<?php  include '../config.php'; ?>
<?php  include '../header.php'; ?>


<?php

function update_img($NomVignette_tmp, $NomVignette)
{
    $destination = 'vignettes/' . $NomVignette;

    if (move_uploaded_file($NomVignette_tmp, $destination)) {
        $image_info = pathinfo($destination);
        $image_extension = strtolower($image_info['extension']);

        switch ($image_extension) {
            case 'png':
                $image = imagecreatefrompng($destination);
                break;
            case 'jpg':
            case 'jpeg':
                $image = imagecreatefromjpeg($destination);
                break;
            default:
                echo "Unsupported image format.";
                return;
        }

        $new_image_path = 'vignettes/' . $image_info['filename'] . '.jpg';
        imagejpeg($image, $new_image_path, 70);
        imagedestroy($image);

        if ($image_extension != 'jpg' && $image_extension != 'jpeg') {
            unlink($destination);
        }
    } else {
        echo "Failed to move uploaded file.";
    }
}

if (isset($_POST['upload'])) {
    $NomVignette = $_FILES['NomVignette']['name'];
    $NomVignette_tmp = $_FILES['NomVignette']['tmp_name'];

    if (!empty($NomVignette)) {
        $NomVignette_parts = explode('.', $NomVignette);
        $NomVignette_ext = end($NomVignette_parts);
        if (in_array(strtolower($NomVignette_ext), array('png', 'jpg', 'jpeg'))) {
            update_img($NomVignette_tmp, $NomVignette);
            echo "<h2>Image upload ^_^ Yopii</h2>";
        } else {
            echo "Error: Unsupported file format.";
        }
    }
}
?>



    <div class="general-content">
    <h1>Les vignettes</h1>
    <h2>Explications sur l'exercice</h2>
    <p>Vous devez faire le script pour que les vignettes soient enregistrées dans le répertoires "vignettes", les vignettes dans ce répertoire doivent être visibles sur cette page. La vignette doit avoir le même nom que le fichier original. Pour info, le format pour l'image envoyée par le formulaire est un .png, il vous faudra donc convertir d'une manière ou d'une autre l'image téléchargée pour que l'image finale soit au format .jpg
    </p>
    <h2>Faire une vignette</h2>
    <div>
        <div class="image-uploader">
            <form action="/vignettes/"  method="post" enctype="multipart/form-data">
                <div class="image-editor">
                    <input type="file" class="cropit-image-input btn btn-default btn-lg" name="NomVignette">
                    <div class="cropit-preview"></div>
                    <div class="image-size-label">
                        Redimensionner l'image
                    </div>
                    <input type="range" class="cropit-image-zoom-input">
                    <input type="hidden" name="image-data" class="hidden-image-data" />
                    <button type="submit" name="upload" class="btn btn-default btn-lg">Enregistrer la vignette</button>
                </div>
            </form>
        </div>
    </div>
    <h2>Vignettes disponibles</h2>

    <!-- début gallerie image -->
    <?php
    $allimg = array_diff(scandir('vignettes'), array('..', '.'));
    foreach($allimg as $img) {
        if (in_array(pathinfo($img, PATHINFO_EXTENSION), array('jpg', 'jpeg', 'png'))) {
            ?>
            <img src="vignettes/<?php echo $img?>" class="vignettes"/>
            <?php
        }
    }
    ?>
    <!-- Fin gallerie image -->


    <script>
        $(document).ready(function() {
            $('.menu-link').menuFullpage();
        });
    </script>
    <script>
        $(function() {
            $('.image-editor').cropit();

            $('form').submit(function() {
                var imageData = $('.image-editor').cropit('export');
                $('.hidden-image-data').val(imageData);

                return true;
            });
        });
    </script>
<?php  include '../footer.php'; ?>