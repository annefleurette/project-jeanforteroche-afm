<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, user-scalable=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Concert+One|Lato:300,400,700|Pacifico&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="public/css/style.css" />
        <title><?php $head_title ?></title>
        <script src='https://cdn.tiny.cloud/1/rusvh5uity3vzz9zncbvyfu2ngucer16rijxcr2fhxwkn4mb/tinymce/5/tinymce.min.js' referrerpolicy="origin"></script>
        <script src="https://kit.fontawesome.com/3492d8c303.js" crossorigin="anonymous"></script>
        <script>
            tinymce.init({
            selector: '#content',
            content_css : 'public/css/style.css',
            inline_styles : false,
            plugins: "autoresize",
            autoresize_overflow_padding: 15,
            autoresize_bottom_margin: 15,
            min_height: 500,
            convert_fonts_to_spans : false,
            invalid_elements: "span, p, a",
            forced_root_block : false,
            force_br_newlines : true,
            force_p_newlines : false
            });
        </script>
    </head>
    <body>
        <div class="container-fluid p-0">
        <?php require("./src/View/header.php");?>
           <?php echo $body_content; ?>
        <?php require("./src/View/footer.php");?>
        </div>
    	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
  </html>