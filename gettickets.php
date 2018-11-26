<?php
$tickets = $_GET['q'];
$expldTickets = explode("_",$tickets);
if($expldTickets[1]<=2)
{
?>
                    <div class="panel">
                      <div class="panel-heading" role="tab" id="headingTwo">
                        <h4 class="panel-title">
                          <a class="c-font-bold c-font-18" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo2" aria-expanded="false" aria-controls="collapseTwo2">Stag<span class="price-right"> <i class="fa fa-inr1"></i></span></a>
                        </h4>
                      </div>
                      <div id="collapseTwo2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo" aria-expanded="false" style="">

                        <div class="panel-body">

                          <div class="col-md-9 col-xs-12">

                            <p class="lit-info2">
                              <label class="checkbox-inline">Price: Rs. <?php echo $expldTickets[0]; ?>/-</label>
                              <input type="hidden" name="price" id="price" value="<?php echo $expldTickets[0]; ?>">
                            </p>
                            <!--<p class="lit-info2">
                              <label class="checkbox-inline">Desc:<?php echo $expldTickets[0]; ?></label>
                              <input type="hidden" name="item" id="item" value="<?php echo $expldTickets[0]; ?>">
                            </p>-->

                            <hr>
                           </div>
                           
                          <div class="col-md-3 col-xs-12">
                              <input type="hidden" name="item" id="item" value="stag_girl">
                              <input type="hidden" name="checkout" value="checkout">
                              <input type="hidden" id="str" name="str">
                              <input type="submit" id="booknow" data-id="stag_form" class="btn pull-right c-margin-t-30 c-btn-green c-btn-circle c-btn-bold c-btn-uppercase" data-toggle="modal" data-target=".bs-example-modal-sm" value="BOOK NOW">
                              </p>
                            </div>
                          
                        </div>
                      </div>
                    </div>
<?php
}
?>