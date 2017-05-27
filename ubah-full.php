
<?php

include_once 'ConnectDB.php';

if(isset($_POST['simpan'])) {
        $id         = $_GET['id'];

        // image
        $nama_image     = $_FILES['image']['name'];
        $size_image     = $_FILES['image']['size'];
        $tipe_image     = $_FILES['image']['type'];
        $tmp_image      = $_FILES['image']['tmp_name'];

        // audio
        $nama_audio     = $_FILES['audio']['name'];
        $size_audio     = $_FILES['audio']['size'];
        $tipe_audio     = $_FILES['audio']['type'];
        $tmp_audio      = $_FILES['audio']['tmp_name'];

        // video
        $nama_video     = $_FILES['video']['name'];
        $size_video     = $_FILES['video']['size'];
        $tipe_video     = $_FILES['video']['type'];
        $tmp_video      = $_FILES['video']['tmp_name'];

        // lokasi penyimpanan
        $lokasi_image = 'file/'.$nama_image;
        $lokasi_audio  = 'file/'.$nama_audio;
        $lokasi_video  = 'file/'.$nama_video;

        // upload image
        if($tipe_image == "image/jpeg" || $tipe_image == "image/png"){
            if($size_image <= 1000000){ //1Mb
                if(move_uploaded_file($tmp_image, $lokasi_image)){

                    // upload audio
                    if($tipe_audio == "audio/wav" || $tipe_audio == "audio/mp3"){
                        if($size_audio <= 10000000){ //10Mb
                            if(move_uploaded_file($tmp_audio, $lokasi_audio)){

                                // upload video
                                if($tipe_video == "video/mp4" || $tipe_video == "video/avi" || $tipe_video == "video/mov"){
                                    if($size_video <= 100000000){ //100Mb
                                        if(move_uploaded_file($tmp_video, $lokasi_video)){

                                            $sql = "UPDATE files
                                                    SET image='$nama_image', audio='$nama_audio', video='$nama_video'
                                                    WHERE id='$id' ";
                                            if($connect->query($sql))
                                                header('Location: index.php');

                                        } else { die('error upload video'); }
                                    } else { die('error ukuran video'); }
                                } else { die('error tipe video'); }
                                // end upload video

                            } else { die('error upload audio'); }
                        } else { die('error ukuran audio'); }
                    } else { die('error tipe audio'); }
                    //end upload audio

                } else { die('error upload gambar'); }
            } else { die('error ukuran gambar'); }
        } else { die('error tipe gambar'); }
        // end upload image

    }

    // menampilkan data ke value form
    $id    = $_GET['id'];
    $sql   = "SELECT * FROM files WHERE id='$id'";
    $hasil = $connect->query($sql);
    $data  = $hasil->fetch_object();

?>



<form action="" method="post" enctype="multipart/form-data">
    <table align="center">

        <tr>
            <td>Pilih Gambar : <input type="file" name="image"><?php echo $data->image ?></td>
            <td>Pilih Audio  : <input type="file" name="audio"><?php echo $data->audio ?></td>
            <td>Pilih Video  : <input type="file" name="video"><?php echo $data->video ?></td>
        </tr>
        <tr>
            <td><br></td>
        </tr>
        <tr align="center">
            <td colspan="3"><input type="submit" value="Upload" name="simpan"></td>
        </tr>

    </table>
</form>
