<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <form id="file_form" enctype="multipart/form-data">
        <label for="">Image</label>
        <input type="file" name="path" id="path">
        <input type="submit" name="Upload">
    </form>


    <script>
        let form = document.querySelector("#file_form");
        form.addEventListener("submit", function(e) {
            e.preventDefault();


            let data = new FormData();
            data.append("path", this.querySelector('input[type="file"]').files[0]);
            fetch("http://localhost:81/task26/templatemo_551_stand_blog/test.php", {
                    method: 'POST',
                    body: data
                }).then(res => res.json())
                .then(result => {
                    console.log(result);
                });


        })
    </script>
</body>

</html>