<div class="page-content-wrapper">
  <div class="page-content">
    <!--     <div class="page-bar">
      <ul class="page-breadcrumb">
        <li>
          <span><?php echo $title; ?></span>
          <span>Home</span>
        </li>
      </ul>
      <div class="page-toolbar">
        <div id="dashboard-report-range" class="pull-right tooltips btn btn-sm" data-container="body" data-placement="bottom">
          <span class="thin uppercase hidden-xs" id="datetime"></span>
          <script type="text/javascript">window.onload = date_time('datetime');</script>
        </div>
      </div>
    </div> -->

    <div style="margin-top:-10px">
      <div class="portlet box blue" id="box">
        <div class="portlet-title">
          <div class="caption">
            <?php echo $title; ?>
          </div>
        </div>

        <div class="portlet-body">
          <div class="box-body">
            <div class="row">
              <div class="col-md-8">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th colspan="2" style="text-align: left;"></th>
                    </tr>
                  </thead>

                  <tr style="background-color:  #f3d95aa3;">
                    <td style="margin-left: 100px">DATA PRIBADI:</td>
                    <td></td>
                  </tr>
                  <tr>
                    <td style="margin-left: 100px">User Name</td>
                    <td>: <span id="username"><?php echo $detail->username; ?><span></td>
                  </tr>
                  <tr>
                    <td>NIK</td>
                    <td>: <span id="nik"><?php echo $detail->ktp; ?></span></td>
                  </tr>
                  <tr>
                    <td>Nama</td>
                    <td>: <span id="full_name"><?php echo $detail->full_name; ?></span></td>
                  </tr>

                  <tr>
                    <td>Tempat & Tanggal lahir</td>
                    <td>: <span id="ttl"><?php echo $detail->tempat_lahir; ?>, <?=$detail->tanggal_lahir;?></span></td>
                  </tr>
                 <tr>
                    <td>No Handphone</td>
                    <td>: <span id="phone"><?php echo $detail->phone; ?></span></td>
                  </tr>
                  <tr>
                    <td>Email</td>
                    <td>: <span id="phone"><?php echo $detail->email; ?></span></td>
                  </tr>
                  <tr>
                    <td>Alamat</td>
                    <td>: <span id="alamat"><?php echo $detail->alamat; ?></span></td>
                  </tr>
                  <tr>
                    <td>Domisili</td>
                    <td>: <span id="domisili"><?php echo $detail->domisili; ?></span></td>
                  </tr>
                  <tr>
                    <td>Jenis Kelamin</td>
                    <td>: <span id="jk"><?php $jenis='Perempuan';  if($detail->jk ==1){$jenis = 'Laki-laki';} echo $jenis; ?></span></td>
                  </tr>
                  <tr>
                    <td>Pendidikan</td>
                    <td>: <span id="pendidikan"><?php echo $detail->pendidikan; ?></span></td>
                  </tr>
                  <tr>
                    <td>Pekerjaan</td>
                    <td>: <span id="pekerjaan"><?php echo $detail->pekerjaan; ?></span></td>
                  </tr>
                  <tr>
                    <td>Status Anggota</td>
                    <td>: <span id="status"><?php $status = 'Tidak Aktif';if($detail->status_aktif==1){$status ='aktif';} echo $status; ?></span></td>
                  </tr>
                </table>
              </div>
              <div class="col-md-4">
                <div class="col-md-12">
                  
                  <img src="<?php echo base_url() ?>assets/img/person.png" class="img-responsive" alt=""> </div>
                <!-- END SIDEBAR USERPIC -->
                <!-- SIDEBAR USER TITLE -->
                <div class="profile-usertitle">
                  <div class="profile-usertitle-name"> <?php echo $detail->gereja ?> </div>
                </div>
                <!-- END SIDEBAR USER TITLE -->
                <div class="profile-userbuttons">
                  <!-- <a href="#" class="btn  green btn-sm">Ganti Password</a> -->
                  <?php
                  $edit_url = site_url('home/edit/' . $this->enc->encode($detail->id));
                  $change_url = site_url('home/change_password/' . $this->enc->encode($detail->id));

                  $button = '<button onclick="showModal(\'' . $edit_url . '\')" class="btn btn-sm btn-primary" title="Edit">Edit</button> ';
                  $change_password = '<button onclick="showModal(\'' . $change_url . '\')" class="btn btn-sm btn-primary" title="Ganti Password">Ganti Password</button> ';
                  
                  echo  $change_password;
                  echo $edit;


                  ?>
                </div>
              </div>


            </div>

          </div>
        </div>

      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  function ambil_data() {
    $.ajax({
      type: "post",
      url: "<?php echo site_url() ?>/home/ambil_data",
      dataType: "json",
      success: function(x) {
        console.log(x.username);

        $("#username").html(x.username);
        $("#full_name").html(x.full_name);
        $("#group").html(x.group_name);
        $("#phone").html(x.phone);
        $("#port").html(x.port);
      }
    });
  }

  $(document).ready(function() {
    ambil_data();
  });
</script>