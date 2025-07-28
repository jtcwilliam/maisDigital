<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload with jQuery</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <form id="fileUploadForm">
        <input type="file" id="fileInput" name="file" />
        <button type="button" id="uploadButton" onclick="subirArquivo('file','fileInput')">Upload</button>

    </form>

    <script>
        //$(document).ready(function () {
        //  $('#uploadButton').on('click', function () {

        function subirArquivo(arquivo, id) {
            var formData = new FormData();
            var file = $(`#${id}`)[0].files[0];

            if (file) {
                formData.append('file', file);

                $.ajax({
                    url: 'ajax/arquivosController.php', // Replace with your server endpoint
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'html',
                    success: function(response) {
                        console.log(response);


                        $(`#${id}`).attr('disabled', 'disabled');

                        // console.log(response);
                        // alert('File uploaded successfully!');
                    },
                    error: function(error) {
                        alert('Error uploading file.');
                    }
                });
            } else {
                alert('Please select a file to upload.');
            }
        }


        //});
        //});
    </script>
</body>

</html>