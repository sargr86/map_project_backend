<div class="content">
    <div class="container">
        <div class="profile">
            <div class="place-order">
                <span class="orange-color">Custom Documents</span>
                <div class="button-place go-to-details order_detalis_mobile">
                    <a href="<?php echo base_url('dashboard/view_order/'.$order_info['id']); ?>" class="btn btn-default btn-login-orange no_transform">Go Order Details</a>
                </div>
                <div class="place-order-content more">
                    <div class="col-xs-12 hidden-sm hidden-md hidden-lg text-center"><span class="orange-color"><?php echo $title; ?></span></div>
                    <div class="col-md-3 col-sm-4 col-xs-6 first">
                        <p class="pc_version"><?php echo $order_info['currier_name']." ".$order_info['send_type']; ?></p>
                        <?php
                        $type = $order_info['send_type'];
                        if($order_info['currier_name'] == 'FedEx' && $order_info['shipping_type'] == 1){

                            if(stripos($type, 'Express') !== false){
                                $type = 'Express';
                                $type = str_ireplace('days','',$type);

                            }elseif (stripos($type, 'Economy') !== false){
                                $type = 'Economy';
                                $type = str_ireplace('days','',$type);
                            }

                        }elseif($order_info['currier_name'] == 'DHL' && $order_info['shipping_type'] == 1){
                            if(stripos($type, 'Express') !== false){
                                $type = 'Express';

                            }
                        }?>
                        <p class="mobile_version"><?php echo $order_info['currier_name']." ".$type; ?></p>
                        <p>Shipping fee: <span class="orange-color pay_amount">$<?php echo (!empty($order_info['price']))?$order_info['price']:0; ?></span></p>
                        <!--<p class="blue-color"><a href="#" class="luggage_incurance">Luggage & Insurance</a></p>-->
                    </div>
                    <div class="col-md-6 col-sm-4 hidden-xs text-center"><br /><span class="orange-color"><?php echo $title; ?></span></div>
                    <div class="col-md-3 col-sm-4 col-xs-6 text-right last">
                        <p>Order #: <span class="orange-color"><?php echo $order_info['order_id']; ?></span></p>
                        <p class="light-gray">Order Date: <?php echo date("M-d-Y", strtotime($order_info['created_date'])); ?></p>
                        <!--<p class="blue-color"><a href="#" class="label_delivery">Label Delivery</p></a>-->
                    </div>
                    <p class="clearfix"></p>
                </div>
            </div>
            <?php

            $class1 = 'fa fa-exclamation information-icon';
            if(!empty($order_item_list) && !empty($order_info['signature'])){
                $class1 = 'fa fa-check verified-icon';
            }
            $class2 = 'fa fa-exclamation information-icon';
            if(!empty($passport_info)){

                $class2 = 'fa fa-check verified-icon';
            }

            $class3 = 'fa fa-exclamation information-icon';
            if(!empty($travel_info)){

                $class3 = 'fa fa-check verified-icon';
            }

            $item_class = '';
            if($order_info['order_type'] == 2){

                $item_class = 'dis_none_item_list';
            }
            ?>

            <div class="row order_detalis order_detail_view order_detalis_full">
                <div class="col-md-12 accept-group text-right">
                    <div class="button-place go-to-details">
                        <a href="<?php echo base_url('dashboard/view_order/'.$order_info['id']); ?>" class="btn btn-default btn-login-orange no_transform">Go Order Details</a>
                    </div>
                </div>
            </div>


            <div class="order-process-block">

                <!-- Nav tabs -->
                <ul class="nav nav-tabs responsive-tabs" role="tablist" id="my_accoutn_tabs">
                    <li class="active">
                        <a href="#account_information" data-toggle="tab">
                                <span class="tab-image">
                                    <img class="" src="<?php echo base_url()?>assets/images/fill-list.svg">
                                    <i class="<?php echo $class1;?>"></i>
                                </span> Item List <i class="fa fa-angle-down tab-down" aria-hidden="true"></i>
                        </a>
                    </li>
                    <li class="for_custum_documents <?php echo $item_class; ?>">
                        <a href="#traveler_list" data-toggle="tab" class="pasport_copy <?php echo $item_class; ?>">
                            <span class="tab-image">
                                    <img class="" src="<?php echo  base_url();?>assets/images/passport.svg">
                                    <i class="<?php echo $class2; ?>"></i>
                                </span> Passport Copy <i class="fa fa-angle-down tab-down" aria-hidden="true"></i>
                        </a>
                    </li>
                    <li class="for_custum_documents <?php echo $item_class; ?>">
                        <a href="#address_book" data-toggle="tab" class="travel_itinary <?php echo $item_class; ?>">
                                <span class="tab-image">
                                    <img class="" src="<?php echo  base_url();?>assets/images/airplane.svg">
                                    <i class="<?php echo $class3;?>"></i>
                                </span> Travel Itinerary <i class="fa fa-angle-down tab-down" aria-hidden="true"></i>
                        </a>
                    </li>
                </ul>
                <input type="hidden" name="country_id" value="<?php echo $sender_info['pickup_country_id']; ?>" id="country_id">
                <input type="hidden" name="order_id" value="<?php echo $order_info['id']; ?>" id="order_id">
                <!-- Tab panes -->
                <div class="tab-content tab-profile order-details-content">
                    <div class="tab-pane account-info active" id="account_information">
                        <div class="col-md-8 col-sm-12 mobile-full">

                            <div class="list-colored-block">
                                <h2>Please fill in the item list. <!--<span class="popover-style secure-code hidden-sm hidden-xs" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="" data-original-title="" title=""></span>--></h2>
                                <p class="lights">Please be advised the item list is necessary custom document for international shipment.
                                    Duties and taxes may be collected  by
                                    <span class="orange-color"><?php echo$country_info[0]['country']; ?></span>
                                    customs authority for  this shipment.
                                </p>

                                <form method="post" class="form-horizontal" action="">

                                    <table class="table designed-table table-bordered t-payment item-list-filled-table">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Item Name</th>
                                            <th>Quantity</th>
                                            <th>Unit Value</th>
                                            <th>Total</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $sum = 0;
                                        $all_sum = 0;
                                        $total_count = 0;
                                        foreach ($order_item_list as $index => $item_list) {

                                            $sum = floatval($item_list['item_count']) * floatval($item_list['item_price']);
                                            $all_sum += $sum;
                                            $total_count  +=$item_list['item_count'];
                                            ?>
                                            <tr>
                                                <td><?php echo $index+1; ?></td>
                                                <td><span class="orange-color"><?php echo $item_list['item_name'];?></span></td>
                                                <td><span class="orange-color"><?php echo $item_list['item_count'];?></span></td>
                                                <td><span class="orange-color">$ <?php echo $item_list['item_price'];?></span></td>
                                                <td><span class="orange-color">$ <?php echo $sum;?></span></td>
                                            </tr>

                                        <?php } ?>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <td colspan="4">
                                                <div class="col-sm-5 col-xs-7">

                                                </div>
                                                <div class="col-sm-3 col-xs-5 text-center">
                                                    Total: <span class="total-quantity"><?php echo $total_count; ?></span>
                                                </div>
                                            </td>
                                            <td class="text-center">$ <?php echo $all_sum; ?></td>
                                        </tr>
                                        </tfoot>
                                    </table>

                                    <h2>Please add your signature to confirm the item list</h2>
                                    <p class="lights">I declare that all information contained in above item list to be true and correct. <i> Please be advised that your signature will be used for custom invoice only. </i></p>

                                    <div class="row signature-block">
                                        <div class="col-md-8 col-sm-12 col-xs-12">
                                            <?php if (!empty($order_info['signature'])) { ?>
                                                <div id="signature_img"><img src="data:<?php echo $order_info['signature']; ?>" alt=""></div>
                                            <?php } ?>
                                        </div>
                                        <div class="col-xs-12 item_info_mobile mobile_version item_list_colepse" id="accordion" role="tablist" aria-multiselectable="true">
                                            <div class="panel-group no_margin_mobile item_list_mobile" id="accordion2" role="tablist" aria-multiselectable="true">
                                                <div class="panel-heading item_info_mobile col-xs-7 " role="tab" id="headingOne2">
                                                    <h4 class="panel-title small_font_size">
                                                        <a role="button" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                            <img src="<?php echo base_url(); ?>assets/images/restrict.svg"> <span>Restricted Items</span>
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div class="panel-heading item_info_mobile col-xs-5 " role="tab" id="headingTwo2">
                                                    <h4 class="panel-title small_font_size">
                                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                            <img src="<?php echo base_url(); ?>assets/images/calculator.svg"><span> Tax & Duty</span>
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div class="panel panel-default">
                                                    <div id="collapseOne" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingOne2">
                                                        <div class="panel-body">
                                                            <div class="bl-content">
                                                                <p>Aerosols and other pressurized containers, alcohol (including perfume), tobacco,
                                                                    perishable foods, drugs, batteries ( included with a personal electronic device ) or any other items specified in our
                                                                    <a href="<?php echo base_url('what-cant-ship'); ?>" class="blue-color"> Prohibited Items List </a> and <a href="#" class="blue-color terms_conditions">Terms and Conditions.</a></p>
                                                            </div>
                                                            <div class="">
                                                                <div class=" text-left item_info_mobile">
                                                                    <img src="<?php echo base_url(); ?>assets/images/warning.svg"> Not Covered by Our Insurance
                                                                </div>
                                                                <div class="bl-content">
                                                                    <p>
                                                                        Fragile items, jewelry, antiques, collector’s items, electronics, camera equipment,  precious metals and gems, valuables, art items,
                                                                        cosmetic damage and tear on luggage, restricted items or any Items inside as specified in our
                                                                        <a href="#" class="blue-color terms_conditions">Terms and Conditions</a> and <a target="_blank" href="<?php echo base_url('luggage-and-question/Items_cannot_be_covered_by_insurance');?>" class="blue-color">Not Covered List.</a></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel panel-default">
                                                    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo2">
                                                        <div class="panel-body">
                                                            <div class="bl-content  item_info_mobile">
                                                                <p class="red-color">Any international shipment is subject to customs clearance and may be charged possible tax and duty.
                                                                    LuggageToShip is not responsible for any customs delays and tax & duty fees.</p>
                                                                <p>The item list of your shipment is required by the International shipment and customs department.
                                                                    To avoid customs delay, we strongly suggest our customers to provide a completed and accurate item list. </p>
                                                                <p>Please be advised that the customs of the destination country has the right to check, re-value your item(s) and charge applied tax and duty correspondingly.</p>
                                                                <p>Please Check <a href="#" class="blue-color terms_conditions">Terms and Conditions</a> for details</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php

                                        if($order_info['shipping_status']<=SUBMITTED_STATUS[0]){ ?>

                                            <div class="col-md-4 col-sm-12 col-xs-12">

                                                <button type="button" class="btn btn-default btn-login-orange clear_signature_db">Edit</button>
                                            </div>
                                        <?php }  ?>

                                    </div>
                                </form>
                            </div>

                            <div class="list-colored-block">
                                <h2>Other custom document</h2>
                                <div class="col-md-6 text-center">
                                    <?php
                                    if(!empty($form_files)){ ?>
                                        <p class="more-lights">Please download and fill in if you are shipping personal effects or spot
                                            equipment</p>
                                    <?php } ?>
                                    <ul class="document-label">
                                        <?php
                                        if (!empty($form_files)) {

                                            foreach ($form_files as $files) { ?>
                                                <li>
                                                    <a href="<?php echo base_url('admin/price_page/currier_file/' . $country_info[0]['iso2'] . '/' . $files['doc_file_name']); ?>">
                                                        <img class="download-img"
                                                             src="<?php echo base_url(); ?>assets/images/download-note.svg">
                                                        <span><?php echo $files['show_doc_name']; ?></span>
                                                    </a>
                                                </li>
                                            <?php }
                                        } ?>
                                    </ul>

                                    <div class="border-right"></div>
                                </div>
                                <div class="col-md-6 text-center">
                                    <div class="col-sm-12 col-xs-12">
                                      <!--  <label class="btn btn-default btn-file select-doc-file select_doc_file_item_list">
                                            Choose File <input type="file" id="input_file" name="input_file" class="form-control" style="display: none;">
                                        </label>-->
                                    </div>
                                    <div class="doc-file-place">
                                        <ul class="">
                                            <?php if (!empty($uploaded_document)) {

                                                foreach ($uploaded_document as $document) { ?>

                                                    <li>
                                                        <div class="image_div">
                                                            <img class='order_delete_img' data_id='<?php echo $document['id']; ?>'
                                                                 src='<?php echo base_url(); ?>assets/images/x_document.png'>
                                                            <a href="<?php echo base_url('order/user_file/' . $document['file_name'] . '/' . $order_info['id']); ?> "
                                                               target="_blank"> <img class="main_img"
                                                                                     src='<?php echo base_url(); ?>assets/images/file_uploaded.png'></a>
                                                            <span><?php echo $document['show_file_name']; ?></span>
                                                        </div>
                                                    </li>
                                                <?php }

                                            } ?>

                                        </ul>

                                    </div>

                                </div>
                                <p class="clearfix"></p>

                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12 mobile-top-margin pc_version">
                            <div class="progress-small-block">
                                <div class="bl-header text-left">
                                    <img src="<?php echo base_url()?>assets/images/restrict.svg"> Restricted Items
                                </div>
                                <div class="bl-content">
                                    <p>Aerosol or other Pressurized Containers, Alcohol (included perfume), Tobacco, Perishable Food, Medication ( vitamins ) , Batteries (included with personal device ) or any Items Specified in Our <a href="#" class="blue-color terms_conditions">terms of use  Restricted Items</a></p>
                                </div>
                            </div>

                            <div class="progress-small-block">
                                <div class="bl-header text-left">
                                    <img src="<?php echo base_url()?>assets/images/warning.svg"> Not Covered by Our Insurance
                                </div>
                                <div class="bl-content">
                                    <p>Fragile Items, Jewelry, Antiques, Collector’s Items, Electronics Items, Camera Equipment,  Precious Metal and Gems, Valuables, Art Items, Cosmetic damage and tear on luggage or any Items  Specified in Our <a target="_blank" href="<?php echo base_url('luggage-and-question/Items_cannot_be_covered_by_insurance');?>" class="blue-color">terms of use  Not Cover List</a></p>
                                </div>
                            </div>

                            <div class="progress-small-block">
                                <div class="bl-header text-left">
                                    <img src="<?php echo base_url()?>assets/images/calculator.svg"> Tax & Duty
                                </div>
                                <div class="bl-content">
                                    <p class="red-color">Any international shipment is subject to custom clearance and may be charged for Tax & Duty. LuggageToShip is not responsible for any custom delay and Tax & Duty Fees.</p>
                                    <p>Item list is required by the custom authority of the destination. To avoid custom delay, we strongly suggest our customers to provide full and correct item information they are going to ship.</p>
                                    <p>Please be advised the destination custom has the right to check and re-value your items. If the destination custom confirms a higher value, you may be charged tax and duty .</p>
                                    <p>Please Check <a href="#" class="blue-color terms_conditions">Terms and Conditions</a> for details</p>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="tab-pane" id="traveler_list">

                    </div>
                    <div class="tab-pane" id="address_book">

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 accept-group text-right">
                    </div>
                </div>


            </div>

        </div>
    </div>
</div>


<div class="modal fade" id="term_modal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content terms_text_div">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3> Luggage To Ship Terms and Conditions</h3>
            </div>
            <div class="modal-body" >
                <div class="term_use_modal">
                    <p>
                        Welcome to the Luggage To Ship.com website (the "Website"). The website is owned and operated by Luggage To Ship Inc. (the “Luggage To Ship”) By using the                    website and any services of the website, you (refer to individuals or companies) agree to and acknowledge these teams and conditions (the “Terms”)
                    </p>

                    <h4 class="blue-color">Acceptance of Terms</h4>
                    <p>
                        Luggage To Ship will review the terms every quarter and may update or modify the terms by posting a revised terms on the website. No notification will be                     sent to you. You may check the revised terms at any time by visiting this page. By submitting an order through the website, you agree to and acknowledge                      the carrier’s (refer to the third-party shipping company Luggage To Ship used to provide the shipping services) terms and conditions as well.</p>
                    FedEx:  <a href="http://www.fedex.com/us/legal">http://www.fedex.com/us/legal</a><p>
                        DHL:    <a href="http://www.dhl-usa.com/en/express/shipping/shipping_advice/terms_conditions.html">http://www.dhl               .com/en/express/shipping/shipping_advice/terms_conditions.html</a>
                    <h4 class="blue-color">Use of the website</h4>
                    <p>As a condition of your use of the website, you warrant that:</p>
                    <ul>
                        <li>You are at least 18 years of age;</li>
                        <li>You possess the legal authority to create a binding legal obligation;</li>
                        <li>You will use the website in accordance with the terms;</li>
                        <li>You will only use the website to make legitimate reservations of services for you or the other person you are on behalf of</li>
                        <li>You will inform such other persons about the terms that apply to the services you have made on their behalf, including all rules and restrictions applicable thereto;</li>
                        <li>All information provided by you on website is true, accurate, current and complete;</li>
                        <li>If you opened an account with Luggage To Ship, you will safeguard your account information and will supervise and be completely responsible for any use of your account by you and anyone other than you.</li>
                        <li>You agree to comply with all applicable laws, statues, ordinances and regulations regarding use of Luggage To Ship services</li><br>
                    </ul>
                    <p>Luggage To Ship retain the right at our sole discretion to deny access to anyone to the website and the services at any time and for any reason, including, but not limited to, for violation of the terms. </p>

                    <h4 class="blue-color">Description of services</h4>
                    <p>Luggage To Ship provides a web platform to quote, arrange and facilitate the shipment and storage of luggage, boxes and sports equipment (the “Packages”). You select the carrier for your shipping order and acknowledge that Luggage To Ship will use the carrier to transport your packages. You acknowledge that the other third parties (refer to person or origination) at the pick up or delivery address of your order may be responsible for handing over or accepting your packages on behalf of you. Luggage To Ship or the carrier reserves the right to refuse, cancel, return or hold any shipment if the shipment does not comply with the terms, is undeliverable, may contain possible dangerous, illegal or prohibited items, or is not properly packed. You acknowledge that you ship your packages through the service at your own risk. If your packages are damaged or lost during the shipment, or are not delivered within a timely manner due to a failure of Luggage To Ship or the carrier, you may timely and properly request Luggage To Ship's assistance with submitting any claims to the carrier. Luggage To Ship and/or the carrier may conduct a reasonable investigation into your claim, but in no event is Luggage To Ship required or obligated to investigate any claims pertaining to lost, damaged or delayed shipment. You acknowledge and agree that your request for assistance from Luggage To Ship, and/or any reasonable investigation into your claim, does not entitle you to compensation or damages from Luggage To Ship, or any action or recourse by Luggage To Ship, and that a commercially reasonable investigation is your sole and exclusive remedy. You acknowledge that the Services are also subject to any terms imposed by subcontractors of Luggage To Ship and all currieries Luggage To Ship uses.
                    </p>

                    <h4 class="blue-color">Rates and rate adjustments</h4>
                    <p>Rates generated on the website, <a href="https://www.luggagetoship.com/">https://www.luggagetoship.com/</a> , or by a Luggage To Ship representative are based upon the information provided by you at the time of inquiry. Final rates will be based upon actual weights and dimensions verified by the carrier, and actual services provided by the carrier and Luggage To Ship.
                    </p>
                    <p>Dimensions are measured from the widest point of each side of the package. If the actual weight or dimensions of any shipped Item exceeds the maximum allowed for the quoted Item category, rates may adjust to reflect the billing weight. The billing weight is the greater one of the actual weight and dimensional weight of each package. The dimensional weight of an item can be calculated by multiplying length, width and height, in inches, and dividing by 139. </p>
                    <p>If additional service is provided to you include but not limited to address correction after pickup, package hold service, re-pick up service and so forth, related fee will be added to the finial rates as well.
                    </p>
                    <p>If the final rates differ from quoted rates, you acknowledge and agree Luggage To Ship to charge or refund the difference without notice. A final invoice with order breakdown will be provided to you after the finial charge or final refund is processed. </p>

                    <h4 class="blue-color">Delivery time and shipment delay</h4>
                    <p>The delivery time generated on the website,<a href="https://www.luggagetoship.com/">https://www.luggagetoship.com/</a>, or by a Luggage To Ship representative is based on the shipping date and services you selected. The actual delivery date will be based on the actual date the shipment is picked up by the carrier from the pickup address or the drop off location.</p>
                    <p>Luggage To Ship guarantees the delivery time for below express services:</p>
                    <ul>
                        <li>US domestic <b>Express</b>   1 day service</li>
                        <li>US domestic <b>Priority</b>  2 days service</li>
                        <li>US domestic <b>Standard</b>  3 days standard services </li>
                    </ul>
                    <p>Luggage To Ship will make every effort to communicate with the carrier and have them to deliver the package on time. In very few scenarios that a delay is occurred, Luggage To Ship accepts delay claim for above three shipping services (excluding delays caused by factors mentioned in following paragraph). You agree to send a claim request to Luggage To Ship by email within 7 business days from the delivery date. Luggage To Ship will file a claim with the carrier on behalf of you and provide related tracking evidence. Luggage To Ship will not be responsible for any direct or indirect loss caused by <b>shipment delay. You understand and agree that the compensation for shipment delay is up to the shipping fee for the delayed package(s). The carrier who provided shipping services has the right to review the claim and decide the finial</b> compensation amount for the delay.  Luggage To Ship will inform you the claim result after the carrier makes decision. If a compensation is issued by the carrier company, Luggage to ship will process the refund within 3 business days after receiving the claim decision.
                    </p>
                    <p>Luggage To Ship is not responsible for the shipment delay because of:</p>
                    <ul>

                        <li>dropping off package(s) after the service cut off time at the drop of location.</li>
                        <li>shipment on-hold requested by you</li>
                        <li>improperly packing or labelling of the package </li>
                        <li>wrong, inaccurate or incomplete delivery address or receiver information provided by you</li>
                        <li>business being closed or absence or refusal of a person to sign for the shipment at the delivery address</li>
                        <li>no response to custom’s requirements on additional documents in time. </li>
                        <li>custom delay, custom or carrier inspection</li>
                        <li>acts of the God (e.g. earthquake, storm, flood, fog etc.),</li>
                        <li>acts of public authorities acting with actual or apparent authority of law</li>
                        <li>strike, lock-out, stoppage or restraint of labor, the consequences of which we are unable to avoid by the exercise of reasonable diligence</li>
                        <li>any other uncontrollable delay reason listed on FedEx and DHL terms </li>
                    </ul>
                    <p>Luggage To Ship does not guarantee the delivery time for below services:</p>
                    <ul>
                        <li>US domestic Basic <strong>( 1 to 5 days )</strong> service</li>
                        <li>International Express services</li>
                        <li>International Economy service</li>
                    </ul>
                    <p>You acknowledge that there is no delivery time guarantee these services. Packages may be delivered before or after the estimated delivery date. </p>

                    <h4 class="blue-color">Order modification</h4>
                    <p>Luggage To Ship understands that travel schedules can change. You can modify the order online any time before the order is processed. No additional modification fee will be charged. You acknowledge and agree that Luggage To Ship will process the updated order and charge you at updated order total if the change is subject to a fee change.
                    </p>
                    <p>Luggage To Ship will assist you to modify the order after the order is processed. An order modification fee, no more than 25USD, may apply. You acknowledge and agree that Luggage To Ship will charge or refund the order difference if the modification results in a fee change.</p>
                    <p>Once the shipment is picked up by carrier, order cannot be modified anymore. In very few scenarios that a modification must be made to guarantee the delivery, such as correct the wrong delivery address, or request a shipment hold. Luggage To Ship will put all efforts to communicate with the carrier, but the result is not guaranteed. An extra processing fee will be charged by carrier and applied to you.</p>
                    <p>By modifying the order, you acknowledge and agree this terms and conditions as well.</p>


                    <h4 class="blue-color">Order cancellation</h4>
                    <p> If you cancel the order before Luggage To Ship processes the order, no cancellation fee will apply. If you cancel the order after the order is processed, a 25USD cancellation fee will apply. If a pick up is scheduled, the pickup fee is not refundable. If a label envelop has been sent to you before the cancellation, the label delivery fee will apply.  Luggage To Ship will complete the cancellation refund within 15 business days. You acknowledge that carrier has the right to cancel, reject or return any shipment because of prohibited, illegal, dangerous items. You are responsible for any additional fee occurred because of this kind of cancellation, rejection or return.
                    </p>

                    <h4 class="blue-color">Packing, Locking and Labelling</h4>
                    <p>It is your responsibility to select proper case or box, well pack and protect your items. You acknowledge that Luggage To Ship will not responsible for any damage, lost shipment because of improper packing.</p>
                    <p>You agree not to over pack, and exceed the package maximal size and maximal weight of the order. You agree to pay for the weight difference and related surcharges if the luggage exceeds the size and weight limitation of the item catalog when you place the order.</p>
                    <p>It is your responsibility to lock all packages for US domestic shipment. Luggage To Ship is not responsible for any lost item if the unlocked package is shipped domestically.</p>
                    <p>It is your responsibility not to lock all packages for international shipment. You understand that custom or carrier may return the locked package if they are not able to open it for a normal custom screen. Luggage To Ship is not responsible for any shipment delay because of the locked package.</p>
                    <p>It is your responsibility to follow the shipping instruction and correctly attach the shipping labels to the package. Luggage To Ship is not responsible for any lost, delay shipment because of the improper labelling</p>
                    <p>The shipping label Luggage To Ship created for one shipment can only be used for the package(s) you ordered. And the package(s) should be picked up or dropped off same time at the same location you requested in the order. Luggage To Ship is not responsible for any delay, return, loss, damage, custom or carrier abandon shipment if the label is used for more package(s), or package(s) shipped from different location or at different time. Luggage To Ship keeps the right to charge all additional cost billed from the carrier.</p>

                    <h4 class="blue-color">Prohibited items</h4>
                    <p>You agree that will not send anything which may be construed as illegal in any way such as stolen items. You acknowledge and agree that will not pack or ship prohibited items listed below:</p>
                    <ul>
                        <li>Animals, Animal products and human remains; </li>
                        <li>Aerosols or any other pressurized containers;</li>
                        <li>Alcohol, or any goods containing alcohol included perfume</li>
                        <li>Bullion, currency, or other forms of tradeable currency; Credit cards;</li>
                        <li>Batteries (included with personal device) (Only prohibited for international shipment)</li>
                        <li>drugs, including all illegal narcotics, all drugs prohibited by any jurisdiction through which your package will or may travel, as well as prescription drugs; medical samples.</li>
                        <li>Firearms and firearm parts, ammunition, explosives, weapons (including imitations of same);  </li>
                        <li>Flowers and plant products; (Only prohibited for international shipment)</li>
                        <li>Perishable food articles and beverages (Only prohibited for international shipment)</li>
                        <li>Hazardous materials, including, without limitation, hazardous or corrosive materials, explosives, flammable or combustible materials, infectious substances, poisons, dry ice, fireworks, or radioactive materials; and hazardous waste</li>
                        <li>Items that require a temperature controlled environment;</li>
                        <li>Pornography;</li>
                        <li>Tobacco</li>
                        <li>Valuables, high value or irreplaceable items including but not limited to antiques, paintings, jewelry, precious stones;</li>
                        <li>lottery tickets or gambling devices in violation of the laws of any jurisdiction through which your package will or may travel </li>
                        <li>Other Dangerous / hazardous goods, including, without limitation, hazardous or corrosive materials, explosives, flammable or combustible materials, infectious substances, poisons, dry ice, fireworks, or radioactive materials;</li>
                        <li>Other illegal or restricted goods defined by any shipping partner, or any local, state, federal, international law and regulation.</li><br>
                    </ul>
                    <p>You agree not to ship package(s) that are wet, leaking or emit an odor of any kind. Luggage To Ship retains the right to update the prohibited item list any time to comply with related law or regulation. Luggage To Ship and the carrier company reserve the right to open and inspect any item shipped by Luggage To Ship.
                    </p>
                    <p>For international shipment, there may be additional prohibited items specified by the country of origin and/or destination. The carrier may at its sole discretion refuse to carry other items not listed here. It is your responsibility to check the local custom law and regulation before the shipment.
                    </p>

                    <h4 class="blue-color">Pick up and drop off</h4>
                    <p>It is your responsibility to provide correct pick up address and instruction, and make sure all package(s) is correctly labelled and packaged before scheduled pickup time frame. You understand that carrier will not call before the pickup. It is your responsibility to hand over the shipment to carrier or to make sure the courier has easy access to the shipment. Luggage To Ship is not responsible for the missing pick up because of the wrong pick up address, package cannot be found or package is not ready. You understand that the pickup timeframe is not guaranteed. Carrier may go earlier or late on the pickup date due to the road condition and other reasons. Luggage To Ship is not responsible for any unsuccessful pick up caused by carrier’s faults.
                    </p>
                    <p>You understand that carrier may not confirm pick up due to weather, traffic or service area factors. Luggage To Ship will refund the pickup fee if the pickup cannot be confirmed by the carrier. Once the pickup is confirmed, the pickup fee is not refundable. If the pickup is failed because of your fault (such as package not ready, wrong pick up address etc.), Luggage To Ship reserve the right to charge the second pick up.
                    </p>
                    <p>Due to the time difference and office hours, the same day pick up services is not guaranteed. The same day pick up is not available for FedEx Basic service. The Saturday pick up is not available for DHL Express service and FedEx Basic Services. Luggage To Ship does not provide Sunday or holiday pick up for all services.
                    </p>
                    <p>It is your responsible to deliver the package before the service cut off time of carrier’s drop off location, and request a drop off receipt with drop off date, time and shipment tracking number. You acknowledge that will not drop off the shipment incorrectly to carrier’s street box or non-staffed shipping center. Luggage To Ship is not responsible for the shipment delay or lost because of the late drop off, incorrect drop off.
                    </p>

                    <h4 class="blue-color">Delivery and collection</h4>
                    <p>It is your responsibility to provide correct delivery address and delivery instruction. Luggage To Ship is not responsible for the delayed, lost, return shipment because of wrong, incomplete delivery address. You agree to have someone accepts package at the delivery address with a signature. Luggage To Ship is not responsible for any lost, missing package after delivery.
                    </p>
                    <p>If your package is damaged or broken on delivery, it is your responsibility to keep full evidence to assist Luggage To Ship to file a claim with the carrier. The evidences include but not limited to:
                    </p>
                    <ul>
                        <li>package picture with label</li>
                        <li>item pictures</li>
                        <li>putting “package damaged or broken” when sign for the package </li>
                    </ul>
                    <p>If you selected “delivery without signature” when placed the order, you understand that you are not able to file a claim once the shipment tracking shows delivered on carrier’s website.
                    </p>
                    <p>Carrier may try a second delivery if the first delivery attempt is failed. It is your responsibility to have someone to accept the shipment at the delivery address. Carrier may also hold the shipment at nearby station for your collection if the first delivery is failed. You agree to show your pictured ID to collect the shipment. Luggage To Ship will not cover the additional cost occurred for the luggage hold and collection.</p>
                    <p>If you do not collect shipment within the timeframe carrier is able to hold or the package is defined as an undeliverable package because of the wrong address, it will be returned by carrier. You are responsible for the return shipping fee and other additional cost for the return.</p>

                    <h4 class="blue-color">International Shipments</h4>
                    <p>Except the prohibited items listed above, it is your responsibility to check the destination countries custom regulation and make sure not to ship restricted or prohibited items. Luggage To Ship is not responsible for any shipment delay, hold and return because of the restricted or prohibited items</p>
                    <p>Every international shipment is subject to custom clearance, you are responsible for providing full and correct item list for Luggage To Ship to create custom invoice. It is also your responsibility to provide all other document the destination custom requests for clearance. You understand custom has the right to hold and open your package, check and re-value items inside the package, as well as charge the tax and duty based on the value they evaluated.
                    </p>
                    <p>If the sender or receiver is on the carrier, government, or united nations’ denied persons list, the carrier has the right to refuse, hold or return the shipment. You agree that Luggage To Ship is not responsible for the delay, return or refusal of the shipment. You acknowledge to cover all related fee, including but not limited to original shipping fee, return fee, investigation fee and so forth.
                    </p>
                    <p>You acknowledge and agree to be full responsible for the tax and duty, as well as the other custom charges, broker fees or custom warehouse fee if applied. If you refuse to pay for the tax and duty and the carrier charges the tax and duty to Luggage To Ship, Luggage To Ship has the right to charge your credit card at the billed amount.</p>
                    <p>Luggage To Ship is not responsible for the custom delay.  If you do not cooperate with the local custom department and provide necessary custom document or payment for the tax and duty, local custom has the right to hold, destroy packages according to the destination country's law and regulation. You agree to take the full responsibility for the loss and will not dispute the shipping services and shipping fee with Luggage To Ship.
                    </p>
                    <p>You understand that carrier has the right to deliver the package to a third-party broker for clearance per local custom’s regulation. You agree to cooperate with the carrier and the broker company for the clearance, and pay for broker fee and any related fee if applied. Luggage To Ship is not responsible for any custom delay, shipment return or destroy because you refuse to cooperate with the broker and the carrier.
                    </p>

                    <h4 class="blue-color">Missing shipment</h4>
                    <p>Luggage To Ship will keep monitoring shipment and will communicate with the carrier if the shipment tracking stop updating more than 3 business days. It is your responsibility to provide full and detailed package size, color and content information if the carrier is not able to locate the shipment. So, the carrier can search and try to find the missing package.
                    </p>
                    <p>If the carrier confirms unable to locate the package, Luggage To Ship will file a lost claim with the carrier once the other package(s) of the shipment is delivered. If the carrier finds and delivers the missing package, you may request a delay claim if apply to the “Shipment delay” part of this term.
                    </p>

                    <h4 class="blue-color">Insurance, liability and discretionary compensation</h4>
                    <p>Luggage To Ship provides free insurance coverage for each package is up to 100USD. Additional shipping insurance coverage from carrier or the third-party insurance company is available for purchase when you place the order. You are responsible for ensuring to put sufficient insurance coverage to protect the shipment. Luggage To Ship ‘s liability is not applicable to additional shipping insurance purchased by you. Luggage To Ship will file a claim on behalf of you. The carrier or third-party insurance company investigates and makes final decision. In no event shall Luggage To Ship be liable for the additional shipping insurance coverage and related claim result.
                    </p>
                    <p>You understand that insurance only covers:<p>
                    <ul>
                        <li><b><span class="light_grew_iten">Lost shipment</span></b></li>
                        <li><b><span class="light_grew_iten">Damaged luggage / parcels excluding cosmetics damage.</span></b></li>
                    </ul>
                    <p>You understand the insurance does not cover</p>
                    <ul>
                        <li>Cosmetics damage of the luggage, including but not limited to cosmetics wear or tears, scratches on your luggage, broken or missing wheels, straps, pockets, pull handles, hanger hooks or other items attached to baggage or boxes</li>
                        <li>Fragile items including any breakable or temperature sensitive items</li>
                        <li>Glassware including, but not limited to, signs, mirrors, ceramics, porcelains, china, crystal, glass, framed glass, and any other commodity with similarly fragile qualities</li>
                        <li>Electronics including, but not limited to, laptops, cameras, personal computers, stereo equipment, personal audio devices, cell phones, TV.</li>
                        <li>Antiques, collector’s items, precious metals and gems, works of art, precious jewelry</li>
                        <li>Any prohibited items listed in our terms and conditions, </li>
                        <li>Any prohibited items prohibited or restricted by local, country, international law or regulation,</li>
                        <li><span class="likea">Shipment delay including but not limited to custom delay</span></li>
                        <li><span class="likea">Tax, duty and related custom fee for your international shipment,</span></li>
                        <li><span class="likea">Storage Services.</span></li>
                    </ul>
                    <p>You also understand the shipping insurance does not cover the loss or damage arising from following circumstances:</p>
                    <ul>
                        <li>Strike, lock-out, stoppage or restraint of labor, Customs delay, the consequences of which we are unable to avoid by the exercise of reasonable diligence</li>
                        <li>Acts of God</li>
                        <li>Consequence of War or Terrorism</li>
                        <li>Any item or package damaged or lost because of your improper packing or / and labelling. You understand that your items must be thoroughly packaged and must be able to fall approximately 38 inches without breaking. Or any damage inside packages or luggage
                        </li>
                        <li>Any lost or damage after package has been signed for and accepted at the wrong or incomplete delivery address provided by you</li>
                        <li>Any lost or damage after package has been delivered without signature request</li>
                        <li>Any lost or damage before the carrier pick up the shipment, or before the carrier accepted the drop off package.</li>
                        <li>You failed to adhere to the terms and conditions set out in these conditions</li>
                    </ul>
                    <p>You agree to file a claim with Luggage To Ship for the lost or damaged shipment. Lost claim need to be submitted within 5 business days from the estimated delivery date. The claim should be sent by email with the lost item list, purchase invoice. Damage claim need to be submitted within 3 business days after the shipment is delivered. The claim should be sent by email with damaged package, damaged item pictures, damaged item value list and purchase invoice.
                    </p><br>
                    <p>Luggage To Ship assists to collect all claim document and submit the claim on behalf of you. In no event shall Luggage To Ship to be responsible for the claim result. The carrier or third-party insurance company will investigate and decide the claim result and compensation amount per their insurance policy and inspection. The claim investigation usually will last 30-60 business days. Once the decision is made, it will be the final decision and settlement for the claim.
                    </p><br>
                    <p>Luggage To Ship will process a refund within 5 business days after the claim is approved by the carrier or third-party insurance company. You agree to file a lost or damage claim through Luggage To Ship. You understand the lost or damage claim may be rejected if you file it directly with the carrier. You acknowledge that Luggage To Ship will not responsible for any rejection because you file the claim directly with the carrier.
                    </p>

                    <h4 class="blue-color">Storage Services</h4>
                    <p>Luggage To Ship cannot accept packages over 72 inches in length or 100lbs in weight. Luggage To Ship is not able to provide storage service for those prohibited items described in this term.<br>
                        Luggage To Ship provides up-to 6 months’ free storage services for each piece of package. After 6 months, the monthly warehouse fee for each piece is 10USD. If the storage fee is due over 3 months, you agree that Luggage To Ship has the right to destroy the package(s). Luggage To Ship is not responsible for any item damaged because of improper packaging.
                        Luggage To Ship’s liability coverage for the storage service is up to 100USD each package. You understand that the shipping insurance does not cover the storage services.
                        Luggage To Ship has the right to refuse or return those packages cannot be accepted or stored in our warehouse. You will be responsible for related return shipping and handling fee.
                    </p>

                    <h4 class="blue-color">Promotion Code</h4>
                    <p>Luggage To Ship may offer promotion code to members. All discounts are applied at the sole discretion of Luggage To Ship and may be withdrawn at any time. The discounted amount applied by a promotion code cannot be refunded if you cancel the order. If an expected discount fails to apply to your order, you need contact with Luggage To Ship right away instead of submitting the order. Luggage To Ship accepts one valid promotion code per order.
                    </p>

                    <h4 class="blue-color">Limitation of Liability</h4>
                    <p>Luggage To Ship’s liability is limited to the lower of actual damages/lost or free insurance amount. Our maximal liability coverage is up to 100USD each package shipped and stored via us. Luggage To Ship is not responsible for indirect or consequential loss such as (but not limited to) loss of profit, loss of market or the consequences of delay or deviation however caused. Luggage To Ship is not responsible for any carrier or carrier’s partner ‘s service fault (delay, lost, damage etc.) Luggage To Ship is not responsible for any loss, damage or delay caused by events beyond our control, including but not limited to acts of god, war, civil unrest, or acts of government. Luggage To Ship is not the shipper of your package, and has no liability for what you ship. Luggage To Ship ‘s liability is not applicable to additional insurance purchased by you. Luggage To Ship file a claim on behalf of you. The carrier or third-party insurance company investigates and makes final decision. In no event shall Luggage To Ship be liable for the additional insurance coverage.
                    </p>

                </div>
            </div>
        </div>

    </div>

</div>