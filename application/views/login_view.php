
<h3>เข้าสู่ระบบ (Login)</h3>
<section style="background-color: #c0c0c0; padding-top: 10px; padding-bottom: 10px; padding-left: 15px;">    
    <form class="form-inline" role="form" method="post" action="<?php echo site_url(); ?>/login/process">
        <div class="input-group" style="margin-right: 15px;">
            <label class="" for="emailLogin">Email address</label>            
            <input style="border-radius: 0;" type="email" name="email" class="form-control" required id="emailLogin" placeholder="Email">
        </div>

        <div class="input-group" style="margin-right: 15px;">
            <label class="" for="passwordLogin">Password</label>
            <input style="border-radius: 0;" type="password" name="password" class="form-control" required id="passwordLogin" placeholder="Password"> 
        </div>

        <div class="input-group" style="margin-top: 25px;">
            <label class="sr-only">Button</label>
            <button type="submit" id="loginButton" class="btn btn-default">เข้าสู่ระบบ</button>
        </div>

        <div style="margin-top: 10px;">
            <input type="checkbox" id="saveLogin"> Remember me
        </div>
    </form>
</section>

<hr>

<section>
    <h3>สมัครใช้งาน</h3>
    <form role="form" class="form-inline" method="post" action="<?php echo site_url(); ?>/register/process">
        <div class="input-group" style="margin-right: 15px;">
            <div class="form-group">
                <div class="input-group" style="margin-right: 15px;">
                    <input style="border-radius: 0;" type="text" name="firstname" class="form-control" required id="firstname" placeholder="ชื่อจริง">
                </div>
            </div>
            <div class="form-group">                              
                <input style="border-radius: 0;" type="text" name="lastname" class="form-control" required id="lastname" placeholder="นามสกุล">       
            </div>
            <div>
                <input class="form-control register_email" type="email" name="email" required placeholder="อีเมล" style="width: 100%; margin-top: 15px; margin-bottom: 5px;">
            </div>
            <button type="button" id="check_email">Check email</button>&nbsp;<span id="check_result"></span>
            <script>
                $(function () {

                    $("#check_email").click(function () {
                        $(document).ajaxStart(function () {
                            $("#check_result").html("<img src=\"<?php echo base_url(); ?>images/indicator_big.gif\">");
                        });
                        $.ajax({
                            url: "<?php echo site_url(); ?>/register/check_email",
                            data: {
                                register_email: $(".register_email").val()
                            },
                            success: function (data) {
                                $("#check_result").html(data);
                            }
                        });
                    });

                    $(".register_email").focusout(function () {
                        $(document).ajaxStart(function () {
                            $("#check_result").html("<img src=\"<?php echo base_url(); ?>images/indicator_big.gif\">");
                        });
                        $.ajax({
                            url: "<?php echo site_url(); ?>/register/check_email",
                            data: {
                                register_email: $(".register_email").val()
                            },
                            success: function (data) {
                                $("#check_result").html(data);
                            }
                        });
                    });

                });
            </script>
            <div>
                <input class="form-control" type="password" name="password" required placeholder="รหัสผ่านใหม่" style="width: 100%; margin-top: 15px;">
            </div>
            <div>
                <input class="form-control" type="text" name="phone" required placeholder="โทรศัพท์" style="width: 100%; margin-top: 15px; margin-bottom: 15px;">            
            </div>

            <div style="margin-bottom: 15px;">
                <h4>อาชีพ / ตำแหน่ง</h4>
                <select class="form-control" required name="position" id="position" style="width: 100%; margin-bottom: 10px;">
                    <option value="researcher">นักวิจัย</option>
                    <option value="instructor">อาจารย์</option>
                    <option value="student">นักศึกษา</option>
                    <option value="other">อื่นๆ</option>
                </select>

                <label>- ถ้าเลือก อาชีพ/ตำแหน่ง อื่นๆ</label>
                <input class="form-control" name="detail" id="detail" style="width: 100%; margin-bottom: 10px;" placeholder="&nbsp;โปรดระบุ อาชีพ / ตำแหน่ง">
                <br>

                <label>- ถ้าเลือก นักศึกษา / นักวิจัย</label>
                <input class="form-control" name="supervisor" id="supervisor" style="width: 100%; margin-bottom: 10px;" placeholder="&nbsp;โปรดระบุ ชื่ออาจารย์ที่ปรึกษา / supervisor (ถ้ามี)">
                <br>

                <label>สถาบัน / มหาวิทยาลัย / หน่วยงาน <span style="color: red;">**</span></label>
                <input class="form-control" name="institute" id="institute" required style="width: 100%; margin-bottom: 10px;">
                <br>

                <div class="g-recaptcha" data-sitekey="6LcLV_8SAAAAAIPn3mltIpW_wodxT8rPVx9poQy2"></div>                
                <br>
                <div style="color: red; margin-top: 30px;">
                    <?php if (!empty($error_msg)): ?>
                        <?php echo $error_msg; ?>
                    <?php endif; ?>
                </div>
                <button style="margin-top: 20px;" type="submit" class="btn btn-default btn-lg">สมัครใช้งาน</button>                
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <span style="cursor: pointer; text-decoration: underline;" data-toggle="modal" data-target=".bs-example-modal-lg">ข้อตกลงและเงื่อนไข</span>
            </div>
        </div> <!-- /.input-group -->
    </form>

    
    
    <!-- Large modal -->
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">                        
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">ข้อตกลงและเงื่อนไข</h4>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</section>
