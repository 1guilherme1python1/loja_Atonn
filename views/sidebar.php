<h1><?php $this->lang->get('FILTER'); ?></h1>
		    <div class="filterarea">
			    <form method="GET">						  		
				<input type="hidden" name="s" value="<?php echo (isset($viewData['searchTerm']))?$viewData['searchTerm']:''; ?>">
							<input type="hidden" name="category" value="<?php echo (isset($viewData['searchTerm']))?$viewData['category']:''; ?>">
			
								<div class="filterbox">
									<div class="filtertitle">
										<?php $this->lang->get('BRANDS');?>
									</div>
									<div class="filtercontent">
										<?php foreach($viewData['filters']['brands'] as $item): ?>
											<div class="filterItem">
											<input type="checkbox" <?php echo (isset($viewData['filters_select']['brand']) && in_array($item['id'], $viewData['filters_select']['brand'])) ? 'checked="checked"' : '';?>  name="filter[brand][]" value="<?php echo $item['id']; ?>" id="filter_brand<?php echo $item['id'];?>">
											<label for="filter_brand<?php echo $item['id']; ?>"><?php echo $item['name'];?></label><span style="float: right;">(<?php echo $item['count'];?>)</span>	
											</div>
										<?php endforeach; ?>
									</div>
								</div>
								<div class="filterbox">
									<div class="filtertitle">
										<?php $this->lang->get('PRICE');?>
									</div>
									<div class="filtercontent">
										<input type="hidden" name="filter[slider0]" value="<?php echo $viewData['filters']['slider0']; ?>">
										<input type="hidden" name="filter[slider1]" value="<?php echo $viewData['filters']['slider1']; ?>">
									<p>
 		 								<input type="text" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;">
									</p>
								<div id="slider-range"></div>
									</div>
								</div>
								<div class="filterbox">
									<div class="filtertitle">
										<?php $this->lang->get('RATING');?>
									</div>
									<div class="filtercontent">
									<div class="filterItem">
											<input type="checkbox" name="filter[star][]" <?php echo (isset($viewData['filters_select']['star']) && in_array('0', $viewData['filters_select']['star'])) ? 'checked="checked"' : '';?> value="0" id="filter_star0">
											<label for="filter_star0">(<?php $this->lang->get('NOEVALUATION')?>)</label>
											<span style="float: right;">(<?php echo $viewData['filters']['stars'][0]; ?>)</span>
										</div>
										<div class="filterItem">
											<input type="checkbox" name="filter[star][]" <?php echo (isset($viewData['filters_select']['star']) && in_array('1', $viewData['filters_select']['star'])) ? 'checked="checked"' : '';?> value="1" id="filter_star1">
											<label class="imgStar" for="filter_star1"><img src="<?php echo BASE_URL;?>/assets/images/star.png" alt="" height="13"></label>
											<span style="float: right;">(<?php echo $viewData['filters']['stars'][1]; ?>)</span>
										</div>
										<div class="filterItem">
											<input type="checkbox" name="filter[star][]" <?php echo (isset($viewData['filters_select']['star']) && in_array('2', $viewData['filters_select']['star'])) ? 'checked="checked"' : '';?> value="2" id="filter_star2">
											<label class="imgStar" for="filter_star2"><img src="<?php echo BASE_URL;?>/assets/images/star.png" alt="" height="13"></label>
											<label class="imgStar" for="filter_star2"><img src="<?php echo BASE_URL;?>/assets/images/star.png" alt="" height="13"></label>
											<span style="float: right;">(<?php echo $viewData['filters']['stars'][2]; ?>)</span>
										</div>
										<div class="filterItem">
											<input type="checkbox" name="filter[star][]" <?php echo (isset($viewData['filters_select']['star']) && in_array('3', $viewData['filters_select']['star'])) ? 'checked="checked"' : '';?> value="3" id="filter_star3">
											<label class="imgStar" for="filter_star3"><img src="<?php echo BASE_URL;?>/assets/images/star.png" alt="" height="13"></label>
											<label class="imgStar" for="filter_star3"><img src="<?php echo BASE_URL;?>/assets/images/star.png" alt="" height="13"></label>
											<label class="imgStar" for="filter_star3"><img src="<?php echo BASE_URL;?>/assets/images/star.png" alt="" height="13"></label>
											<span style="float: right;">(<?php echo $viewData['filters']['stars'][3]; ?>)</span>
										</div>
										<div class="filterItem">
											<input type="checkbox" name="filter[star][]" <?php echo (isset($viewData['filters_select']['star']) && in_array('4', $viewData['filters_select']['star'])) ? 'checked="checked"' : '';?> value="4" id="filter_star4">
											<label class="imgStar" for="filter_star4"><img src="<?php echo BASE_URL;?>/assets/images/star.png" alt="" height="13"></label>
											<label class="imgStar" for="filter_star4"><img src="<?php echo BASE_URL;?>/assets/images/star.png" alt="" height="13"></label>
											<label class="imgStar" for="filter_star4"><img src="<?php echo BASE_URL;?>/assets/images/star.png" alt="" height="13"></label>
											<label class="imgStar" for="filter_star4"><img src="<?php echo BASE_URL;?>/assets/images/star.png" alt="" height="13"></label>
											<span style="float: right;">(<?php echo $viewData['filters']['stars'][4]; ?>)</span>
										</div>
										<div class="filterItem">
											<input type="checkbox" name="filter[star][]" <?php echo (isset($viewData['filters_select']['star']) && in_array('5', $viewData['filters_select']['star'])) ? 'checked="checked"' : '';?> value="5" id="filter_star5">
											<label class="imgStar" for="filter_star5"><img src="<?php echo BASE_URL;?>/assets/images/star.png" alt="" height="13"></label>
											<label class="imgStar" for="filter_star5"><img src="<?php echo BASE_URL;?>/assets/images/star.png" alt="" height="13"></label>
											<label class="imgStar" for="filter_star5"><img src="<?php echo BASE_URL;?>/assets/images/star.png" alt="" height="13"></label>
											<label class="imgStar" for="filter_star5"><img src="<?php echo BASE_URL;?>/assets/images/star.png" alt="" height="13"></label>
											<label class="imgStar" for="filter_star5"><img src="<?php echo BASE_URL;?>/assets/images/star.png" alt="" height="13"></label>
											<span style="float: right;">(<?php echo $viewData['filters']['stars'][5]; ?>)</span>
										</div>
									</div>
								</div>
								<div class="filterbox">
									<div class="filtertitle">
										<?php $this->lang->get('SALE');?>
									</div>
									<div class="filtercontent">
										<div class="filterItem">
											<input type="checkbox" <?php echo (isset($viewData['filters_select']['sale']) && $viewData['filters_select']['sale']) ? 'checked="checked"' : '';?> value="1" name="filter[sale]" id="filter_sale">
											<label for="filter_sale"><?php  $this->lang->get('ONSALE')?></label>
											<span style="float: right;">(<?php echo $viewData['filters']['sale']; ?>)</span>	
										</div>
									</div>
								</div>
								<div class="filterbox">
									<div class="filtertitle">
										<?php $this->lang->get('OPTIONS');?>
									</div>
									<div class="filtercontent">
										<?php foreach($viewData['filters']['options'] as $options):?>
											<strong><?php echo $options['name'];?></strong><br>
												<?php foreach($options['options'] as $op):?>
													<div class="filterItem">
														<input type="checkbox" name="filter[options][]" <?php echo (isset($viewData['filters_select']['options']) && in_array($op['value'], $viewData['filters_select']['options'])) ? 'checked="checked"' : '';?> value="<?php echo $op['value']; ?>" id="filter_options<?php echo $op['value'];?>">
														<label for="filter_options<?php echo $op['value']; ?>"><?php echo $op['value'];?></label><span style="float: right;">(<?php echo $op['count'];?>)</span>
													</div>
												<?php endforeach;?>
											<br>
										<?php endforeach;?>
									</div>
								</div>
							</form>
				  		</div>

				  		<div class="widget">
				  			<h1><?php $this->lang->get('FEATUREDPRODUCTS'); ?></h1>
				  			<div class="widget_body">

							  <?php $this->loadView('widget_item', ['list'=>$viewData['widget_featured1']]);?>

				  			</div>
				  		</div>