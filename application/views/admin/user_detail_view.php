
<section>

    <h3>ข้อมูลผู้ใช้</h3>
    ชื่อและนามสกุล: <?php echo $firstname . ' ' . $lastname; ?>
    <br>
    Email: <?php echo $email; ?>
    <br>
    โทรศัพท์: <?php echo $phone; ?>
    <br>
    เข้าใช้งานครั้งล่าสุด: <?php echo $recent_login; ?>
    <br>
    ตำแหน่ง/อาชีพ: 
    <?php if ($position == 'other'): ?>
        <?php echo $detail; ?>
    <?php else: ?>
        <?php echo $position; ?>
    <?php endif; ?>
    <br>
    <?php if (!empty($supervisor)): ?>
        อาจารย์ที่ปรึกษา: <?php echo $supervisor; ?>
        <br>
    <?php endif; ?>
    สถาบัน/หน่วยงาน: <?php echo $institute; ?>   
    <br>   

    <!-- Button trigger modal -->
    <?php if ($this->session->userdata('user_id') == $user_id): ?>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" style="margin-top: 15px;">
            <span class="glyphicon glyphicon-wrench" aria-hidden="true"></span> แก้ไขข้อมูล
        </button>
    <?php endif; ?>

    <a href="<?php echo site_url(); ?>/admin/calendar">
        <button type="button" class="btn btn-default" style="margin-top: 15px;">
            <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> ไปปฏิทิน
        </button>
    </a>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span> แก้ไขข้อมูลส่วนตัว</h4>
                </div>
                <div class="modal-body">
                    <form role="form" class="form-inline" method="post" action="#">
                        <div class="input-group" style="margin-right: 15px;">
                            <div class="form-group">
                                <div class="input-group" style="margin-right: 15px;">
                                    <input style="border-radius: 0;" type="text" name="firstname" class="form-control" required id="firstname" placeholder="ชื่อจริง" value="<?php echo $firstname; ?>">
                                </div>
                            </div>
                            <div class="form-group">                              
                                <input style="border-radius: 0;" type="text" name="lastname" class="form-control" required id="lastname" placeholder="นามสกุล" value="<?php echo $lastname; ?>">       
                            </div>
                            <div>
                                <input class="form-control register_email" type="email" name="email" required disabled placeholder="อีเมล" style="width: 100%; margin-top: 15px; margin-bottom: 5px;" value="<?php echo $email; ?>">
                            </div>                            
                            <div>
                                <input class="form-control" type="text" name="phone" required placeholder="โทรศัพท์" style="width: 100%; margin-top: 15px; margin-bottom: 15px;" value="<?php  echo $phone; ?>">            
                            </div>

                            <div style="margin-bottom: 15px;">
                                <h4>อาชีพ / ตำแหน่ง</h4>
                                <select class="form-control" required name="position" id="position" style="width: 100%; margin-bottom: 10px;">
                                    <option value="researcher"<?php if($position == 'researcher'): echo ' selected'; endif; ?>>นักวิจัย</option>
                                    <option value="instructor"<?php if($position == 'instructor'): echo ' selected'; endif; ?>>อาจารย์</option>
                                    <option value="student"<?php if($position == 'student'): echo ' selected'; endif; ?>>นักศึกษา</option>
                                    <option value="other"<?php if($position == 'other'): echo ' selected'; endif; ?>>อื่นๆ</option>
                                </select>

                                <label>- ถ้าเลือก อื่นๆ</label>
                                <input class="form-control" name="detail" id="detail" style="width: 100%; margin-bottom: 10px;" placeholder="&nbsp;โปรดระบุ อาชีพ / ตำแหน่ง" value="<?php echo $detail; ?>">
                                <br>

                                <label>- ถ้าเลือก นักศึกษา / นักวิจัย</label>
                                <input class="form-control" name="supervisor" id="supervisor" style="width: 100%; margin-bottom: 10px;" placeholder="&nbsp;โปรดระบุ ชื่ออาจารย์ที่ปรึกษา / supervisor (ถ้ามี)" value="<?php echo $supervisor; ?>">
                                <br>

                                <label><span style="color: red;">**</span>สถาบัน / มหาวิทยาลัย / หน่วยงาน</label>
                                <input class="form-control" name="institute" id="institute" required style="width: 100%; margin-bottom: 10px;" value="<?php echo $institute; ?>">

                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> ยืนยัน</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <p>&nbsp;</p>

    <h3>รายการ จองคิว</h3>
    <table class="table table-bordered">
        <tr>
            <th>วันที่จอง</th>
            <th>จำนวน Sample</th>
            <th>รายละเอียด Sample</th>
            <th>จองเมื่อ</th>
            <th>ปรับปรุงข้อมูลเมื่อ</th>
        </tr>
        <?php foreach ($q_reservation->result() as $reservation): ?>
            <tr>
                <td>
                    <a href="<?php echo site_url(); ?>/admin/reserved_detail/<?php echo $reservation->reserved_date . '/' . $reservation->reserved_id; ?>">
                        <?php echo $reservation->reserved_date; ?>
                    </a>
                </td>
                <td style="text-align: center;"><?php echo $reservation->sample_number; ?></td>
                <td><?php echo $reservation->detail; ?></td>
                <td style="text-align: center;"><?php echo $reservation->created; ?></td>
                <td style="text-align: center;"><?php echo $reservation->updated; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

</section>