<!DOCTYPE html>
<html>

<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />
</head>

<body>
    <aside class="left-side sidebar-offcanvas">
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="img/avatar04.png" class="img-circle" alt="avataruser" />
                </div>
                <div class="pull-left info">
                    <p>User: <small><?php echo $this->session->userdata('username'); ?></small></p>
                    <small><i class="fa fa-circle text-success"></i>
                        Online</small>
                </div>
            </div>
            <ul class="sidebar-menu">
                <?php
                foreach ($menu->result() as $row) { ?>
                    <li>
                        <a href="<?php echo $row->menu_uri; ?>">
                            <i class="<?php echo $row->menu_icon; ?>"></i>
                            <span><?php echo $row->menu_nama; ?></span>

                        </a>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>
</body>

</html>