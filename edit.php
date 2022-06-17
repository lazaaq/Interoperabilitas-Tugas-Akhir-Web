<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Data Penghuni</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <style>
        body {
            display: flex;
            align-items: center;
            flex-direction: column;
            padding: 0 0 20px 0;
            background-image: url('assets/image/bg.jpg');
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
            background-size: cover;
        }
        .bg-backdrop {
            display: flex;
            justify-content: center;
        }
        h1 {
            margin: 20px;
        }
        .pilih {
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
        }
        .edit-card {
            box-shadow:
                0 2.8px 2.2px rgba(0, 0, 0, 0.034),
                0 6.7px 5.3px rgba(0, 0, 0, 0.048),
                0 12.5px 10px rgba(0, 0, 0, 0.06),
                0 22.3px 17.9px rgba(0, 0, 0, 0.072),
                0 41.8px 33.4px rgba(0, 0, 0, 0.086),
                0 100px 80px rgba(0, 0, 0, 0.12)
        }
        .title {
            padding: 15px 25px 15px 25px;
            margin-top: 20px;
            margin-bottom: 20px;
            background-color: white;
            text-align: center;
            border-radius: 50px;
            box-shadow:
                0 2.8px 2.2px rgba(0, 0, 0, 0.034),
                0 6.7px 5.3px rgba(0, 0, 0, 0.048),
                0 12.5px 10px rgba(0, 0, 0, 0.06),
                0 22.3px 17.9px rgba(0, 0, 0, 0.072),
                0 41.8px 33.4px rgba(0, 0, 0, 0.086),
                0 100px 80px rgba(0, 0, 0, 0.12)
        }
    </style>
</head>
<body>
    <div class="container w-25 title">
        <h3>Ubah Data Penghuni</h3>
    </div>
    <div class="container-sm bg-backdrop">
        <div class="card w-50 edit-card">
            <div class="card-header pilih">
                <h6>Pilih Penghuni : </h6>
                <select name="penghuni" id="penghuni" onchange="changePreview(this);" style="margin-left: 10px;" class="form-select">
                    <option value="-">-</option>t
                    <?php
                        include 'curl.php';

                        // $penghuni = get_method('https://mykostapp.000webhostapp.com/penghuni.php');
                        $penghuni = get_method('http://192.168.56.69/disa-api/penghuni.php');

                        foreach ($penghuni['data'] as $individu) {
                            echo "
                            <option data-value='{\"id\":\"".$individu['id']."\",\"nama\":\"".$individu['nama']."\",\"asal\":\"".$individu['asal']."\",\"kampus\":\"".$individu['kampus']."\",\"no_hp\":\"".$individu['no_hp']."\",\"kamar\":\"".$individu['kamar']."\"}'>".$individu['nama']." di Kamar = ".$individu['kamar']."</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="card-body">
                <form action="modify.php" method="post" id="formInput">
                    <div class="mb-3">
                        <label for="id" class="form-label">ID</label>
                        <input id="id" type="text" class="form-control" name="id" aria-describedby="nameInfo" placeholder="ID Penghuni saat ini" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input id="name" type="text" class="form-control" name="name" aria-describedby="nameInfo" placeholder="Masukkan nama lengkap penghuni">
                    </div>
                    <div class="mb-3">
                        <label for="city" class="form-label">Asal</label>
                        <input type="text" class="form-control" name="city" id="city" aria-describedby="cityInfo" placeholder="Masukkan asal daerah penghuni">
                    </div>
                    <div class="mb-3">
                        <label for="campus" class="form-label">Kampus</label>
                        <input type="text" class="form-control" name="campus" id="campus" aria-describedby="campusInfo" placeholder="Masukkan dimana penghuni berkuliah">
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">No HP</label>
                        <input type="text" class="form-control" name="phone" id="phone" aria-describedby="phoneInfo" placeholder="Masukkan no HP penghuni yang aktif">
                    </div>
                    <div class="mb-3">
                        <label for="room" class="form-label">Kamar</label>
                        <select class="form-select" aria-label="Room Select" name="room" id="room">
                            <option id="currentData">-</option>
                                <?php
                                    if ( mysqli_num_rows($penghuni) == 0 ) {
                                        for( $i = 1; $i <= 20 ;$i++) echo "<option value=\"".$i."\">".$i."</option>";
                                    } else {
                                        $id = array();
                                        foreach ($penghuni as $value) {
                                            array_push($id,$value['kamar']);
                                        }
                                        for( $j = 1; $j <= 20; $j++ ) {
                                            if ( in_array($j, $id) ) continue;
                                            else echo "<option value=\"".$j."\">".$j."</option>";
                                        }
                                    }
                                ?>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <a type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" href="index.php">Kembali</a>
                        <button type="submit" name="submit" class="btn btn-primary">Ubah Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function changePreview(event) {
            const penghuni = document.getElementById('penghuni');
            let selectedPenghuni = event.selectedOptions[0].getAttribute('data-value');
            let penghuniObj = JSON.parse(selectedPenghuni);
            
            let inputID = document.getElementById('id');
            let inputName = document.getElementById('name');
            let inputAsal = document.getElementById('city');
            let inputKampus = document.getElementById('campus');
            let inputNoHP = document.getElementById('phone');
            let inputKamar = document.getElementById('room');
            let inputForm = document.getElementById('formInput');

            inputID.value = penghuniObj["id"];
            inputName.value = penghuniObj["nama"];
            inputAsal.value = penghuniObj["asal"];
            inputKampus.value = penghuniObj["kampus"];
            inputNoHP.value = penghuniObj["no_hp"];
            

            let selectValueList = [...inputKamar.options].map(opt => opt.value);

            if ( selectValueList.includes(penghuniObj["kamar"]) == false ) {
                let room = document.createElement('option');
                room.setAttribute("value",penghuniObj["kamar"]);
                room.innerHTML = penghuniObj["kamar"];
                inputKamar.appendChild(room);
            }
            inputKamar.value = penghuniObj["kamar"];
            // inputForm.setAttribute('action',`http://192.168.56.45/final-project/api/penghuni.php?id=${penghuniObj["id"]}`);
        
            // console.log(selectValueList);
            // inputKamar.appendChild(room);
            // inputKamar.value = penghuniObj["kamar"];
        }
    </script>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->
</body>
</html>