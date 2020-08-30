<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ajax File Upload</title>
    <script src="/js/jquery.js"></script>
</head>
<body>
<form action="" id="createForm" method="post" enctype="multipart/form-data">
    @csrf
    <input type="text" name="title" id="title" required="">
    <br><br>
    <textarea name="body" id="body" cols="30" required rows="10"></textarea>
    <br><br>
    <input type="file" name="file" >
    <br>
    <br>
    <input type="submit" value="ارسال مقاله">
</form>

<script type="text/javascript">
    $(document).ready(function () {
        $("#createForm").on('submit', function (e) {
            e.preventDefault();
            var frm = new FormData(this);
            frm.append('title', $("#title").val());
            frm.append('body', $("#body").val());
            $.ajax({
                url: "{{ route('upload.ajax') }}",
                data: frm,
                type: "post",
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    console.log(data);
                    if(data.success==1)
                        alert('مقاله با موفقیت اپلود شد!');
                    else
                        alert(data.errors);
                }
            })
        })
    })
</script>
</body>
</html>
