<?php
    $data = ["nama"=>null, "nilai"=>null, "hasil"=>null];
    $error = ["nama"=> null, "nilai"=> null];

    $data["nama"] = $_POST ? $_POST["nama"] : null;
    $data["nilai"] = $_POST ? $_POST["nilai"] : null;

    if($_POST){
        $error = validate($data, $error);
        if($error["nama"] == null && $error["nilai"] == null){
            $data["hasil"] = process($data["nilai"]);
        }
    }

    function validate($data, $error){
        if(!$data["nama"]){
            $error["nama"] = "nama harus diisi";
        } else if(!preg_match("/^[a-zA-Z ]*$/",$data["nama"])){
            $error["nama"] = "nama harus berupa huruf";
        }
        if(!$data["nilai"]){
            $error["nilai"] = "nilai harus diisi";
        } else if(!is_numeric($data["nilai"])){
            $error["nilai"] = "nilai harus berupa angka";
        } else if ($data["nilai"] < 0 || $data["nilai"] > 100){
            $error["nilai"] = "nilai harus antara 0 sampai 100";
        }
        return $error;
    }

    function process($nilai){
        if ($nilai <= 40) {
            $hasil = "E";
        } else if($nilai <= 55 ){
            $hasil = "D";
        }else if($nilai <= 60 ){
            $hasil = "C";
        } else if($nilai <= 65 ){
            $hasil = "BC";
        }else if($nilai <= 70 ){
            $hasil = "B";
        }else if($nilai <= 80 ){
            $hasil = "AB";
        } else {
            $hasil = "A";
        }
        return $hasil;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
     integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Nilai angka to huruf</title>
</head>
<body style="display: flex; align-items: center; justify-content: center; width: 100vw; height: 100vh; background: url('https://www.toptal.com/designers/subtlepatterns/uploads/double-bubble-outline.png');">
    <div class="card shadow" style="width: 26rem; padding-top: 1rem; padding-bottom: 1rem">
        <div class="card-body">
            <form method="post">
                <h4 class="text-center mt-4 mb-5">Nilai angka to Huruf</h4>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Nama</label>
                    <input type="text" name="nama" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" <?php echo $_POST && $error["nama"] ? "style='border-color: red'" : "";?> value="<?php echo $data["nama"] ?: ""?>" >
                    <?php echo $_POST && $error["nama"] ? "<div id='emailHelp' class='form-text' style='color: red'>" . $error["nama"] . "</div>" : "";?>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Nilai</label>
                    <input type="text" name="nilai" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" <?php echo $_POST && $error["nilai"] ? "style='border-color: red'" : "";?> value="<?php echo $data["nilai"] ?: ""?>">
                    <?php echo $_POST && $error["nilai"] ? "<div id='emailHelp' class='form-text' style='color: red'>" . $error["nilai"] . "</div>" : "";?>
                </div>
                <button class="btn btn-primary mt-3" style="width: 100%;  margin-top: 2rem" type="submit">submit</button>
            </form>
        </div>
    </div>
    <?php echo $data["hasil"] ?
    '<div class="background-blur" style="backdrop-filter: brightness(60%); width: 100vw; height: 100vh; position: fixed"></div>
    <div class="modal d-block" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Hasil konversi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Selamat '. $data["nama"] .' anda mendapat predikat '. $data["hasil"] .'</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="modal()">Close</button>
                </div>
            </div>
        </div>
    </div>' : "";?>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script>
        function modal(){
            document.querySelector(".modal").classList.toggle("d-block");
            document.querySelector(".background-blur").classList.toggle("d-none")
        }
    </script>
</body>
</html>
