  <?php if (!$_SESSION["id_usuario"]) {
      redirect('Portal_c');
    } ?>
    <!-- main header -->
    <header id="header_main">
        <div class="header_main_content">
            <nav class="uk-navbar">
                                
                <!-- main sidebar switch -->
                <a href="#" id="sidebar_main_toggle" class="sSwitch sSwitch_left">
                    <span class="sSwitchIcon"></span>
                </a>
                
                <!-- secondary sidebar switch -->
                <a href="#" id="sidebar_secondary_toggle" class="sSwitch sSwitch_right sidebar_secondary_check">
                    <span class="sSwitchIcon"></span>
                </a>

                <div class="uk-navbar-flip">
                    <ul class="uk-navbar-nav user_actions">
                        <li><a href="#" id="full_screen_toggle" class="user_action_icon uk-visible-large"><i class="material-icons md-24 md-light">&#xE5D0;</i></a></li>
                        <li><a href="#" id="main_search_btn" class="user_action_icon"><i class="material-icons md-24 md-light">&#xE8B6;</i></a></li>
                        <li data-uk-dropdown="{mode:'click',pos:'bottom-right'}">
                            <a href="#" class="user_action_icon"><i class="material-icons md-24 md-light">&#xE7F4;</i><span class="uk-badge">16</span></a>
                            <div class="uk-dropdown uk-dropdown-xlarge">
                                <div class="md-card-content">
                                    <ul class="uk-tab uk-tab-grid" data-uk-tab="{connect:'#header_alerts',animation:'slide-horizontal'}">
                                        <li class="uk-width-1-2 uk-active"><a href="#" class="js-uk-prevent uk-text-small">Messages (12)</a></li>
                                        <li class="uk-width-1-2"><a href="#" class="js-uk-prevent uk-text-small">Alerts (4)</a></li>
                                    </ul>
                                    <ul id="header_alerts" class="uk-switcher uk-margin">
                                        <li>
                                            <ul class="md-list md-list-addon">
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <span class="md-user-letters md-bg-cyan">mu</span>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading"><a href="pages_mailbox.html">Minima illum.</a></span>
                                                        <span class="uk-text-small uk-text-muted">Iusto deleniti quisquam exercitationem pariatur a sequi magnam aut qui aspernatur et.</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <img class="md-user-image md-list-addon-avatar" src="<?php echo base_url();?>public/assets/img/avatars/avatar_07_tn.png" alt=""/>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading"><a href="pages_mailbox.html">Quidem voluptas.</a></span>
                                                        <span class="uk-text-small uk-text-muted">Id est non numquam expedita ducimus tempore.</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <span class="md-user-letters md-bg-light-green">za</span>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading"><a href="pages_mailbox.html">Qui asperiores facilis.</a></span>
                                                        <span class="uk-text-small uk-text-muted">Commodi odit et aut illum sed suscipit asperiores dolorum ut tenetur.</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <img class="md-user-image md-list-addon-avatar" src="<?php echo base_url();?>public/assets/img/avatars/avatar_02_tn.png" alt=""/>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading"><a href="pages_mailbox.html">Rerum aut.</a></span>
                                                        <span class="uk-text-small uk-text-muted">Perspiciatis aliquid totam natus vel harum.</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <img class="md-user-image md-list-addon-avatar" src="<?php echo base_url();?>public/assets/img/avatars/avatar_09_tn.png" alt=""/>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading"><a href="pages_mailbox.html">Voluptatem beatae.</a></span>
                                                        <span class="uk-text-small uk-text-muted">Nam nostrum dolor beatae sed nostrum.</span>
                                                    </div>
                                                </li>
                                            </ul>
                                            <div class="uk-text-center uk-margin-top uk-margin-small-bottom">
                                                <a href="page_mailbox.html" class="md-btn md-btn-flat md-btn-flat-primary js-uk-prevent">Show All</a>
                                            </div>
                                        </li>
                                        <li>
                                            <ul class="md-list md-list-addon">
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <i class="md-list-addon-icon material-icons uk-text-warning">&#xE8B2;</i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading">Pariatur officia.</span>
                                                        <span class="uk-text-small uk-text-muted uk-text-truncate">Unde deleniti expedita voluptatem.</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <i class="md-list-addon-icon material-icons uk-text-success">&#xE88F;</i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading">Illum ea autem.</span>
                                                        <span class="uk-text-small uk-text-muted uk-text-truncate">Minus neque nihil dolor reiciendis rerum incidunt.</span>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li data-uk-dropdown="{mode:'click',pos:'bottom-right'}">
                            <a href="#" class="user_action_image"><img class="md-user-image" src="<?php echo base_url().$_SESSION['foto'];?>" alt=""/></a>
                            <div class="uk-dropdown uk-dropdown-small">
                                <ul class="uk-nav js-uk-prevent">
                                    <li><a href="page_user_profile.html">Mi Perfil</a></li>
                                    <li><a href="page_settings.html">Ajustes</a></li>
                                    <li><a href="<?php echo base_url(); ?>Principal_c/cerrar_sesion">Desconectar</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="header_main_search_form">
            <i class="md-icon header_main_search_close material-icons">&#xE5CD;</i>
            <form class="uk-form">
                <input type="text" class="header_main_search_input" />
                <button class="header_main_search_btn uk-button-link"><i class="md-icon material-icons">&#xE8B6;</i></button>
            </form>
        </div>
    </header><!-- main header end -->
    <!-- main sidebar -->
    <aside id="sidebar_main">
        
        <div class="sidebar_main_header">
            <div class="sidebar_logo" >
                <a href="<?php echo base_url().'Principal_c'; ?>" class="sSidebar_hide"><p style="font-family: Georgia;font-size: 25px;"><img src="<?php echo base_url(); ?>public/foto/logo/logo_3.png" style="width:30px;height: 30px;"><j style="color: #212121;">HILA</j><j style="color: #4588e6;">RIO</j></p></a>
                <a href="<?php echo base_url().'Principal_c'; ?>" class="sSidebar_show"><p style="font-family: Georgia;font-size: 25px;"><j style="color: #4588e6;">G. </j><j style="color: #212121;">HILA</j><j style="color: #4588e6;">RIO</j></p></a>
            </div>
            <div class="sidebar_actions">
                <p  style="font-family: Georgia; color: #212121;font-size: 15px;"><j style="color: #f2f2f2;">BIENVENIDO!! </j><br><?php  echo $_SESSION["personal"]; ?> </p>
               
            </div>
        </div>
        
        <div class="menu_section">
            <ul>
              <?php  $idhijo=0; foreach ($permisos as $value1){ 
              $idpadre= $value1->idpadre;
              if($idpadre != $idhijo){  ?>  
                <li title="<?php  echo $value1->padre; ?>" >           
                    <a href="">
                        <span class="menu_icon"><i class="material-icons"><?php  echo $value1->icono; ?></i></span>
                        <span class="menu_title" style="font-family: Georgia;" ><?php  echo $value1->padre; ?></span>
                    </a>
                    <ul>
                    <?php foreach ($permisos as $value){
                  if($value1->idpadre == $value->idpadre){ $idhijo=$value->idpadre;?>
                        <li class=""><a href="<?php echo base_url().$value->url;?>" style="font-family: Georgia;"><i class="material-icons"><?php  echo $value->icono_h; ?></i><?php  echo ' '.$value->hijo ?> </a></li>
                        <?php } }  ?>
                     </ul>
                </li>
                <?php }} ?>

            </ul>
        </div>
    </aside><!-- main sidebar end -->

<div id="page_content">
    <div id="page_content_inner">
