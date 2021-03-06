<!-- main content --> 
<div id="contentwrapper">
	<div class="main_content">
		<?php
		//echo '<pre>';
		//print_r($order_details);
		//echo '</pre>';
		
		
		$order_created = array();
		$order = array();
		$i = -1;
		foreach($order_details as $order_detail)
		{
			
			$orderId = $order_detail->order_id;
	
			if(!in_array($orderId,$order_created))
			{
				$i++;
				$order_created[] = $orderId;
				$order[$i][] = $order_detail;
			}
			else
			{
				$key = array_search($orderId, $order_created);
				$order[$key][] = $order_detail;
			}
			
		}// end foreach
	
		//print_r($order); echo '</pre>'; //exit;
		
		?>
		<nav>
			<div id="jCrumbs" class="breadCrumb module">
				<ul>
					<li>
						<a href="#"><i class="icon-home"></i></a>
					</li>
					<li>
						<a href="#"><?php echo ucwords($this->uri->segment(1)); ?></a>
					</li>
					<li>
						<a href="#"><?php echo ucwords($this->uri->segment(2)); ?></a>
					</li>                                
				</ul>
			</div>
		</nav>
		
		<div class="row-fluid">
			<div class="span12">
			
			<?php if($this->session->userdata('msg')!='') {  
				echo '<div class="alert alert-info">';
				echo $this->session->userdata('msg'); $this->session->unset_userdata('msg');
				echo '</div>';
			 } ?>
             
             <div id="response" class="alert alert-info" style="display:none;"></div>
			
				
			</div>						
		</div>
		
		<div class="row-fluid">
                        <div class="span12">
                            <h3 class="heading">List Orders</h3>
							<?php 
							if(sizeof($order)>0)
							{
							?>
								<table class="table table-striped table-bordered dTableR" id="dt_a">
									<thead>
										<tr>
											<th>#</th>
											<th>Order Id</th>
                                            <th>Name</th>
                                            <th>Shipping Address</th>
											<th>Payment Status</th>
                                            <th>Order Date</th>
                                            <th>Delivery Status</th>
                                            <th>Details</th>											
										</tr>
									</thead>
									<tbody>
									<?php
										$s_no = 1;	
																		
											foreach($order as $order_detail)
											{
												$total_amount = 0;
												
												$detail = $order_detail[0];
												$id = $detail->id;
												$shipping_address = $detail->address.'<br>'.$detail->city.','.$detail->state.' - '.$detail->zip.'<br>'.$detail->country;
													
												
												echo '<tr id="order_'.$id.'">
														<td>'.$s_no.'</td>
														<td>'.$detail->order_id.'</td>
														<td>'.$detail->first_name.' '.$detail->last_name.'<br>'.$detail->email.'</td>';
												
												//echo '<td>'.$total_amount.'</td>';
												echo '<td>'.$shipping_address.'</td>
													<td>'.$detail->payment_status.'</td>
													<td>'.date('d M,Y G:i A',strtotime($detail->created)).'</td>';
												?>
													<td>
                                                    	<select onchange="update_delivery_status(<?php echo $detail->order_id; ?>,this.value)" style="width: 93px;">
                                                        	<option value="NULL" <?php if($detail->delivery_status == ''){ echo 'selected="selected"'; } ?>></option>
                                                            <option value="Packed" <?php if($detail->delivery_status == 'Packed'){ echo 'selected="selected"'; } ?>>Packed</option>
                                                            <option value="Dispatched" <?php if($detail->delivery_status == 'Dispatched'){ echo 'selected="selected"'; } ?>>Dispatched</option>
                                                            <option value="Delivered" <?php if($detail->delivery_status == 'Delivered'){ echo 'selected="selected"'; } ?>>Delivered</option>
                                                        </select>
                                                    </td>
												<?php
                                                echo '<td><a href="details/'.$detail->order_id.'">Details</a></td>
													</tr>';
													$s_no++;
											
											} // end foreach
										?>                                   
									   
									</tbody>
								</table>
							<?php
							} // end if
							else
							{
								echo 'No Record Found';
							}		
									
								?> 
                        </div>
                    </div>
		
	</div>
</div>
			
          