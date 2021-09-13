<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-7">

            <div class="card">
                <div class="card-body">
                    
                    <!-- Default form -->
                    <form class="p-5" method="POST" enctype="multipart/form-data">
                        
                        <p class="h2 mb-5">Cek Stok Darah di PMI</p>
                        <!-- Golongan Darah -->
                        <div class="form-row">
                            <div class="col-md-3 pt-2">
                                <p class="text-justify text-danger">Golongan Darah</p>
                            </div>
                            <div class="col-md-9">
                                <!-- opt goldar -->
                                <select name="select-darah" class="browser-default custom-select mb-4" required>
                                    <option selected>Pilih Golongan Darah</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="AB">AB</option>
                                    <option value="O">O</option>
                                </select>
                            </div>
                        </div>
                        
                        <!-- Sign up button -->
                        <button class="btn btn-danger my-4 btn-block" type="submit" name="btnCheckStok">Cek Stok Darah</button>
                    </form>
                    <!--End  Default form -->
<?php
    include_once 'aksi/get-stok-darah.php';
?>
                </div>
            </div>
            <h2 class="text-center mt-5">Tabel Ketersediaan Darah</h2>
        </div> 
            <!-- card get soal--> 

            <!-- Tabel B.indo-->
            <table class="table">
                <thead class="red ligthen-1 white-text text-center">
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Gol Darah</th>
                    <th scope="col">Jumlah Kantong</th>
                  </tr>
                </thead>
                
                <tbody class="text-center">
                <tr>
<?php
$no = 0;
while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
?>
                <th scope = "row"> <?php $no++; echo $no ?> </th>
                    
                    <td> <?php echo $row['gol_darah']?> </td>
                    <td> <?php echo $row['jlh_kantong_darah']?> </td>
                    
                </tr> 
<?php } ?>
                </tbody>
            </table>

                        
    </div>
</div>
