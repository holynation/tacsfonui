<!-- this is the Sidebar Start -->
<?php 
    $userType=$this->webSessionManager->getCurrentUserProp('user_type');
    if ($userType=='member') {
      include_once "template/sidebar_member.php";
    }
?>
    
<?php if ($userType=='admin'): ?>
    <aside class="sidebar" data-trigger="scrollbar">
        <!-- Sidebar Profile Start -->
        <div class="sidebar--profile">
            <div class="profile--img">
                <a href="profile.html">
                    <img src="<?php echo base_url(); ?>assets/private/img/avatars/01_80x80.png" alt="" class="rounded-circle">
                </a>
            </div>

            <div class="profile--name">
                <a href="profile.html" class="btn-link">Henry Foster</a>
            </div>

            <div class="profile--nav">
                <ul class="nav">
                    <li class="nav-item">
                        <a href="profile.html" class="nav-link" title="User Profile">
                            <i class="fa fa-user"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="lock-screen.html" class="nav-link" title="Lock Screen">
                            <i class="fa fa-lock"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url('auth/logout'); ?>" class="nav-link" title="Logout">
                            <i class="fa fa-sign-out-alt"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Sidebar Profile End -->

        <!-- Sidebar Navigation Start -->
        
        <div class="sidebar--nav">
            <ul>
                <?php 
                  if(isset($canView)){
                    foreach ($canView as $key => $value): ?>
                   <?php 
                       $state='';
                        if ($canView[$key]['state']===0) {
                         continue;
                       }
                    ?>
                <li>
                    <ul>
                        <li class="active">
                            <a href="#">
                                <i class="fa <?php echo $value['class']; ?>"></i>
                                <span><?php echo $key; ?></span>
                            </a>

                            <ul>
                                <?php foreach ($value['children'] as $label =>$link): ?>
                                <li><a href="<?php echo base_url($link); ?>"><?php echo $label; ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </li>
                    </ul>
                </li>
                <?php endforeach; }?>
            </ul>
        </div>
        
        <!-- Sidebar Navigation End -->
    </aside>
    <!-- Sidebar End -->
<?php endif; ?>
