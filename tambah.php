
<?php

include_once 'ConnectDB.php';

if(isset($_POST['simpan'])) {

        $image      = $_FILES['image']['name'];
        $audio      = $_FILES['audio']['name'];
        $video      = $_FILES['video']['name'];

        $lokasi_image = 'file/'.$image;
        $lokasi_audio  = 'file/'.$audio;
        $lokasi_video  = 'file/'.$video;

        if(move_uploaded_file($_FILES['image']['tmp_name'], $lokasi_image)){
            if(move_uploaded_file($_FILES['audio']['tmp_name'], $lokasi_audio)){
                if(move_uploaded_file($_FILES['video']['tmp_name'], $lokasi_video)){
                    $sql = "INSERT INTO files (image, audio, video)
                            VALUES ('$image', '$audio', '$video')";

                    if($connect->query($sql)) {
                        header('Location: index.php');
                    } else {
                        echo 'gagal';
                    }
                } else {
                    echo 'gagal video';
                }
            } else {
                echo 'gagal audio';
            }
        } else {
            echo 'gagal gambar';
        }
    }

?>



<form action="" method="post" enctype="multipart/form-data">
    <table align="center">

        <tr>
            <td>Pilih Gambar : <input type="file" name="image"></td>
            <td>Pilih Audio  : <input type="file" name="audio"></td>
            <td>Pilih Video  : <input type="file" name="video"></td>
        </tr>
        <tr>
            <td><br></td>
        </tr>
        <tr align="center">
            <td colspan="3"><input type="submit" value="Upload" name="simpan"></td>
        </tr>

    </table>
</form>
