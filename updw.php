<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <title>UPDW</title>

    <style>

        html, body
        {
            padding: 0;
            margin: 0;

        }
        main
        {
            padding: 20px 50px;
            display: flex;
            margin: 0 auto;
            justify-content: center;
            flex-wrap: wrap;
            /* margin-top: 200px; */
            max-width: 1400px;

        }

        section 
        {
            /* border: 2px solid #dcdcdc; */
            height: 600px;
            width: 100%;
            position: relative;
            border-bottom: 2px solid #dcdcdc;
        }
        #btn
        {
            position: absolute;
            bottom: 10%;
            left: 50%;
            transform: translate(-50%, -50%);

        }
        #lnk
        {
            position: absolute;
            bottom: 10%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        .fa-download
        {
            font-size: 32px;
            padding-top: 10px;
            color: #929191;
        }
        .content-preview-per 
        {
            /* position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%); */
            margin-top: 75px;
            position: relative;
            width: 100%;
            height: 300px;
            
        }
        .content-preview-per output
        {
            display:flex;
            justify-content:space-between;
            position: relative;
            height: 100%;
            width: 100%;
            overflow: auto;
            padding: 10px;



        }

        .content-preview-per img.thumbnail
        {
            max-width: 300px;
            height: 90%;
            background-size:cover;
            box-shadow: 0 0 14px 4px #cacaca;
            border-radius: 7px;

        }




    
    </style>
</head>
<body>


    <main role="main">
                    <!-- Upload -->
                <section> 

                <form method="POST" enctype="multipart/form-data">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="fileUpload" id="customFile" multiple="multiple">
                    <label class="custom-file-label" for="customFile">Escolher arquivo</label>
                </div>
                <button id="btn" type="submit" class="btn btn-light">Enviar</button>

                    
                    
                </form>

                <?php
                if ($_SERVER["REQUEST_METHOD"] === "POST")
                {
                    $file = $_FILES["fileUpload"];

                    if ($file["error"])
                    {
                        throw new Exception("Error: ".$file["error"]);
                        
                    }

                    $dirUploads = "uploads";
                    if (!is_dir($dirUploads))
                    {
                        mkdir($dirUploads);
                    }

                    $nameFileExt = $file["name"];

                    if ( move_uploaded_file($file["tmp_name"], $dirUploads . DIRECTORY_SEPARATOR . $file["name"]) )
                    {   
                        echo "<i>Upload realizado com sucesso: ".$dirUploads.DIRECTORY_SEPARATOR.$file["name"]."</i>";
                    } else 
                    {
                        throw new Exception("Error, nao foi possivel");
                        
                    }
                } 


                ?>
                <div class="content-preview-per">
                    <output id="result">
                </div>
                </section>

                

                <hr />
                 <!-- Download -->
                <section>

                <b><i class="fas fa-download"></i> </b><a id="lnk" class="btn btn-primary" href="#" role="button">Link</a>
                
                </section>

                

    </main>



<script>






function handleFileSelect() {
    //Check File API support
    if (window.File && window.FileList && window.FileReader) {

        var files = event.target.files; //FileList object
        var output = document.getElementById("result");

        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            //Only pics
            if (!file.type.match('image')) {
	        
		        var div = document.createElement("div");
                output.insertBefore(div, null);

                div.innerHTML =  '<object type="image/svg+xml" data="icons/text-enriched.svg" class="logo"></object>';
                div.innerHTML += '<small>' + file.name +  '</small>';
                break;

            }

            var picReader = new FileReader();
            picReader.addEventListener("load", function (event) {
                var picFile = event.target;
                var div = document.createElement("div");
                div.innerHTML = "<img class='thumbnail' src='" + picFile.result + "'" + "title='" + picFile.name + "'/>";
                output.insertBefore(div, null);
            });
            //Read the image
            picReader.readAsDataURL(file);
        }
    } else {
        console.log("Your browser does not support File API");
    }
}

document.getElementById('customFile').addEventListener('change', handleFileSelect, false);


</script>

</body>
</html>