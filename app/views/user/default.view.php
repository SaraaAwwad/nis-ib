<?php
                require_once HOME_TEMPLATE_PATH . 'templateheaderstart.php';
                require_once HOME_TEMPLATE_PATH . 'templateheaderend.php';
              //  require_once TEMPLATE_PATH . 'wrapperstart.php';
                require_once HOME_TEMPLATE_PATH . 'header.php';
                require_once HOME_TEMPLATE_PATH . 'nav.php';

              ?>
                
                <section id="main-content">
                    <section class="wrapper">
                        <div class="row">
                            <div class="col-lg-9 main-chart">
                               
						    </div><!-- /col-md-4 -->	
					    </div><!-- /row -->				
                  
      <!-- **********************************************************************************************************************************************************
      RIGHT SIDEBAR CONTENT
      *********************************************************************************************************************************************************** -->                  
                <div class="row">                  
                  <div class="col-lg-3 ds">

                        <!-- CALENDAR-->
                        <div id="calendar" class="mb">
                            <div class="panel green-panel no-margin">
                                <div class="panel-body">
                                    <div id="date-popover" class="popover top" style="cursor: pointer; disadding: block; margin-left: 33%; margin-top: -50px; width: 175px;">
                                        <div class="arrow"></div>
                                        <h3 class="popover-title" style="disadding: none;"></h3>
                                        <div id="date-popover-content" class="popover-content"></div>
                                    </div>
                                    <div id="my-calendar"></div>
                                </div>
                            </div>
                        </div><!-- / calendar -->
                      
                  </div><!-- /col-lg-3 -->
              </div><! --/row -->
          </section>
      </section>
                <?php
                //require_once TEMPLATE_PATH . 'wrapperend.php';
                require_once HOME_TEMPLATE_PATH . 'templatefooter.php';
