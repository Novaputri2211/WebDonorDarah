<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-7">

            <div class="card" >
                <div class="card-body">
                    
                    <!-- Default form-->
                    <form class="p-5" method="POST" enctype="multipart/form-data">
                        
                        <p class="h2 mb-5">Daftar Pendonor Yang Telah Terkonfirmasi</p>
                        <!-- goldar -->
                        <div class="form-row">
                            <div class="col-md-3 pt-2">
                                <p class="text-justify text-danger">Golongan Darah</p>
                            </div>
                            <div class="col-md-9">
                                <!-- opt goldar -->
                                <select name="select-goldar" class="browser-default custom-select mb-4" required>
                                    <option selected>Pilih Golongan Darah Pendonor</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="AB">AB</option>
                                    <option value="O">O</option>
                                </select>
                            </div>
                        </div>
                        
                        <!-- Sign up button -->
                        <button class="btn btn-danger my-4 btn-block" type="submit" name="btnCariPendonor">Tampilkan Pendonor Terkonfirmasi</button>
                    </form>
                    <!--End  Default form -->
<?php
    include_once 'aksi/show-pendonor-sudah.php';
?>
                </div>
            </div>
            <h2 class="text-center mt-5">List Pendonor Darah </h2>
        </div> 
            <!-- card get soal--> 
       
            <table class="table" style="width: 1100px;">
                <thead class="red ligthen-1 white-text text-center">
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Tanggal Donor</th>
                    <th scope="col">Golongan Darah</th>
                    <th scope="col">Jumlah Kantong</th>
                    <th scope="col">Alamat</th>
                    
                  </tr>
                </thead>
                
                <tbody class="text-center">
                <tr>
<?php
$count = 0;
while($row = $statement->fetch(PDO::FETCH_ASSOC)){

?> 
                <th scope = "row"> <?php $count++; echo $count; ?> </th>
                    
                    <td> <?php echo $row['nama_pendonor']?> </td>
                    <td> <?php echo $row['tanggal_donor']?> </td>
                    <td> <?php echo $row['gol_darah']?> </td>
                    <td> <?php echo $row['jlh_kantong']?> </td>
                    <td> <?php echo $row['alamat']?> </td>
                    
                </tr> 
<?php
}
?>
                </tbody>
            </table>
            
    </div>
</div>
