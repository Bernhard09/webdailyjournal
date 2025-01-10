<h4 class="lead display-6 pb-2 border-bottom border-danger-subtle"><?= ucfirst($_GET["page"])?></h4>

<div class="container mt-4">
    <form method="post" action="" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="formGroupExampleInput" class="form-label">Username</label>
            <input type="hidden" name="id" value="<?= $_SESSION["id"] ?>">
            <input type="text" class="form-control" name="username" placeholder="<?= $_SESSION['username']?>">
        </div>
        <div class="mb-3">
            <label for="floatingTextInput">Password</label>
            <input type="text" class="form-control" placeholder="Tuliskan password" name="password"></input>
        </div>
        <div class="mb-3">
            <label for="formGroupExampleInput2" class="form-label">Foto</label>
            <input type="file" class="form-control" name="foto">
        </div>
        <div class="mb-3">
            <?php
            $data = null;
            if (isset($_SESSION['id'])) {
                $id = $_SESSION['id'];
                $sql = "SELECT foto FROM user WHERE id = $id";
                $hasil = $conn->query($sql);
                
                $data = $hasil->fetch_assoc();
            }
            
            ?>
            <?php
            if($data['foto']){
            ?>    
                <img src="img/<?= $data["foto"] ?>" width="300" class="img-thumbnail">;
            <?php
            } else {
                echo '<img src="img/image_not_available.png" width="300" class="img-thumbnail">';
            }
            ?>
            <input type="hidden" name="foto_lama" value="<?= $data["foto"] ?>">
            </div>
        <input type="submit" value="simpan" name="simpan" class="btn btn-primary">
    </form>
</div>

<?php
include "upload_foto.php";

//jika tombol simpan diklik
if (isset($_POST['simpan'])) {
    $new_username = $_POST['username'];
    $password = md5($_POST['password']);
    $username = $_SESSION['username'];
    $foto = '';
    $nama_foto = $_FILES['foto']['name'];
    
    //jika ada file yang dikirim  
    if ($nama_foto != '') {
		    //panggil function upload_foto untuk cek spesifikasi file yg dikirimkan user
		    //function ini memiliki 2 keluaran yaitu status dan message
        $cek_upload = upload_foto($_FILES["foto"]);

				//cek status true/false
        if ($cek_upload['status']) {
		        //jika true maka message berisi nama file foto
            $foto = $cek_upload['message'];
        } else {
		        //jika true maka message berisi pesan error, tampilkan dalam alert
            echo "<script>
                alert('" . $cek_upload['message'] . "');
                document.location='admin.php?page=profile';
            </script>";
            die;
        }
    }

	//cek apakah ada id yang dikirimkan dari form
    if (isset($_POST['id'])) {
        //jika ada id,    lakukan update data dengan id tersebut
        $id = $_POST['id'];

        if ($nama_foto == '') {
            //jika tidak ganti foto
            $foto = $_POST['foto_lama'];
        } else if($_POST['foto_lama'] != '') {
            //jika ganti foto, hapus foto lama
            unlink("img/" . $_POST['foto_lama']);
        } 

        $stmt = $conn->prepare("UPDATE user 
                                SET 
                                username =?,
                                password =?,
                                foto = ?
                                WHERE id = ?");

        $stmt->bind_param("sssi", $new_username, $password, $foto, $id);
        $simpan = $stmt->execute();
    }

    if ($simpan) {
        echo "<script>
            alert('Simpan data sukses');
            document.location='admin.php?page=profile';
        </script>";
    } else {
        echo "<script>
            alert('Simpan data gagal');
            document.location='admin.php?page=profile';
        </script>";
    }

    $stmt->close();
    $conn->close();
}
?>