<?php $__env->startSection('content'); ?>
	<div class="wt-haslayout wt-dbsectionspace la-manage-jobs-holder">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 float-right" id="orders">
				<div class="preloader-section" v-if="loading" v-cloak>
					<div class="preloader-holder">
						<div class="loader"></div>
					</div>
				</div>
				<div class="wt-dashboardbox wt-dashboardservcies">
					<div class="wt-dashboardboxtitle wt-titlewithsearch">
						<h2><?php echo e(trans('lang.orders')); ?></h2>
					</div>
					<div class="wt-dashboardboxcontent wt-categoriescontentholder">
						<?php if($orders->count() > 0): ?>
							<table class="wt-tablecategories wt-tableservice">
								<thead>
									<tr>
										<th><?php echo e(trans('lang.order')); ?></th>
										<th><?php echo e(trans('lang.user')); ?></th>
										<th><?php echo e(trans('lang.trans_detail')); ?></th>
										<th><?php echo e(trans('lang.action')); ?></th>
									</tr>
								</thead>
								<tbody>
									<?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<?php 
											$is_featured = '';
											$title = '';
											$amount = '';
											$attachment = '';
											if ($order->type == 'job') {
												$proposal = App\Proposal::find($order->product_id);
												$is_featured = $proposal->job->is_featured;
												$title = $proposal->job->title;
												$amount = $proposal->amount;
											} elseif ($order->type == 'service') {
												$service_order = !empty($order->product_id) ? DB::table('service_user')->select('service_id')->where('id', $order->product_id)->first() : '';
												$service = !empty($service_order->service_id) ? App\Service::find($service_order->service_id) : '';
												$title = !empty($service) ? $service->title : '';
												$amount = !empty($service) ? $service->price : '';
												$attachment = !empty($service) ? Helper::getUnserializeData($service->attachments)[0] : '';
											} elseif ($order->type == 'package') {
												$package = App\Package::find($order->product_id);
												$title = $package->title;
												$amount = $package->cost;
											}
											$user = App\User::find($order->user_id);
										?>
										<?php if(!empty($order->invoice)): ?>
											<tr class="del-<?php echo e($order->id); ?>">
												<td data-th="title">
													<span class="bt-content">
														<div class="wt-service-tabel">
															<?php if(!empty($attachment) && $order->type == 'service'): ?>
																<figure class="service-feature-image"><img src="<?php echo e(asset( Helper::getImageWithSize('uploads/services/'.$service->seller[0]->id, $attachment, 'small' ))); ?>" alt="<?php echo e($service['title']); ?>"></figure>
															<?php else: ?>
																<figure class="service-feature-image"><img src="<?php echo e(asset('images/order-no-image.jpg')); ?>" alt="no-image"></figure>
															<?php endif; ?>
															<div class="wt-freelancers-content">
																<div class="dc-title">
																	<?php if($is_featured == 'true'): ?>
																		<span class="wt-featuredtagvtwo">Featured</span>
																	<?php endif; ?>
																	<h3><?php echo e($title); ?> <span><?php echo e(trans('lang.order')); ?>#<?php echo e($order->id); ?></span> </h3>
																	<span><strong><?php echo e(!empty($symbol) ? $symbol['symbol'] : '$'); ?><?php echo e($amount); ?></strong></span>
																</div>
															</div>
														</div>
													</span>
												</td>
												<td>
													<span class="bt-content">
														<div class="wt-service-tabel">
															<figure class="service-feature-image"><img src="<?php echo e(asset(Helper::getProfileImage($user->id))); ?>" alt="<?php echo e(trans('lang.image')); ?>"></figure>
															<div class="wt-freelancers-content">
																<div class="dc-title">
																	<?php if($user->user_verified == 1): ?>
																		<span class="wt-featuredtagvtwo"><?php echo e(trans('lang.featured')); ?></span>
																	<?php endif; ?>
																	<a href="<?php echo e(url('profile/'.$user->slug)); ?>"><h3><?php echo e(Helper::getUserName($user->id)); ?></h3></a>
																</div>
															</div>
														</div>
													</span>
												</td>
												<td>
													<span class="bt-content wt-payment-tab">
														<div class="wt-actionbtn">
															<a href="javascript:void(0);" class="wt-viewinfo wt-btnhistory" v-on:click.prevent="showOrderDetail('<?php echo e($order->id); ?>')">
																<?php echo e(trans('lang.payment_detail')); ?>

															</a>
														</div>
														<?php if($order->invoice->transection_doc): ?>
															<div class="wt-payment-attachment">
																<a href="javascript:void(0);"  v-on:click.prevent="downloadAttachment('users', '<?php echo e(Helper::getUnserializeData($order->invoice->transection_doc)[0]); ?>', '<?php echo e($order->user_id); ?>')" ><?php echo e(trans('lang.attachment')); ?></a>
															</div>
														<?php endif; ?>
													</span>
												</td>
												<td data-th="Service Status">
													<span class="bt-content">
														<form class="wt-formtheme wt-formsearch">
															<fieldset>
																<div class="form-group">
																	<?php if($order->status == 'pending'): ?>
																		<span class="wt-select">
																			<select id="order_status_tab<?php echo e($order->id); ?>">
																				<?php $__currentLoopData = $status_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
																					<option value="<?php echo e($key); ?>" <?php echo e($key==$order->status ? 'selected' : ''); ?>><?php echo e($status); ?></option>
																				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
																			</select>
																		</span>
																		<a href="javascrip:void(0);" class="wt-searchgbtn job_status_popup" @click.prevent='changeStatus("<?php echo e($order->id); ?>")'><i class="fa fa-check"></i></a>
																	<?php else: ?>
																		<span class="wt-select">
																			<select id="order_status_tab<?php echo e($order->id); ?>" disabled>
																				<?php $__currentLoopData = $status_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
																					<option value="<?php echo e($key); ?>" <?php echo e($key==$order->status ? 'selected' : ''); ?>><?php echo e($status); ?></option>
																				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
																			</select>
																		</span>
																		<a href="javascrip:void(0);" class="wt-searchgbtn job_status_popup" style="pointer-events: none;"><i class="fa fa-check"></i></a>
																	<?php endif; ?>
																</div>
															</fieldset>
														</form>
													</span>
												</td>
											</tr>	
											<?php if(!empty($order->invoice->detail)): ?>
												<b-modal ref="myModalRef-<?php echo e($order->id); ?>" class="wt-uploadrating wt-order-details" hide-footer title="<?php echo e(trans('lang.payment_detail')); ?>" v-cloak>
													<div class="wt-modalbody modal-body">
														<div class="wt-description">
															<p><?php echo e($order->invoice->detail); ?></p>
														</div>
													</div>
												</b-modal>	
											<?php endif; ?>
										<?php endif; ?>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</tbody>
							</table>
						<?php else: ?>
							<?php if(file_exists(resource_path('views/extend/errors/no-record.blade.php'))): ?> 
								<?php echo $__env->make('extend.errors.no-record', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
							<?php else: ?> 
								<?php echo $__env->make('errors.no-record', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
							<?php endif; ?>
						<?php endif; ?>
						<?php if( method_exists($orders,'links') ): ?> <?php echo e($orders->links('pagination.custom')); ?> <?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>