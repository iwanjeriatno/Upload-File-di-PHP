<!DOCTYPE html>
<html>
<body>

<!-- tabel -->

    <table align="center" border="1" width="100%">
        <caption><a href="tambah-full.php">Tambah Data</a></caption>
        <tr>
            <td>ID</td>
            <td>Image</td>
            <td>Audio</td>
            <td>Video</td>
            <td>Aksi</td>
        </tr>

        <?php
            include_once 'ConnectDB.php';

            $sql = "SELECT * FROM files";
            $hasil = $connect->query($sql);
            $jumlah_data = $hasil->num_rows;
            if($jumlah_data > 0) {
                while ($data = $hasil->fetch_object()) {
        ?>

                <tr>
                    <td align="center"><?php echo $data->id ?></td>
                    <td width=200px>
                        <img width="200" src="<?php echo 'file/'.$data->image ?>">
                    </td>
                    <td width=100px>
                        <audio controls src="<?php echo 'file/'.$data->audio ?>"></audio>
                    </td>
                    <td width=200px>
                        <video  width="200" height="200" controls>
                            <source src="<?php echo 'file/'.$data->video ?>" type="video/mp4" />
                        </video>
                    <td>
                        <p align="center">
                            <a href="ubah-full.php?id=<?php echo $data->id; ?>">Ubah</a><br>
                            <a href="hapus.php?id=<?php echo $data->id; ?>">Hapus</a>
                        </p>

                    </td>
                </tr>

        <?php
                }
            }
        ?>
    </table>



</body>
</html>
