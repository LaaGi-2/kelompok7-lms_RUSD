<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Your Name : <?= $_POST["nama_dokter"]; ?></h1>
    <p>NIP : <?= $_POST["nip"]; ?></p>
    <p>spesialisasi : <?= $_POST["spesialisasi"]; ?></p>
    <p>Almamater : <?= $_POST["almamater"]; ?></p>
    <p>email : <?= $_POST["email"]; ?></p>
    <p>NO STR : <?= $_POST["no_str"]; ?></p>
</body>
</html>