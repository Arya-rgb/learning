<!DOCTYPE html>

<head> 
    <title>Test User</title>
</head>

<body> 
    <h1> test database dan hapus index.php </h1>
    <table border="1"> 
        <tr> 
            <th>Id</th>
            <th>Nama</th>
            <th>Kelas</th>
            <th>Alamat</th>
        </tr>
        <?php foreach($testtable as $test) { ?>
        <tr>
            <td><?php echo $test->id?></td>
            <td><?php echo $test->nama?></td>
            <td><?php echo $test->kelas?></td>
            <td><?php echo $test->alamat?></td>
        </tr>
        <?php } ?>
    </table>
</body>